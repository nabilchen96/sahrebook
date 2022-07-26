<div class="col-lg-12 px-4">
    <div class="row">
        @forelse ($data as $item)
            <div class="col-lg-3 col-6 mt-4">
                <a href="{{ url('produk-detail') }}/{{ $item->id }}" style="text-decoration: none;"
                    class="card shadow">
                    <img class="foto_produk" src="{{ asset('gambar_produk') }}/{{ $item->gambar_1 }}" />
                    <div class="card-body">
                        <div class="card-text" style="font-size: 14px">
                            <span class="judul_produk">{{ $item->judul_produk }}</span>
                            <p class="mt-2"><b>Rp. {{ number_format($item->harga) }}</b></p>
                            <div class="nama_toko">
                                <i class="bi bi-shop"></i>
                                <span style="margin-top: 10px">{{ $item->name }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
        <div class="col-lg-12 text-center mt-5">
            <img src="{{ asset('search.svg') }}" width="300px" height="300px" alt="">
            <h4 class="mt-2">Oop!, data yang anda cari tidak ditemukan</h4>
            <h6>Coba cari dengan kata kunci yang mendekati</h6>
        </div>
        @endforelse
    </div>
</div>
