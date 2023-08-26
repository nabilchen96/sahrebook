@extends('backend.app')
@push('menu')
    style="background: #232227 !important;"
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('skydash/vendors/quill/quill.snow.css') }}">
    <!-- atau -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@11.2.0/styles/default.min.css">


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
                    <h3 class="font-weight-bold text-white">Data Detail Produk</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card w-100">
                <div class="card-body">
                    <form id="form">
                        <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                        <div class="mb-3">
                            <label class="form-label">Judul Berita <sup class="text-danger">*</sup></label>
                            <input type="text" placeholder="Judul Berita" class="form-control" id="judul"
                                name="judul" required value="{{ $data->judul }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta Deskripsi <sup class="text-danger">*</sup></label>
                            <textarea maxlength="150" class="form-control" placeholder="Meta Deskripsi Max 150" name="meta_description" id="meta_description" cols="30" rows="5">{{$data->meta_description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori <sup class="text-danger">*</sup></label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option {{$data->kategori == 'PHP' ? 'selected' : ''}}>PHP</option>
                                <option {{$data->kategori == 'Javascript' ? 'selected' : ''}}>Javascript</option>
                                <option {{$data->kategori == 'Flutter' ? 'selected' : ''}}>Flutter</option>
                                <option {{$data->kategori == 'Wordpress' ? 'selected' : ''}}>Wordpress</option>
                                <option {{$data->kategori == 'Internet' ? 'selected' : ''}}>Internet</option>
                                <option {{$data->kategori == 'Laravel' ? 'selected' : ''}}>Laravel</option>
                                <option {{$data->kategori == 'Pemrograman' ? 'selected' : ''}}>Pemrograman</option>
                                <option {{$data->kategori == 'Teori' ? 'selected' : ''}}>Teori</option>
                                <option {{$data->kategori == 'Tips & Trick' ? 'selected' : ''}}>Tips & Trick</option>
                                <option {{$data->kategori == 'Error' ? 'selected' : ''}}>Error</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Berita <sup class="text-danger">*</sup></label>
                            <input type="file" placeholder="Gambar Berita" class="form-control" id="gambar"
                                name="gambar">
                            <br>
                            <div class="card shadow border"
                                style="
                                    background-size: cover; 
                                    background-position: center; 
                                    background-image: url('/gambar_berita/{{ $data->gambar }}'); 
                                    height: 100px; 
                                    width: 100px;">
                            </div>
                            <br>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi Pembahasan <sup class="text-danger">*</sup></label>
                            <div id="editor" style="height: 500px;">
                                <?php
                                $charactersToRemove = ['&Acirc;', '&acirc;', '&#157;', '&#140;', '&#156;', '&#143;', '&iuml;', '&cedil;', '&#143;'];
                                ?>
                                {{-- {!! $data->isi_detail_produk !!} --}}
                                {!! str_replace($charactersToRemove, '', $data->deskripsi) !!}
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
            strict: true,
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
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        header: [1, 2, 3, 4, 5, 6, false]
                    }],
                    ["clean"], // Opsi membersihkan format
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
            formData.append('id', document.getElementById('id').value)


            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: '/back/update-berita',
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
