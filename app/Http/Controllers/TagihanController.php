<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Cart;
use App\Models\Tagihan;
use App\Models\DetailTagihan;
use Midtrans\Config;
use Midtrans\Snap;

class TagihanController extends Controller
{
    public function index(){

        return view('frontend.transaksi');
    }

    public function dataTransaksiUser(){
        
        $data = Tagihan::where('id_user', Auth::id())->get();
        return response()->json(['data' => $data]);
    }

    public function adminTagihan(){

        $data = DB::table('detail_tagihans as dt')
            ->join('tagihans as t', 't.id', '=', 'dt.id_tagihan')
            ->join('users as u', 'u.id', '=', 't.id_user')
            ->join('produks as p', 'p.id', '=', 'dt.id_produk')
            ->select(
                'dt.*', 
                't.invoice', 
                't.status', 
                't.updated_at as tagihan_updated',
                't.created_at as tagihan_created', 
                'u.name',
                'u.no_hp', 
                'u.email', 
                'p.judul_produk', 
                'p.gambar_1',
                't.total as tagihan_total'
            )
            ->orderBy('invoice')
            ->get();

        return view('backend.tagihan.index', [
            'data'  => $data
        ]);
    }

    public function dataDetailTransaksiUser($id){

        $data = DB::table('detail_tagihans as dt')
                ->join('tagihans as t', 't.id', '=', 'dt.id_tagihan')
                ->join('users as u', 'u.id', '=', 't.id_user')
                ->join('produks as p', 'p.id', '=', 'dt.id_produk')
                ->where('t.id', $id)
                ->select(
                    'dt.*', 
                    't.invoice', 
                    't.status', 
                    't.updated_at', 
                    'u.name',
                    'u.no_hp', 
                    'u.email', 
                    'p.judul_produk', 
                )
                ->get();

        return response()->json(['data' => $data]);
    }

    public function printInvoice($id){

        $data = DB::table('detail_tagihans as dt')
                ->join('tagihans as t', 't.id', '=', 'dt.id_tagihan')
                ->join('users as u', 'u.id', '=', 't.id_user')
                ->join('produks as p', 'p.id', '=', 'dt.id_produk')
                ->where('t.id', $id)
                ->select(
                    'dt.*', 
                    't.invoice', 
                    't.status', 
                    't.updated_at', 
                    'u.name',
                    'u.no_hp', 
                    'u.email', 
                    'p.judul_produk', 
                )
                ->get();

        return view('frontend.print-invoice', [
            'data' => $data
        ]);
    }

    public function store(Request $request){

        //get cart data
        $cart = DB::table('carts as c')
                ->join('produks as p', 'p.id', '=', 'c.id_produk')
                ->where('c.id_user', Auth::id())
                ->get();

        $totalHarga = collect($cart)->sum('harga');

        DB::beginTransaction();

        try{

            $invoice = 'INV-'.time().Auth::id();

            if($totalHarga != 0){
    
                \Midtrans\Config::$serverKey = config('app.midtrans_server_key');
                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                \Midtrans\Config::$isProduction = false;
                // Set sanitization on (default)
                \Midtrans\Config::$isSanitized = true;
                // Set 3DS transaction for credit card to true
                \Midtrans\Config::$is3ds = true;
    
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $invoice,
                        'gross_amount' => $totalHarga,
                    ),
                    'customer_details' => array(
                        'first_name' => Auth::user()->name,
                        'last_name' => '',
                        'email' => Auth::user()->email,
                        'phone' => Auth::user()->no_hp,
                    ),
                );
    
                $snapToken = \Midtrans\Snap::getSnapToken($params);
            }


            //make tagihan
            $tagihan = Tagihan::create([
                'id_user'       => Auth::id(), 
                'invoice'       => $invoice,
                'tgl_tagihan'   => date('Y-m-d'), 
                'diskon'        => 0, 
                'total'         => $totalHarga,
                'status'        => $totalHarga != 0 ? 'UNPAID' : 'PAID',
                'snap_token'    => @$snapToken ?? 0
            ]);
    
            // make detail tagihan
            foreach ($cart as $key => $value) {
                $detail_tagihan = DetailTagihan::create([
                    'id_tagihan'    => $tagihan->id,
                    'id_produk'     => $value->id_produk,
                    'harga'         => $value->harga, 
                    'diskon'        => 0
                ]);
            }
    
            //destroy user cart
            Cart::where('id_user', Auth::id())->delete();

            DB::commit();

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];

            
        }catch(\Exception $e){

            DB::rollback();

            $data = [
                'responCode'    => 0,
                'respon'        => 'Oops!, terjadi kesalahan yang tidak terduga '.$e
            ];
        }

        return response()->json($data);

    }

    public function callback(Request $request){

        $serverKey  = config('app.midtrans_server_key');
        $hashed     = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $tagihan = Tagihan::where('invoice', $request->order_id);
                $tagihan->update([
                    'status'        => 'PAID', 
                    // 'updated_at'    => time()
                ]);
            }
        }
    }

    public function bayarTagihan($id){

        $tagihan = Tagihan::where('id', $id);
        $tagihan->update([
            'status'        => 'PAID', 
        ]);

        return back();
    }
}
