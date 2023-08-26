@extends('backend.app')
@push('menu')
    style="background: #232227 !important;"
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('skydash/vendors/quill/quill.snow.css') }}">
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

        code {
            padding: 0.2rem 0.4rem;
            font-size: 87.5%;
            color: #fff;
            background-color: #212529 !important;
            border-radius: 0.2rem;
        }

        h4 {
            font-size: 1.5rem !important;
        }
    </style>
@endpush
@section('content')
    <div class="row" style="margin-top: -200px;">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-xl-8 mb-xl-0">
                    <h3 class="font-weight-bold text-white">Tambah Berita</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <form id="form">
                        <div class="mb-3">
                            <label class="form-label">Judul Berita <sup class="text-danger">*</sup></label>
                            <input type="text" placeholder="Judul Berita" class="form-control" id="judul"
                                name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Deskripsi <sup class="text-danger">*</sup></label>
                            <textarea maxlength="150" class="form-control" placeholder="Meta Deskripsi Max 150" name="meta_description" id="meta_description" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori <sup class="text-danger">*</sup></label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option>PHP</option>
                                <option>Javascript</option>
                                <option>Flutter</option>
                                <option>Wordpress</option>
                                <option>Internet</option>
                                <option>Laravel</option>
                                <option>Pemrograman</option>
                                <option>Teori</option>
                                <option>Tips & Trick</option>
                                <option>Error</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Berita <sup class="text-danger">*</sup></label>
                            <input type="file" placeholder="Gambar Berita" class="form-control" id="gambar"
                                name="gambar" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi Berita <sup class="text-danger">*</sup></label>
                            <div id="editor" style="height: 500px;">
                            </div>
                        </div>
                        <button id="tombol_kirim" class="btn btn-sm btn-primary" style="border-radius: 25px;">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('skydash/vendors/quill/quill.min.js') }}"></script>

    <script>
        var quill = new Quill("#editor", {
            theme: "snow",
            modules: {
                toolbar: [
                    [{
                        'align': []
                    }],
                    ["bold", "italic", "underline", "strike"], // Opsi format teks
                    ["link", "image"], // Opsi media
                    [{
                        list: "ordered"
                    }, {
                        list: "bullet"
                    }], // Opsi daftar
                    ["blockquote", "code-block"],
                    ["clean"], // Opsi membersihkan format
                    [{
                        header: [1, 2, 3, 4, 5, 6, false]
                    }],
                    ["word-counter"], // Opsi batas jumlah kata
                    ["spell-checker"], // Opsi alat bantu penulisan
                ],
            },
        });
    </script>

    <script>
        form.onsubmit = (e) => {

            let formData = new FormData(form);
            e.preventDefault();

            var selectedImage = document.getElementById('gambar').files[0];

            // var FormData = new FormData(form);
            formData.append('judul', document.getElementById('judul').value);
            formData.append('deskripsi', quill.root.innerHTML);
            formData.append('gambar', selectedImage); // Tambahkan gambar ke FormData
            formData.append('kategori', document.getElementById('kategori').value);


            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: '/back/store-berita',
                    data: formData,
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
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

                    } else {
                        //error validation
                    }

                    document.getElementById("tombol_kirim").disabled = false;
                })
                .catch(function(res) {
                    //handle error
                    console.log(res);
                });
        }
    </script>
@endpush
