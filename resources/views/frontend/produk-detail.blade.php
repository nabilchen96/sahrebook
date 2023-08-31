@extends('frontend.app')
@push('style')
    <style>
        .card-image {
            background-size: cover;
            /* background-repeat: no-repeat;  */
            background-position: center;
            height: 400px;
        }

        .card-image-small {
            background-size: cover;
            background-position: center;
            aspect-ratio: 1 / 1;
        }

        .social-share {
            position: fixed;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            z-index: 999;
        }

        .share-button {
            display: block;
            margin-bottom: 5px;
            background-color: #3b5998;
            /* Warna latar belakang Facebook */
            color: #fff;
            padding: 10px;
            text-decoration: none;
        }

        .share-button:hover {
            background-color: #2d4373;
            /* Warna latar belakang Facebook saat dihover */
        }

        .image-preview {
            position: sticky;
            top: 90px;
        }
    </style>
    <style>
        .rate {
            float: left;
            height: 46px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .star-rating-complete {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rated:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ffc700;
        }

        .rated:not(:checked)>label:before {
            content: '★ ';
        }

        .rated>input:checked~label {
            color: #ffc700;
        }

        .rated:not(:checked)>label:hover,
        .rated:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rated>input:checked+label:hover,
        .rated>input:checked+label:hover~label,
        .rated>input:checked~label:hover,
        .rated>input:checked~label:hover~label,
        .rated>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
@endpush
@section('content')
    <div class="social-share">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="share-button"
            style="font-size: 14px;" id="facebook-share">
            <i class="bi bi-facebook"></i>
        </a>
        <a style="background: #55acee;" target="_blank" href="https://twitter.com/intent/tweet?url={{ url()->current() }}"
            class="share-button" id="twitter-share">
            <i class="bi bi-twitter"></i>
        </a>
        <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
            class="share-button" id="linkedin-share">
            <i class="bi bi-linkedin"></i>
        </a>
        <a style="background: #CB2027;" target="_blank"
            href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}" class="share-button"
            id="pinterest-share">
            <i class="bi bi-pinterest"></i>
        </a>
        <a style="background: #25d366;" target="_blank" class="share-button"
            href="https://web.whatsapp.com/send?text=How to Make a Bubble Bottom Bar in Flutter | {{ url()->current() }}">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>
    <div class="container d-flex justify-content-between mt-4 mb-5">
        <div class="row">
            <div class="col-lg-4 pe-4">
                <div class="image-preview">
                    <a href="" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-bs-whatever="{{ asset('gambar_produk') }}/{{ $detail->gambar_1 }}">
                        <div style="background-image: url('{{ asset('gambar_produk') }}/{{ $detail->gambar_1 }}');"
                            class="card card-image shadow">
                        </div>
                    </a>
                    <div class="row mt-3">
                        @if ($detail->gambar_2)
                            <div class="col-2 mb-3" style="padding: 0 0 0 10px">
                                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-bs-whatever="{{ asset('gambar_produk') }}/{{ $detail->gambar_2 }}">
                                    <div style="background-image: url('{{ asset('gambar_produk') }}/{{ $detail->gambar_2 }}');"
                                        class="shadow card card-image-small">
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if ($detail->gambar_3)
                            <div class="col-2 mb-3" style="padding: 0 0 0 10px">
                                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-bs-whatever="{{ asset('gambar_produk') }}/{{ $detail->gambar_3 }}">
                                    <div style="background-image: url('{{ asset('gambar_produk') }}/{{ $detail->gambar_3 }}');"
                                        class="shadow card card-image-small">
                                    </div>
                                </a>
                            </div>
                        @endif
                        @if ($detail->gambar_4)
                            <div class="col-2 mb-3" style="padding: 0 0 0 10px">
                                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-bs-whatever="{{ asset('gambar_produk') }}/{{ $detail->gambar_4 }}">
                                    <div style="background-image: url('{{ asset('gambar_produk') }}/{{ $detail->gambar_4 }}');"
                                        class="shadow card card-image-small">
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                    <br><br>
                </div>
            </div>
            <div class="col-lg-8 px-4">
                <div class="" style="min-height: 500px">
                    <div class="card-body p-0 ">
                        <div>
                            <h4>{{ $detail->judul_produk }}</h4>
                            <span class="badge bg-primary mb-2">{{ $detail->jenis_produk }}</span>
                            @if ($detail->pilihan_ukm == '1')
                                <span class="badge bg-danger mb-2">
                                    <i class="bi bi-fire"></i>
                                    Pilihan UKM
                                </span>
                            @endif
                            <p>
                                @if ($detail->harga_asli != $detail->harga)
                                    <s>Rp. {{ number_format($detail->harga_asli) }}</s> 
                                    <span class="badge bg-info" style="border-radius: 25px;">
                                        {{ (($detail->harga_asli - $detail->harga) / $detail->harga_asli) * 100 }}%
                                    </span> <br>
                                    <b>Rp. {{ number_format($detail->harga) }}</b>
                                @else
                                    <b>Rp. {{ number_format($detail->harga_asli) }}</b> <br>
                                    {{-- <b class="text-white">Rp. {{ number_format($detail->harga) }}</b> --}}
                                @endif
                            </p>
                            
                            <a style="text-decoration: none;" href="{{ url('profil') }}/{{ $detail->id_user }}">
                                <i class="bi bi-person-circle"></i>
                                {{ $detail->name }}
                            </a>
                            <br />

                            @if (Auth::check())
                                <?php
                                
                                $cek = DB::table('tagihans as t')
                                    ->join('detail_tagihans as dt', 'dt.id_tagihan', '=', 't.id')
                                    ->where('dt.id_produk', $detail->id)
                                    ->where('t.id_user', Auth::id())
                                    ->where('t.status', 'PAID')
                                    ->count();
                                
                                ?>
                                @if ($cek > 0)
                                    <a href="{{ url('belajar') }}/{{ $detail->id }}" class="mt-3 btn btn-sm btn-danger"
                                        style="border-radius: 50px">
                                        <i class="bi bi-eye"></i> Mulai Belajar
                                    </a>
                                @else
                                    <button onclick="toCart({{ $detail->id }})" class="mt-3 btn btn-sm btn-danger"
                                        style="border-radius: 50px">
                                        <i class="bi bi-cart"></i> Beli
                                    </button>
                                @endif
                            @else
                                <a href="{{ url('login') }}" class="mt-3 btn btn-sm btn-danger"
                                    style="border-radius: 50px">
                                    <i class="bi bi-cart"></i> Login untuk beli
                                </a>
                            @endif
                            <a href="https://wa.me/6281271449921?text=Halo%20saya%20tertarik%20untuk%20bertanya%20tentang%20ebook%20{{ $detail->judul_produk }} dari {{ url('') }}/{{ $detail->slug }}"
                                class="mt-3 btn btn-sm btn-success" style="border-radius: 50px">
                                <i class="bi bi-whatsapp"></i> Hubungi
                            </a>

                            <br /><br />
                            <hr>
                            <b>Deskripsi</b>
                            <p>
                                <?php echo nl2br($detail->deskripsi); ?>
                            </p>
                            <br>
                            <hr>
                            <h4 class="mt-5">Review</h4>
                            <form id="form">
                                @if (Auth::check())
                                    <input type="hidden" name="id_produk" id="id_produk" value="{{ $detail->id }}">
                                    <input type="hidden" name="slug" id="slug">
                                    <div class="col">
                                        <div class="rate">
                                            <input type="radio" id="star5" class="rate" name="rating"
                                                value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" checked id="star4" class="rate" name="rating"
                                                value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" class="rate" name="rating"
                                                value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" class="rate" name="rating"
                                                value="2">
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" class="rate" name="rating"
                                                value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                        </div>
                        <textarea name="pesan" id="pesan" class="form-control mb-4" cols="30" rows="5"
                            placeholder="Tulis Review Anda Disini"></textarea>
                        <button class="btn btn-primary" id="tombol_kirim">
                            <i class="bi bi-send"></i> Kirim
                        </button>

                        <br /><br />
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-door-closed"></i> Login untuk mulai ikut berdiskusi
                        </div>
                        @endif
                        </form>
                        <div id="diskusi" class="mb-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    <div class="container mt-5">
        <div class="row">
            {{-- daftar produk --}}
            <h4 class="px-4">Daftar Ebook</h4>
            @include('frontend.components.list-produk', ['data' => $produk])

        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div id="foto" style="margin-left: auto; margin-right: auto;">
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/frontend/produk-detail.js') }}"></script>
@endpush
