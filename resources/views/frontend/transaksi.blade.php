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
                                <a class="text-danger" href="{{ url('transaksi') }}" style="text-decoration: none;">
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
                <div class="card mb-2">
                    <div class="card-body py-2">
                        <h3><i class="bi bi-credit-card"></i> Transaksi</h3>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped" width="100%">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Invoice</th>
                                        <th>Tgl Transaksi</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th width="5%"></th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                </div>
                <div class="modal-body">
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="{{ config('app.midtrans_url') }}"
        data-client-key="{{ config('app.midtrans_client_key') }}"></script>
    <script src="{{ asset('js/frontend/transaksi.js') }}"></script>
@endpush
