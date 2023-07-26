<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BelajarController extends Controller
{
    public function index($id){

        // dd($id);

        $data = DB::table('detail_produks as dp')
                ->where('dp.id_produk', $id)
                ->get();

        $konten = DB::table('detail_produks')
                    ->where('id', Request('p') ?? $data[0]->id)->first();


        $nextData = DB::table('detail_produks')
                    ->where('id', '>', Request('p') ?? $data[0]->id)
                    ->orderBy('id')
                    ->value('id');

        return view('frontend.belajar', [
            'id'        => $id, 
            'data'      => $data, 
            'konten'    => $konten, 
            'nextData'  => $nextData
        ]);
    }
}
