<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use App\Models\Visitor;
use Str;

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

        // Mendapatkan URL halaman saat ini
        if (!request()->ajax()) {

            $currentUrl = request()->url(); // Mendapatkan URL saat ini
            $segments = explode('/', $currentUrl); // Membagi URL menjadi segmen berdasarkan tanda slash
            $lastSegment = end($segments); // Mengambil segmen terakhir

            // Simpan data pengunjung ke dalam database
            Visitor::create([
                'page_url' => $lastSegment, // Simpan URL halaman
            ]);
        }


        return $next($request);

    }
}