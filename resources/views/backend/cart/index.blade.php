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
                    <h3 class="font-weight-bold text-white">Data Cart</h3>
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
                                    <th>Nama User</th>
                                    <th>Waktu Cart</th>
                                    <th width="300px">Produk</th>
                                    <th width="100px">Foto Produk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $k => $item)
                                    <tr>
                                        <td>{{ $k + 1 }}</td>
                                        <td>
                                            <i>
                                                Name: {{ $item->name }} <br>
                                                Phone: {{ $item->no_hp }} <br>
                                                Email: {{ $item->email }}
                                            </i>
                                        </td>
                                        <td>
                                            <b>Created at:</b> <br>
                                            {{ date('d-m-Y H:i:s', strtotime($item->updated_at)) }}
                                        </td>

                                        <td>
                                            {{ $item->judul_produk }} <br>
                                            <span class="my-2 badge bg-success text-white">{{ $item->jenis_produk }}</span><br>
                                            <i>Harga: Rp {{ number_format($item->harga) }}</i>
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
