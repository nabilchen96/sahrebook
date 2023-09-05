@extends('frontend.app')
@push('meta-description')
    <meta name="description" content="Sahrebook Website Belajar Pemrograman Mudah, Cepat, Lengkap dan Murah">
@endpush
@section('content')
    <div class="shadow"
        style="
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        background-image: linear-gradient(transparent, black),
            url('{{ asset('https://cdn.pixabay.com/photo/2018/08/18/13/25/gui-3614763_1280.png') }}') !important;
        min-height: 200px;
        ">
        <div class="container px-3 py-4">
            <div class="tentang text-white">
                <div style="margin-top: auto; margin-bottom: auto">
                    <h2>Daftar Produk</h2>
                    Temukan Produk Digital Lainnya
                </div>
                <!-- <img src="shop-illustration.svg" width="300px" alt="" /> -->
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            {{-- daftar produk  --}}
            <h4 class="px-3">Daftar Produk</h4>
            @include('frontend.components.list-produk', ['data' => $produk])

            <div class="mt-4 px-4">
                {{ $produk->links() }}
            </div>
        </div>
    </div>
@endsection
