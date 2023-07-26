@extends('backend.app')
@push('style')
    <style>
        #myTable_filter input {
            height: 29.67px !important;
        }

        #myTable_length select {
            height: 29.67px !important;
        }

        .btn {
            border-radius: 50px !important;
        }
    </style>
@endpush
@section('content')
    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 mb-xl-0">
                    <h3 class="font-weight-bold text-white">Data Tagihan</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped" style="width: 100%;">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Invoice</th>
                                    <th>Tgl Transaksi</th>
                                    <th>Detail</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $k => $item)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>
                                            <b>{{ $item->invoice }}</b> <br><br>
                                            <i>
                                                nama: {{ $item->name }} <br>
                                                phone: {{ $item->no_hp }} <br>
                                                email: {{ $item->email }}
                                            </i>
                                            <br><br>
                                            @if ($item->status == 'PAID')
                                                <span class="badge bg-success text-white">{{ $item->status }}</span>
                                            @else
                                                <span class="badge bg-danger text-white">{{ $item->status }}</span>
                                                <a href="{{ url('/back/bayar') }}/{{ $item->id_tagihan }}" class="badge bg-primary text-white">Bayar!</a>
                                            @endif
                                        </td>
                                        <td>
                                            <b>Created at:</b> <br>
                                            {{ date('d-m-Y H:i:s', strtotime($item->tagihan_created)) }}
                                            <br><br>

                                            @if ($item->tagihan_created != $item->tagihan_updated)
                                                <b>Updated at:</b> <br>
                                                {{ date('d-m-Y H:i:s', strtotime($item->tagihan_updated)) }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->judul_produk }} <br><br>
                                            <i>
                                                <b>Harga: Rp {{ number_format($item->harga) }} <br>
                                                    Diskon: Rp {{ number_format($item->diskon) }}</b>
                                            </i>
                                        </td>
                                        <td>
                                            <div class="card shadow"
                                                style="
                                                background-size: cover; 
                                                background-position: center; 
                                                background-image: url('/gambar_produk/{{ $item->gambar_1 }}'); 
                                                width: 100px;
                                                height: 100px;">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            getData()
        })

        function getData() {
            $("#myTable").DataTable({
                "ordering": false,
            })
        }
    </script>
@endpush
