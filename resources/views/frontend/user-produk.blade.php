@extends('frontend.app')
@section('content')
<style>
    .list-produk{
        padding: 5px !important;
    }
</style>
    <div class="container mt-5 mb-5 px-4">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item py-0" style="border: none;">
                                <a class="text-danger" href="{{ url('user-produk') }}?q=Ebook" style="text-decoration: none;">
                                    <h5><i class="bi bi-box-seam me-1"></i> Produk</h5>
                                </a>
                            </li>
                            <hr>
                            <li class="list-group-item py-0" style="border: none;">
                                <a href="" style="text-decoration: none;">
                                    <h5><i class="bi bi-file-earmark-text me-1"></i> Video</h5>
                                </a>
                            </li>
                            <hr>
                            <li class="list-group-item py-0" style="border: none;">
                                <a href="{{ url('transaksi') }}" style="text-decoration: none;">
                                    <h5><i class="bi bi-credit-card me-1"></i> Transaksi</h5>
                                </a>
                            </li>
                            <hr>
                            <li class="list-group-item py-0" style="border: none;">
                                <a href="{{ url('account') }}/{{ Auth::id() }}" style="text-decoration: none;">
                                    <h5><i class="bi bi-person me-1"></i> Profil</h5>
                                </a>
                            </li>
                            <hr>
                            <li class="list-group-item py-0" style="border: none;">
                                <a href="{{ url('logout') }}" style="text-decoration: none;">
                                    <h5><i class="bi bi-door-open me-1"></i> Logout</h5>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mb-4">
                <div class="card">
                    <div class="card-body py-2">
                        <h3><i class="bi bi-book"></i> {{ Request('q') }}</h3>
                    </div>
                </div>
                <div>
                    @include('frontend.components.list-user-produk', ['data' => $produk])
                </div>
            </div>
        </div>
    </div>
@endsection
