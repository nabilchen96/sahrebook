<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use App\Models\Visitor;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // return $next($request);

        $ipAddress = $request->ip();

        // Mendapatkan URL halaman saat ini
        if (!request()->ajax()) {

            $currentPageUrl = URL::full();
            
            // Mendapatkan data lebih lengkap dari ipinfo.io
            $response = Http::get("https://ipinfo.io/{$ipAddress}/json");
            $data = $response->json();
    
            // dd($data);
    
            // Simpan data pengunjung ke dalam database
            Visitor::create([
                'ip_address' => $ipAddress,
                'user_agent' => $request->header('User-Agent'),
                'provider' => $data['org'] ?? null,
                'location' => $data['loc'] ?? null,
                'device' => $data['device'] ?? null,
                'browser' => $data['browser'] ?? null,
                'os' => $data['os'] ?? null,
                'page_url' => $currentPageUrl, // Simpan URL halaman
            ]);
        }


        return $next($request);

    }
}