@extends('frontend.app')
@section('content')
    <div class="container mt-5 mb-5 px-4">

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Ringkasan Pemesanan</h4>
                        <hr>
                        <div class="table-responsive">

                            <div id="myTable">

                            </div>
                            <table id="" class="table table-striped">
                                <tr>
                                    <td colspan="2">
                                        <i>MASUKAN KODE KUPON</i>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Kode Kupon" id="kode_kupon" name="kode_kupon">
                                            <button onclick="cekDiskon()" class="input-group-text bg-primary text-white" id="basic-addon2">
                                                <i class="bi bi-search"></i>&nbsp; Cari
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>JUMLAH</td>
                                    <td class="text-end" id="total"></td>
                                </tr>
                                <tr>
                                    <td>DISKON</td>
                                    <td class="text-end" id="diskon">0</td>
                                </tr>
                                <tr>
                                    <td>GRAND TOTAL</td>
                                    <td class="text-end" id="grand_total"></td>
                                </tr>
                            </table>
                            *Pastikan pesanan anda sudah sesuai sebelum melakukan pembayaran
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>Data Pengguna</h4>
                        <hr>
                        <h6>Nama Lengkap <sup class="text-danger">*</sup></h6>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly>
                        <br>
                        <h6>Alamat Email <sup class="text-danger">*</sup></h6>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->email }}"
                            readonly>
                        <br>
                        <h6>Nomor Telegram / Whatsapp <sup class="text-danger">*</sup></h6>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->no_hp }}"
                            readonly>
                        <br>
                        <div id="tombol_pembayaran">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/frontend/cart.js') }}"></script>
@endpush
