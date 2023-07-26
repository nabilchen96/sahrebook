<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite; //tambahkan library socialite


class AuthController extends Controller
{
    public function login()
    {
        if(Auth::check() == true ) {
            return redirect('dashboard');
        } else {
            return view('frontend.auth.login');
        }

    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(\Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if($user != null){
                \auth()->login($user, true);
                return redirect()->route('home');
            }else{
                $create = User::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'password'          => 0,
                    'role'              => 'User',
                    'no_hp'             => 0,
                    'email_verified_at' => now()
                ]);
        
                
                \auth()->login($create, true);
                return redirect()->route('dashboard');
            }

        } catch (\Exception $e) {
            return redirect()->route('login');
        }


    }

    public function loginProses(Request $request)
    {

        $response_data = [
            'responCode' => 0,
            'respon'    => ''
        ];

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            $role = Auth::user()->role;

            $response_data = [
                'responCode' => 1,
                'respon'    => $role
            ];

        } else { 

            $response_data['respon'] = 'Username atau password salah!';

        }

        return response()->json($response_data);

    }

    public function register(){

        return view('frontend.auth.register');
    }

    public function registerProses(Request $request){

        $validator = Validator::make($request->all(), [
            'password'   => 'required|min:8',
            'email'      => 'unique:users'
        ]);

        if($validator->fails()){

            $data['respon'] = 'Ada kesalahan silahkan ulangi!';

        }else{
            $data = User::create([
                'name'          => $request->name,
                'role'          => 'User',
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'no_hp'         => $request->no_hp
            ]);

            $data = [
                'responCode'    => 1,
                'respon'        => 'Data Berhasil Didaftarkan!'
            ];

            Auth::attempt([
                'email'     => $request->email, 
                'password'  => $request->password,
            ]);
        }

        return response()->json($data);
    }
}
