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
                    <h3 class="font-weight-bold text-white">Data Produk</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#modal">
                        Tambah
                    </button>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped" style="width: 100%;">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Gambar</th>
                                    <th>Keterangan</th>
                                    <th width="15%">Harga</th>
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
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form">
                    <div class="modal-header p-3">
                        <h5 class="modal-title m-2" id="exampleModalLabel">Produk Form</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input name="judul_produk" id="judul_produk" type="text" placeholder="judul"
                                class="form-control">
                            <span class="text-danger error" style="font-size: 12px;" id="email_alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control" placeholder="keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jenis Produk</label>
                            <select name="jenis" class="form-control" id="jenis" required>
                                <option>Ebook</option>
                                <option>Video</option>
                                <option>Source Code</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Sub Jenis Produk</label>
                            <select name="jenis_produk" class="form-control" id="jenis_produk" required>
                                <option>Flutter</option>
                                <option>Laravel</option>
                                <option>Vue Js</option>
                                <option>React</option>
                                <option>PHP</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Harga Asli</label>
                            <input name="harga_asli" id="harga_asli" type="number" placeholder="Harga Asli" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Harga Diskon</label>
                            <input name="harga" id="harga" type="number" placeholder="Harga" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gambar 1 <span class="text-danger" style="font-size: 12px;">(Max size:
                                    500kb)</span></label>
                            <input name="gambar_1" id="gambar_1" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gambar 2 <span class="text-danger" style="font-size: 12px;">(Max size:
                                    500kb)</span></label>
                            <input name="gambar_2" id="gambar_2" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gambar 3 <span class="text-danger" style="font-size: 12px;">(Max size:
                                    500kb)</span></label>
                            <input name="gambar_3" id="gambar_3" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gambar 4 <span class="text-danger" style="font-size: 12px;">(Max size:
                                    500kb)</span></label>
                            <input name="gambar_4" id="gambar_4" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gambar 5 <span class="text-danger" style="font-size: 12px;">(Max size:
                                    500kb)</span></label>
                            <input name="gambar_5" id="gambar_5" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gambar 6 <span class="text-danger" style="font-size: 12px;">(Max size:
                                    500kb)</span></label>
                            <input name="gambar_6" id="gambar_6" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Status Produk</label>
                            <select name="status_produk" class="form-control" id="status_produk">
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer p-3">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        <button id="tombol_kirim" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
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
                ajax: '/back/data-product',
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
                            return `<div class="row">
                                     <div class="col-6 p-1">
                                            <div class="card shadow" style="
                                                background-size: cover; 
                                                background-position: center; 
                                                background-image: url('/gambar_produk/${row.gambar_1}'); 
                                                aspect-ratio: 1/1; 
                                                width: 100%;"></div>
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="card shadow" style="
                                                background-size: cover; 
                                                background-position: center; 
                                                background-image: url('/gambar_produk/${row.gambar_2}'); 
                                                aspect-ratio: 1/1; 
                                                width: 100%;"></div>
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="card shadow" style="
                                                background-size: cover; 
                                                background-position: center; 
                                                background-image: url('/gambar_produk/${row.gambar_3}'); 
                                                aspect-ratio: 1/1; 
                                                width: 100%;"></div>
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="card shadow" style="
                                                background-size: cover; 
                                                background-position: center; 
                                                background-image: url('/gambar_produk/${row.gambar_4}'); 
                                                aspect-ratio: 1/1; 
                                                width: 100%;"></div>
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="card shadow" style="
                                                background-size: cover; 
                                                background-position: center; 
                                                background-image: url('/gambar_produk/${row.gambar_5}'); 
                                                aspect-ratio: 1/1; 
                                                width: 100%;"></div>
                                        </div>
                                        <div class="col-6 p-1">
                                            <div class="card shadow" style="
                                                background-size: cover; 
                                                background-position: center; 
                                                background-image: url('/gambar_produk/${row.gambar_6}'); 
                                                aspect-ratio: 1/1; 
                                                width: 100%;"></div>
                                        </div>
                                    </div>`
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `${row.judul_produk.slice(0, 55)} ... <br><br> 
                                    <b>Deskripsi:</b><br>${row.deskripsi.slice(0, 150)} ... <br><br>
                                    <b>Dibuat</b><br>
                                    ${row.created_at} <br><br>
                                    
                                    <span class="badge bg-info text-white"><i class="bi bi-box-seam"></i> ${row.jenis}</span>
                                    `
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `
                                <b>Sub Jenis</b>
                                <br> ${row.jenis_produk} <br><hr>

                                <b>Harga Asli</b>
                                <br> Rp. ${new Intl.NumberFormat().format(row.harga_asli)}<br><br> 

                                <b>Harga Diskon</b>
                                <br> Rp. ${row.harga == row.harga_asli ? 0 : new Intl.NumberFormat().format(row.harga)}

                                <br><br>
                                ${row.status_produk == 'Aktif' 
                                ? '<span class="badge bg-info text-white"><i class="bi bi-check-circle"></i> Aktif</span>' 
                                : '<span class="badge bg-danger text-white"><i class="bi bi-x-circle"></i> Tidak Aktif</span>'}
                                `

                        }
                    },
                    {
                        render: function(data, type, row, meta) {

                            @if (Auth::user()->role == 'Admin')
                                
                                if (row.pilihan_ukm == "1") {
                                    
                                    return `<a href="javascript:void(0)" onclick="pilihanUKMData(${row.id},${row.pilihan_ukm})">
                                            <i style="font-size: 1.5rem;" class="text-danger bi bi-fire"></i>
                                        </a><br><br>
                                                <a href="/back/detail-product/${row.id}" class="text-primary">
                                            <i class="bi bi-folder2-open" style="font-size: 1.5rem;"></i>
                                        </a>`
                                } else {
                                    return `<a href="javascript:void(0)" onclick="pilihanUKMData(${row.id},${row.pilihan_ukm})">
                                            <i style="font-size: 1.5rem;" class="text-secondary bi bi-fire"></i>
                                                </a><br><br>
                                                <a href="/back/detail-product/${row.id}" class="text-primary">
                                            <i class="bi bi-folder2-open" style="font-size: 1.5rem;"></i>
                                        </a>`
                                }
                            @endif
                        }
                    },
                    {
                        render: function(data, type, row, meta) {
                            return `<a data-toggle="modal" data-target="#modal"
                                    data-bs-id=` + (row.id) + ` href="javascript:void(0)">
                                    <i style="font-size: 1.5rem;" class="text-success bi bi-grid"></i>
                                </a><br><br>
                                <a href="javascript:void(0)" onclick="hapusData(` + (row
                                .id) + `)">
                                    <i style="font-size: 1.5rem;" class="text-danger bi bi-trash"></i>
                                </a>`
                        }
                    },
                ]
            })
        }

        $('#modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('bs-id') // Extract info from data-* attributes
            var cok = $("#myTable").DataTable().rows().data().toArray()

            let cokData = cok.filter((dt) => {
                return dt.id == recipient;
            })

            document.getElementById("form").reset();
            document.getElementById('id').value = ''
            $('.error').empty();

            if (recipient) {
                var modal = $(this)
                modal.find('#id').val(cokData[0].id)
                modal.find('#judul_produk').val(cokData[0].judul_produk)
                modal.find('#deskripsi').val(cokData[0].deskripsi)
                modal.find('#harga').val(cokData[0].harga)
                modal.find('#jenis_produk').val(cokData[0].jenis_produk)
                modal.find('#jenis').val(cokData[0].jenis)
                modal.find('#harga_asli').val(cokData[0].harga_asli)
                modal.find('#status_produk').val(cokData[0].status_produk)
            }
        })

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: formData.get('id') == '' ? '/back/store-product' : '/back/update-product',
                    data: formData,
                })
                .then(function(res) {
                    //handle success         
                    if (res.data.responCode == 1) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: res.data.respon,
                            timer: 3000,
                            showConfirmButton: false
                        })

                        $("#modal").modal("hide");
                        $('#myTable').DataTable().clear().destroy();
                        getData()

                    } else {
                        //error validation
                        // document.getElementById('password_alert').innerHTML = res.data.respon.password ?? ''
                        // document.getElementById('email_alert').innerHTML = res.data.respon.email ?? ''
                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function(res) {
                    //handle error
                    console.log(res);
                });
        }

        hapusData = (id) => {
            Swal.fire({
                title: "Yakin hapus data?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"

            }).then((result) => {

                if (result.value) {
                    axios.post('/back/delete-product', {
                            id
                        })
                        .then((response) => {
                            if (response.data.responCode == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    timer: 2000,
                                    showConfirmButton: false
                                })

                                $('#myTable').DataTable().clear().destroy();
                                getData();

                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Gagal...',
                                    text: response.data.respon,
                                })
                            }
                        }, (error) => {
                            console.log(error);
                        });
                }

            });
        }

        pilihanUKMData = (id, pilihan_ukm) => {
            Swal.fire({
                title: pilihan_ukm == '1' ? 'Ingin membatalkan data ini?' : 'Ingin memilih data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonColor: '#3085d6',
                cancelButtonText: "Batal"

            }).then((result) => {

                if (result.value) {
                    axios.post('/back/pilihan-UKM-product', {
                            id
                        })
                        .then((response) => {
                            if (response.data.responCode == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    timer: 2000,
                                    showConfirmButton: false
                                })

                                $('#myTable').DataTable().clear().destroy();
                                getData();

                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Gagal...',
                                    text: response.data.respon,
                                })
                            }
                        }, (error) => {
                            console.log(error);
                        });
                }

            });
        }
    </script>
@endpush
