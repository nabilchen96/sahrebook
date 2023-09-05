@extends('frontend.app')
@section('content')
    <div class="container mt-5 mb-5 px-4">
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item py-0" style="border: none;">
                                <a href="{{ url('user-produk') }}?q=Ebook" style="text-decoration: none;">
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
                                    <h5><i class="bi bi-coin me-1"></i> Transaksi</h5>
                                </a>
                            </li>
                            <hr>
                            <li class="list-group-item py-0" style="border: none;">
                                <a class="text-danger" href="{{ url('account') }}/{{ Auth::id() }}"
                                    style="text-decoration: none;">
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
                <div class="card mb-2">
                    <div class="card-body py-2">
                        <h3><i class="bi bi-person"></i> Profil</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="form">
                            <label class="mb-1">Name <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                required>
                            <br>
                            <label class="mb-1">Email <sup class="text-danger">*</sup></label>
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                                required>
                            <br>
                            <label class="mb-1">Password</label>
                            <input type="password" class="form-control" name="password">
                            <span style="font-size: 12px;" class="text-info">*Diisi jika ingin merubah password</span>
                            <br><br>
                            <label class="mb-1">No WA/Telegram <sup class="text-danger">*</sup></label>
                            <input type="number" class="form-control" name="no_hp" value="{{ Auth::user()->no_hp }}">
                            <br>
                            <button id="tombol_kirim" type="submit" style="border-radius: 25px;" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/frontend/account.js') }}"></script>
@endpush
