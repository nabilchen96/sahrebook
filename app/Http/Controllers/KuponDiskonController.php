<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\KuponDiskon;
use Auth;
use Illuminate\Support\Facades\Validator;

class KuponDiskonController extends Controller
{
    public function index()
    {

        return view('backend.kupon_diskon.index');
    }

    public function data()
    {

        $kupon = KuponDiskon::all();

        return response()->json(['data' => $kupon]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_kupon' => 'required',
            'kode_kupon' => 'required',
            'total_diskon' => 'required',
            'minimal_belanja' => 'required',
            'status_kupon' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        //proses insert
        $insert = KuponDiskon::create([
            'nama_kupon' => $request->nama_kupon,
            'kode_kupon' => $request->kode_kupon,
            'total_diskon' => $request->total_diskon,
            'minimal_belanja' => $request->minimal_belanja,
            'status_kupon' => $request->status_kupon
        ]);

        return response()->json([
            'responCode' => 1,
            'message' => 'Success!',
            'data' => $insert
        ]);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_kupon' => 'required',
            'kode_kupon' => 'required',
            'total_diskon' => 'required',
            'minimal_belanja' => 'required',
            'status_kupon' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        //proses insert
        $kupon = KuponDiskon::find($request->id);
        $insert = $kupon->update([
            'nama_kupon' => $request->nama_kupon,
            'kode_kupon' => $request->kode_kupon,
            'total_diskon' => $request->total_diskon,
            'minimal_belanja' => $request->minimal_belanja,
            'status_kupon' => $request->status_kupon
        ]);

        return response()->json([
            'responCode' => 1,
            'message' => 'Success!',
            'data' => $insert
        ]);
    }

    public function delete(Request $request)
    {

        $data = KuponDiskon::find($request->id)->delete();

        $data = [
            'responCode' => 1,
            'respon' => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }

    public function cekKodeKupon(Request $request){
        
        $kupon = KuponDiskon::where('kode_kupon', Request('kode_kupon'))->first();

        // dd(Request('total_parse'), $kupon->minimal_belanja);

        if($kupon){

            if(Request('total_parse') >= $kupon->minimal_belanja){
    
                $data = [
                    'message'   => 'Hore!, Anda Mendapatkan Potongan Diskon Sebesar Rp '.number_format($kupon->total_diskon), 
                    'total_diskon'    => $kupon->total_diskon,
                    'grand_total'    => Request('total_parse') - $kupon->total_diskon, 
                    'code'          => 1,
                ];
    
            }else{
                $data = [
                    'message'   => 'Maaf!, Anda Belum Mendapatkan Potongan Karena Minimal belanja Adalah Rp '.number_format($kupon->minimal_belanja), 
                    'total_diskon'  => 0, 
                    'grand_total'   => Request('total_parse'), 
                    'code'  => 0
                ];
            }
        }else{

            $data = [
                'message'   => 'Maaf!, Kupon Tidak Ditemukan, Mungkin Anda Salah Ketik',
                'total_diskon'  => 0, 
                'grand_total'   => Request('total_parse'), 
                'code'  => 0
            ];
        }


        return response()->json(['data' => $data]);
    }
}