<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Berita;
use App\Models\Slider;
use DB;

class WelcomeController extends Controller
{
    public function index()
    {

        $produk = Produk::join('users', 'users.id', '=', 'produks.id_user')
            ->select(
                'users.name',
                'produks.*'
            )
            ->inRandomOrder()->limit(8)->get();

        $berita = Berita::join('users', 'users.id', '=', 'beritas.id_user')
            ->select(
                'users.name',
                'beritas.*'
            )
            ->inRandomOrder()->limit(4)->get();

        // $slider = Slider::limit(3)->get();
        $review = DB::table('diskusi_produks')
                    ->join('produks', 'produks.id', '=', 'diskusi_produks.id_produk')
                    ->join('users', 'users.id', '=', 'diskusi_produks.id_user')
                    ->select(
                        'users.name', 
                        'produks.judul_produk', 
                        'produks.slug',
                        'diskusi_produks.*'
                    )
                    ->inRandomOrder()->limit(4)->get();


        return view('frontend.welcome', [
            'produk' => $produk,
            'berita' => $berita,
            // 'slider'    => $slider
            'review' => $review
        ]);
    }
}