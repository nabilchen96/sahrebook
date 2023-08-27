<div class="bg-primary mt-5">
    <div class="container">
        <div class="col-12 list-produk">
            <div class="row d-flex">
                <div class="col-lg-3 pt-5">
                    <div class="px-1">
                        <h3 class="text-white">Daftar Sekarang</h3>
                        <p class="text-white">
                            Ambil Keputusan Cepat dengan Belajar cepat disini.
                            Ayo gabung dan buat komunitasmu disini.
                        </p>
                        <a href="{{ url('produk') }}" style="border-radius: 25px;" class="text-white mt-4 btn btn-sm btn-info">
                            Daftar Ebook
                        </a>
                        <a href="{{ url('register') }}" style="border-radius: 25px;" class="text-white mt-4 btn btn-sm btn-warning">
                            Register!
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 pt-5 pb-4">
                    <ul class="nav nav-lt-tab">
                        @foreach ($data as $item)
                            <li class="nav-item px-2" style="width: 300px;">
                                <div class="card">
                                    <div class="card-body testimony-text" style="white-space: normal;">
                                        <p>{{ (strlen($item->pesan) > 116) ? substr($item->pesan, 0, 116) . "..." : $item->pesan }}
                                        </p>
                                        <p class="mb-0 mt-4" style="position: absolute; bottom: 15px; font-size: 12px;">
                                             <a style="text-decoration: none; " href="{{ $item->slug }}">{{$item->judul_produk}}</a> | 
                                            {{$item->name}}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
