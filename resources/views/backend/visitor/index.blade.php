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
                    <h3 class="font-weight-bold text-white">Data Visitor</h3>
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
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Address</th>
                                    <th>Detail</th>
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
                        render: function(data, type, row, meta){
                            return `
                                <b>Ip Address</b><br>${row.ip_address}<br><br>
                                <b>Location</b><br>${row.location}
                            `
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `
                                    <b>Page URL</b><br>${row.page_url}  <br><br>
                                    <div class="d-flex justify-content-between">
                                        <div class="mr-3">
                                            <b>Device</b><br>${row.device}  
                                        </div>
                                        <div class="mr-3">
                                            <b>Browser</b><br>${row.browser}
                                        </div>
                                        <div class="mr-3">
                                            <b>Provider</b><br>${row.provider}
                                        </div>
                                        <div class="mr-3">
                                            <b>OS</b><br>${row.os}
                                        </div>
                                        <div class="mr-3">
                                            <b>Time</b><br>${row.created_at}
                                        </div>
                                    </div>
                            `
                        }
                    }
                ]
            })
        }
    </script>
@endpush
