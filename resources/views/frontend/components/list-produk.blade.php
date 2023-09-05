<div class="col-12 list-produk">
    <div class="row d-flex">
        @forelse ($data as $item)
            <div class="col-lg-3 col-md-6 px-3 mt-3">
                <a href="{{ url('produk-detail') }}/{{ $item->slug }}" style="text-decoration: none;"
                    class="card shadow mb-4">
                    {{-- @if ($item->pilihan_ukm == '1')
                        <span class="badge bg-danger"
                            style="width: fit-content;
                                    position: absolute;
                                    margin: 10px;">
                            <i class="bi bi-fire"></i>
                            Best Seller
                        </span>
                    @endif --}}
                    <span class="badge bg-primary"
                        style="width: fit-content;
                                    position: absolute;
                                    margin: 10px;">
                        <i class="bi bi-box-seam"></i>
                        {{ $item->jenis }}
                    </span>
                    <img class="img-fluid foto_produk" src="{{ asset('gambar_produk') }}/{{ $item->gambar_1 }}" />
                    <div class="card-body">
                        <div class="card-text" style="font-size: 14px">
                            <span class="judul_produk">{{ $item->judul_produk }}</span>
                            <p class="mt-2">
                                @if ($item->harga_asli != $item->harga)
                                    <s>Rp. {{ number_format($item->harga_asli) }}</s>
                                    <span class="badge bg-info" style="border-radius: 25px;">
                                        {{ (($item->harga_asli - $item->harga) / $item->harga_asli) * 100 }}%
                                    </span> <br>
                                    <b>Rp. {{ number_format($item->harga) }}</b>
                                @else
                                    <b>Rp. {{ number_format($item->harga_asli) }}</b> <br>
                                    <b class="text-white">Rp. {{ number_format($item->harga) }}</b>
                                @endif
                            </p>
                            <div class="nama_toko">
                                <i class="bi bi-person-circle"></i>
                                <span style="margin-top: 10px">{{ $item->name }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-lg-12 text-center mt-5">
                <img src="{{ asset('search.svg') }}" width="300px" height="300px" alt="">
                @if (Request('q'))
                    <h4>Oops!, anda belum memiliki {{ Request('q') }} apapun</h4>
                    <h6>Ayo cari ebook dulu disini <a href="{{ url('produk') }}">list ebook</a></h6>
                @else
                    <h4 class="mt-2">Oops!, produk yang anda cari tidak ditemukan</h4>
                    <h6>Coba cari dengan kata kunci yang mendekati</h6>
                @endif
            </div>
        @endforelse
    </div>
</div>
