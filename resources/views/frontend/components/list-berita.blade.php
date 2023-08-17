<div class="col-12 list-produk">
    <div class="row d-flex">
        @forelse ($data as $item)
            <div class="col-lg-3 col-md-6 px-3 mt-3 mb-4">
                <a href="{{ url('berita-detail') }}/{{ $item->slug }}" style="text-decoration: none;"
                    class="card shadow">
                    <img class="img-fluid foto_berita" 
                    src="{{ asset('gambar_berita') }}/{{ $item->gambar }}" style="
                        height: 250px;
                        object-fit: cover;"
                    />
                    <div class="card-body">
                        <div class="card-text" style="font-size: 14px">
                            <span class="judul_berita">{{ $item->judul }}</span>
                            <span class="badge bg-info mb-3">{{ $item->kategori }}</span>
                            <br>
                            <i class="bi bi-shop"></i>
                            <span style="margin-top: 10px">{{ $item->name }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-lg-12 text-center mt-5">
                <img src="{{ asset('search.svg') }}" width="300px" height="300px" alt="">
                <h4 class="mt-2">Oops!, data yang anda cari tidak ditemukan</h4>
                <h6>Coba cari dengan kata kunci yang mendekati</h6>
            </div>
        @endforelse
    </div>
</div>
