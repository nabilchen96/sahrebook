<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function index(){
        return view('backend.visitor.index');
    }

    public function data(){
        
        $data = DB::table('visitors')->get();

        return response()->json(['data' => $data]);
    }
}
