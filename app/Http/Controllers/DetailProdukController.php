<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\DetailProduk;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;



class DetailProdukController extends Controller
{
    public function index($id){

        return view('backend.detail-produk.index', [
            'id'    => $id
        ]);
    }

    public function data($id){

        $data = DB::table('detail_produks as dp')
                ->join('produks as p', 'p.id', '=', 'dp.id_produk')
                ->select(
                    'dp.*'
                )
                ->where('id_produk', $id)->get();

        return response()->json(['data' => $data]);
    }

    public function create($id){


        return view('backend.detail-produk.create', [
            'id'    => $id
        ]);
    }

    public function store(Request $request, $id){

        // Simpan data ke dalam database atau lakukan tindakan lain sesuai kebutuhan
        // Simpan isi_pembahasan sebagai file di dalam public folder
        $isi_detail_produk = $request->input('isi_detail_produk');

        // dd($isi_detail_produk);

        $isi_detail_produk = str_replace('<pre class="ql-syntax" spellcheck="false">', '<pre><code class="hljs">', $isi_detail_produk);
        $isi_detail_produk = str_replace('</pre>', '</pre></code>', $isi_detail_produk);

        $isi_detail_produk = html_entity_decode($isi_detail_produk);


        // Parsing data HTML menggunakan DOMDocument
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Menonaktifkan error parsing HTML
        $dom->loadHTML($isi_detail_produk);
        libxml_clear_errors();

        // Ambil semua elemen gambar dari editor
        $imageElements = $dom->getElementsByTagName('img');

        // Loop melalui elemen gambar dan simpan ke dalam folder public
        foreach ($imageElements as $imageElement) {
            $base64Data = $imageElement->getAttribute('src');
            $imageData = substr($base64Data, strpos($base64Data, ',') + 1);
            $imageData = base64_decode($imageData);

            // Buat nama file unik dengan menggunakan timestamp dan UUID
            $imageName = 'gambar_' . time() . '_' . Str::uuid()->toString() . '.png';
            
            // Simpan gambar di dalam folder public
            file_put_contents(public_path('gambar_konten/'.$imageName), $imageData);

            // Ganti atribut src dengan referensi ke file di public
            $imageElement->setAttribute('src', asset('/gambar_konten/' . $imageName));
        }

        // Simpan isi pembahasan yang sudah diproses dengan gambar di dalam database
        // Misalnya, jika Anda memiliki model DetailProduk, Anda bisa menyimpannya seperti ini:
        DetailProduk::create([
            'id_produk' => $id,
            'judul_detail_produk' => $request->input('judul_detail_produk'),
            'isi_detail_produk' => $dom->saveHTML(), // Simpan isi pembahasan yang sudah diproses dengan gambar
            'kategori'  => $request->kategori
        ]);

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Disimpan'
        ];

        // Tanggapi jika berhasil
        return response()->json($data);
    }

    public function edit($id){

        $data = DB::table('detail_produks as dp')
                ->where('dp.id', $id)
                ->first();
        
        return view('backend.detail-produk.edit', [
            'data'  => $data, 
            'id'    => $id, 
        ]);
    }

    public function getData($id){

        $data = DB::table('detail_produks as dp')
                ->where('dp.id', $id)
                ->first();

                // dd($data);

        
        return response()->json($data);
    }

    public function update(Request $request, $id){

        // dd($request->isi_detail_produk);

        // Simpan data ke dalam database atau lakukan tindakan lain sesuai kebutuhan
        // Simpan isi_pembahasan sebagai file di dalam public folder
        $isi_detail_produk = $request->input('isi_detail_produk');

        $isi_detail_produk = str_replace('<pre class="ql-syntax" spellcheck="false">', '<pre><code class="hljs">', $isi_detail_produk);
        $isi_detail_produk = str_replace('</pre>', '</pre></code>', $isi_detail_produk);

        $isi_detail_produk = html_entity_decode($isi_detail_produk);

        // Parsing data HTML menggunakan DOMDocument
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Menonaktifkan error parsing HTML
        $dom->loadHTML($isi_detail_produk);
        libxml_clear_errors();

        // Ambil semua elemen gambar dari editor
        $imageElements = $dom->getElementsByTagName('img');

        // dd($imageElements);

        // Loop melalui elemen gambar dan simpan ke dalam folder public
        foreach ($imageElements as $imageElement) {
            $src = $imageElement->getAttribute('src');

            // Check if the image is new (base64-encoded) or already saved
            if (strpos($src, 'data:image/') === 0) {
                // New image: extract and save it
                $base64Data = $src;
                $imageData = substr($base64Data, strpos($base64Data, ',') + 1);
                $imageData = base64_decode($imageData);

                // Buat nama file unik dengan menggunakan timestamp dan UUID
                $imageName = 'gambar_' . time() . '_' . Str::uuid()->toString() . '.png';

                $existingImagePath = public_path('gambar_konten/'.$imageName);

                // Simpan gambar di dalam folder public
                file_put_contents($existingImagePath, $imageData);

                // Ganti atribut src dengan referensi ke file di public
                $imageElement->setAttribute('src', '/gambar_konten/' . $imageName);
            } else {
                // Existing image: no need to do anything
                continue;
            }

            // echo $src.'<br>';
        }

        // die;

        // Simpan isi pembahasan yang sudah diproses dengan gambar di dalam database
        // Misalnya, jika Anda memiliki model DetailProduk, Anda bisa menyimpannya seperti ini:
        $detail_produk = DetailProduk::find($request->id);
        $detail_produk->update([
            'judul_detail_produk' => $request->input('judul_detail_produk'),
            'isi_detail_produk' => $dom->saveHTML(), // Simpan isi pembahasan yang sudah diproses dengan gambar
            'kategori'  => $request->kategori
        ]);

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Disimpan'
        ];

        // Tanggapi jika berhasil
        return response()->json($data);
    }

    public function delete(Request $request){

        $data = DetailProduk::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }
}
