<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(){

        return view('frontend.cart');
    }

    public function adminCart(){

        $data = DB::table('carts as c')
                ->join('produks as p', 'p.id', '=', 'c.id_produk')
                ->join('users as u', 'u.id', '=', 'c.id_user')
                ->select(
                    'u.name', 
                    'p.judul_produk', 
                    'p.jenis_produk',
                    'p.harga',
                    'p.gambar_1', 
                    'c.updated_at', 
                    'u.email', 
                    'u.no_hp'
                )
                ->get();

        return view('backend.cart.index', [
            'data' => $data
        ]);
    }

    public function store(Request $request){

        $cart = Cart::where('id_user', Auth::id())->where('id_produk', $request->id_produk)->count();

        if($cart > 0){

            $data = [
                'responCode'    => 2,
                'respon'        => 'Anda Sudah Memiliki Ebook ini di Keranjang'
            ];

        }else{

            $data = Cart::create([
                'id_produk' => $request->id_produk,
                'id_user'   => Auth::id()
            ]);
    
            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Sukses Ditambah'
            ];
        }


        return response()->json($data);
    }

    public function getCartNotif(){

        $data = DB::table('carts')->where('id_user', Auth::id())->count();        

        return response()->json(['data' => $data]);
    }

    public function getCartUser(){

        $data = DB::table('carts as c')
                ->join('produks as p', 'p.id', '=', 'c.id_produk')
                ->where('c.id_user', Auth::id())
                ->select(
                    'c.*', 
                    'p.judul_produk', 
                    'p.jenis_produk', 
                    'p.harga', 
                    'p.gambar_1'
                )
                ->get();

        return response()->json(['data' => $data]);
    }

    public function delete(Request $request){

        $data = Cart::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
