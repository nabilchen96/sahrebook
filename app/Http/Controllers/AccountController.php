<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;

class AccountController extends Controller
{
    public function index(){

        return view('frontend.account');
    }

    public function store(Request $request){

        $user = User::find(Auth::id());
        $data = $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password ? Hash::make($request->password) : $user->password, 
            'no_hp'     => $request->no_hp
        ]);

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Disimpan'
        ];

        return response()->json($data);

    }
}
