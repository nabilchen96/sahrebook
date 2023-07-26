<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class UserProdukController extends Controller
{
    public function index(){
        
        $produk = DB::table('tagihans as t')
                    ->join('detail_tagihans as dt', 'dt.id_tagihan', '=', 't.id')
                    ->join('produks as p', 'p.id', '=', 'dt.id_produk')
                    ->join('users as u', 'u.id', '=', 'p.id_user')
                    ->where('t.id_user', Auth::id())
                    ->where('t.status', 'PAID')
                    ->select(
                        'p.*', 
                        'u.name', 
                    )
                    ->get();

        return view('frontend.user-produk', [
            'produk'    => $produk
        ]);
    }
}
