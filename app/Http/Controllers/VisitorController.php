<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function index()
    {
        // Total semua data
        $totalSemua = DB::table('visitors')->count();

        // Total hari ini
        $totalHariIni = DB::table('visitors')
            ->whereDate('created_at', now()->toDateString())
            ->count();

        // Total kemarin
        $totalKemarin = DB::table('visitors')
            ->whereDate('created_at', now()->subDay()->toDateString())
            ->count();

        // Total bulan ini
        $totalBulanIni = DB::table('visitors')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return view('backend.visitor.index', [
            'totalSemua'    => $totalSemua, 
            'totalHariIni'  => $totalHariIni, 
            'totalKemarin'  => $totalKemarin, 
            'totalBulanIni' => $totalBulanIni
        ]);
    }

    public function data()
    {

        $data = DB::table('visitors')
            ->selectRaw('
                page_url, 
                COUNT(page_url) as total
            ')
            ->groupBy('page_url')
            ->whereNotIn(
                'page_url',
                [
                    '127.0.0.1:8000',
                    'sahrebook.com',
                    'ebook.airportslab.com',
                    'www.sahrebook.com', 
                    'www.sahrebook.com.airportslab.com'
                ]
            )
            ->orderBy('total', 'DESC')
            ->get();

        return response()->json(['data' => $data]);
    }
}