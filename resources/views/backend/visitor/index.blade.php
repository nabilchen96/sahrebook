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

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #9e9e9e21 !important;
        }
    </style>
@endpush
@section('content')
    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 mb-xl-0">
                    <h3 class="font-weight-bold text-white">Data Page View</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-6 my-2">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="text-center">
                                        <span class="">Semua</span><br>
                                        <span class="mt-2 badge bg-success text-white">
                                            <b>{{ $totalSemua }}</b> 
                                            <i class="text-white  ml-1 bi bi-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 my-2">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="text-center">
                                        <span class="">Hari Ini</span><br>
                                        <span class="mt-2 badge bg-success text-white">
                                            <b>{{ $totalHariIni }}</b> 
                                            <i class="text-white  ml-1 bi bi-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 my-2">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="text-center">
                                        <span class="">Kemarin</span><br>
                                        <span class="mt-2 badge bg-success text-white">
                                            <b>{{ $totalKemarin }}</b> 
                                            <i class="text-white  ml-1 bi bi-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 my-2">
                            <div class="card border">
                                <div class="card-body">
                                    <div class="text-center">
                                        <span class="">Bulan Ini</span><br>
                                        <span class="mt-2 badge bg-success text-white">
                                            <b>{{ $totalBulanIni }}</b> 
                                            <i class="text-white  ml-1 bi bi-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="card w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped" style="width: 100%;">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="5%" class="text-center">View</th>
                                    <th>URL</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
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
                ajax: '/back/data-visitor',
                processing: true,
                'language': {
                    'loadingRecords': '&nbsp;',
                    'processing': 'Loading...'
                },
                columns: [{
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<div class="text-center">
                                    <span class="badge bg-success text-white">${row.total}</span>
                                </div>`
                        }
                    },
                    {
                        render: function(data, type, row, meta){
                            return `${row.page_url}`
                        }
                    },
                    {
                        render: function(data, type, row, meta){
                            return `<i class="bi bi-grid text-success" style="font-size: 1.5rem;"></i>`
                        }
                    },
                ]
            })
        }
    </script>
@endpush
