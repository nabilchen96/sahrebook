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
        return view('backend.visitor.index');
    }

    public function data()
    {

        $data = DB::table('visitors')
            ->selectRaw('
                page_url, 
                COUNT(page_url) as total
            ')
            ->groupBy('page_url')
            ->whereNotIn('page_url', ['127.0.0.1:8000', 'sahrebook.com'])
            ->orderBy('total', 'DESC')
            ->get();

        $first = DB::table('visitors')
                ->select(
                    'page_url', 
                    DB::raw('COUNT(page_url) as total')
                )
                ->get();

        $combinedData = $data->concat($first);
        $combinedData = $combinedData->sortByDesc('total')->values();

        return response()->json(['data' => $combinedData]);
    }
}