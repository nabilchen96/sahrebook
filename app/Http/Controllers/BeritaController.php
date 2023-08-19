<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Berita;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

class BeritaController extends Controller
{
    public function index(){

        return view('backend.berita.index');
    }

    public function data(){
        

        $data_user = Auth::user();

        $berita = Berita::join('users', 'users.id', '=', 'beritas.id_user')
                    ->select(
                        'users.name', 
                        'beritas.*'
                    )->orderBy(
                        'beritas.created_at', 'DESC'
                    );

        if($data_user->role == 'Admin'){
            
            $berita = $berita->get();
        }else{

            $berita = $berita->where('beritas.id_user', $data_user->id)->get();
        }

        return response()->json(['data' => $berita]);
    }

    public function create(){

        return view('backend.berita.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'gambar'        => 'required|mimes:png,jpg,JPEG,PNG|max: 500',

            'judul'         => 'required',
            'deskripsi'     => 'required', 
            'kategori'      => 'required',   
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        //wajib
        $gambar       = $request->gambar;
        $nama_gambar  = date('YmdHis.').$gambar->extension();
        $gambar->move('gambar_berita', $nama_gambar);

        //isi berita
        $isi_detail_produk = $request->input('deskripsi');

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
            file_put_contents(public_path('gambar_konten_berita/'.$imageName), $imageData);

            // Ganti atribut src dengan referensi ke file di public
            $imageElement->setAttribute('src', asset('/gambar_konten_berita/' . $imageName));
        }

        //make slug
        $slug = strtolower($request->judul); // Mengubah huruf kapital menjadi huruf kecil
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug); // Menghapus karakter selain huruf kecil, angka, dan tanda minus


        //proses insert
        $insert = Berita::create([
            'judul'         => $request->judul, 
            'deskripsi'     => $dom->saveHTML(),
            'id_user'       => Auth::user()->id ?? 2,
            'kategori'      => $request->kategori, 
            'gambar'        => $nama_gambar,
            'slug'          => $slug
        ]);

        return response()->json([
            'responCode'  => 1,
            'message'       => 'Success!',
            'data'          => $insert 
        ]);
    }

    public function edit($id){

        $data = DB::table('beritas')
                ->where('id', $id)
                ->first();

        return view('backend.berita.edit', [
            'data'  => $data, 
            'id'    => $id
        ]);
    }

    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'judul'         => 'required',
            'deskripsi'     => 'required', 
            'kategori'      => 'required',  
            'id'            => 'required' 
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        // dd(!$request->gambar);

        //wajib
        if($request->gambar != "undefined"){
            $gambar       = $request->gambar;
            $nama_gambar  = date('YmdHis.').$gambar->extension();
            $gambar->move('gambar_berita', $nama_gambar);
        }

        //isi berita
        $isi_detail_produk = $request->input('deskripsi');

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

                $existingImagePath = public_path('gambar_konten_berita/'.$imageName);

                // Simpan gambar di dalam folder public
                file_put_contents($existingImagePath, $imageData);

                // Ganti atribut src dengan referensi ke file di public
                $imageElement->setAttribute('src', '/gambar_konten_berita/' . $imageName);
            } else {
                // Existing image: no need to do anything
                continue;
            }

            // echo $src.'<br>';
        }

        //make slug
        $slug = strtolower($request->judul); // Mengubah huruf kapital menjadi huruf kecil
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug); // Menghapus karakter selain huruf kecil, angka, dan tanda minus


        //proses Update
        $berita = Berita::find($request->id);
        $insert = $berita->update([
            'judul'         => $request->judul, 
            'deskripsi'     => $dom->saveHTML(),
            'id_user'       => Auth::user()->id ?? 2,
            'kategori'      => $request->kategori, 
            'gambar'        => $nama_gambar ?? $berita->gambar,
            'slug'          => $slug
        ]);

        return response()->json([
            'responCode'  => 1,
            'message'       => 'Success!',
            'data'          => $insert 
        ]);
    }

    public function delete(Request $request){

        $data = Berita::find($request->id)->delete();

        $data = [
            'responCode'    => 1,
            'respon'        => 'Data Sukses Dihapus'
        ];

        return response()->json($data);
    }

    public function detail($id){

        //detail produk
        $detail = Berita::join('users', 'users.id', '=', 'beritas.id_user')
                    ->select(
                        'users.name', 
                        'beritas.*'
                    )
                    ->where('beritas.slug', $id)->first();

                    // dd($detail->id);

        //list produk
        $berita = Berita::join('users', 'users.id', '=', 'beritas.id_user')
                    ->select(
                        'users.name', 
                        'beritas.*'
                    )
                    ->inRandomOrder()->limit(5)->get();


        return view('frontend.berita-detail', [
            'berita' => $berita, 
            'detail' => $detail
        ]);
    }

    public function show(){

        //list berita
        $berita = Berita::join('users', 'users.id', '=', 'beritas.id_user')
                    ->select(
                        'users.name', 
                        'beritas.*'
                    )
                    ->inRandomOrder()->paginate(8);


        return view('frontend.berita', [
            'berita' => $berita, 
        ]);
    }
}
