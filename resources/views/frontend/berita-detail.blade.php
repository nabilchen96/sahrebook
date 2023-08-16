@extends('frontend.app')
@push('style')
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@10.7.2/styles/atom-one-dark.min.css">
    <style>
        .card-image {
            background-size: cover;
            /* background-repeat: no-repeat;  */
            background-position: center;
            height: 400px;
        }

        .card-image-small {
            background-size: cover;
            background-position: center;
            aspect-ratio: 1 / 1;
        }

        .social-share {
            position: fixed;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            z-index: 999;
        }

        .share-button {
            display: block;
            margin-bottom: 5px;
            background-color: #3b5998;
            /* Warna latar belakang Facebook */
            color: #fff;
            padding: 10px;
            text-decoration: none;
        }

        .share-button:hover {
            background-color: #2d4373;
            /* Warna latar belakang Facebook saat dihover */
        }

        .image-preview {
            position: sticky;
            top: 90px;
        }

        pre {
            /* padding: 0.2rem 0.4rem; */
            font-size: 14px;
            padding-top: 40px;
            /* padding-bottom: 30px; */
            background-color: #2c323c;
            position: relative;
            max-height: 500px
        }

        pre::before {
            padding-left: 20px !important;
            font-size: 16px;
            content: '💻 Script (Double Click untuk Menyeleksi Semua Kode)' !important;
            position: absolute;
            top: 0;
            background-color: #03a9f4;
            padding: 10px;
            left: 0;
            right: 0;
            color: #fff !important;
            text-transform: uppercase;
            display: block;
            font-weight: bold
        }
    </style>
    <style>
        .ql-align-center {
            text-align: center;
        }

        h4 {
            font-size: 1.5rem;
        }

        p br {
            display: none;
        }

        pre {
            /* padding: 0.2rem 0.4rem; */
            font-size: 14px;
            /* color: #fff; */
            /* background-color: #212529 !important; */
            /* border-radius: 0.2rem; */
            max-height: 500px;
        }
    </style>
@endpush
@section('content')
    <div class="social-share">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="share-button"
            style="font-size: 14px;" id="facebook-share">
            <i class="bi bi-facebook"></i>
        </a>
        <a style="background: #55acee;" target="_blank" href="https://twitter.com/intent/tweet?url={{ url()->current() }}"
            class="share-button" id="twitter-share">
            <i class="bi bi-twitter"></i>
        </a>
        <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
            class="share-button" id="linkedin-share">
            <i class="bi bi-linkedin"></i>
        </a>
        <a style="background: #CB2027;" target="_blank"
            href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}" class="share-button"
            id="pinterest-share">
            <i class="bi bi-pinterest"></i>
        </a>
        <a style="background: #25d366;" target="_blank" class="share-button"
            href="https://web.whatsapp.com/send?text=How to Make a Bubble Bottom Bar in Flutter | {{ url()->current() }}">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-lg-9">

                <div class="" style="min-height: 500px;">
                    <div class="card-body p-0">
                        <h1 style="font-size: 30px;" class="mb-3 mt-4">
                            {{ $detail->judul }}
                        </h1>
                        <i class="bi bi-shop"></i>
                        {{ $detail->name }} |
                        <i class="bi bi-calendar"></i>
                        {{ $detail->created_at }} |
                        <span class="badge bg-primary">{{ $detail->kategori }}</span><br><br>

                        <img width="100%" height="300px" class=""
                            style="border: none; border-radius: 15px; object-fit: cover;"
                            src="{{ asset('gambar_berita') }}/{{ $detail->gambar }}" alt="">



                        <div class="mt-5 w-100">

                            <?php
                            
                            $content = str_replace('<pre>', '<pre><code class="hljs">', $detail->deskripsi);
                            $content = str_replace('</pre>', '</code></pre>', $content);
                            
                            $charactersToRemove = ['&Acirc;', '&acirc;', '&#157;', '&#140;', '&#156;', '&#143;', '&iuml;', '&cedil;', '&#143;'];
                            ?>

                            {!! str_replace($charactersToRemove, '', $content) !!}

                        </div>

                        <h4 class="mt-5">Diskusi</h4>
                        @if (Auth::check())
                            <form id="form">
                                <input type="hidden" name="id_berita" id="id_berita">
                                <textarea name="pesan" id="pesan" class="form-control mb-4" cols="30" rows="5" placeholder="Diskusi"></textarea>
                                <button class="btn btn-primary" id="tombol_kirim">
                                    <i class="bi bi-send"></i> Kirim
                                </button>
                            </form>
                            <br /><br />
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-door-closed"></i> Login untuk mulai ikut berdiskusi
                            </div>
                        @endif
                        <div id="diskusi">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <h4 class="mt-4">Artikel Lainnya</h4>
                <a style="text-decoration: none;" href="{{ url('berita') }}">
                    Lihat Artikel Lainnya
                    <i class="bi bi-newspaper"></i>
                </a>
                @foreach ($berita as $item)
                    <a style="text-decoration: none;" href="{{ url('berita-detail') }}/{{ $item->slug }}">
                        <div class="card mt-3">
                            <div class="card-body p-2">
                                <div class="d-flex text-start">
                                    <img class="img-fluid border" src="{{ asset('gambar_berita') }}/{{ $item->gambar }}"
                                        style="
                                height: 80px;
                                border-radius: 10px;
                                width: 80px;
                                margin-right: 10px;
                                object-fit: cover;" />
                                    <div class="text-start">

                                        <span class="text-start badge bg-info">{{ $item->kategori }}</span>
                                        <p class="text-start mb-0 mt-2 judul_berita" style="height: fit-content;">
                                            {{ $item->judul }}
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

                <h4 class="mt-4">Kategori Artikel</h4>
                <?php
                $kategori = DB::table('beritas')
                    ->select('kategori')
                    ->groupBy('kategori')
                    ->get();
                ?>
                @foreach ($kategori as $item)
                    <div class="badge bg-info" style="margin-bottom: 5px; border-radius: 25px; font-size: 15px;">
                        {{ $item->kategori }}</div>
                @endforeach

                <h4 class="mt-4">Daftar Ebook</h4>
                <a style="text-decoration: none;" href="{{ url('produk') }}">
                    Lihat Ebook Lainnya
                    <i class="bi bi-bag"></i>
                </a>
                <?php
                $produk = DB::table('produks')->get();
                ?>
                @foreach ($produk as $item)
                    <a style="text-decoration: none;" href="{{ url('produk-detail') }}/{{ $item->slug }}"
                        class="card mt-3">
                        <div class="card-body p-2">
                            <div class="d-flex">
                                <img class="img-fluid border" src="{{ asset('gambar_produk') }}/{{ $item->gambar_1 }}"
                                    style="
                            height: 80px;
                            border-radius: 10px;
                            width: 80px;
                            margin-right: 10px;
                            object-fit: cover;" />
                                <div>


                                    <p class="mb-0 judul_berita" style="height: fit-content;">{{ $item->judul_produk }}
                                    </p>
                                    <p class="mb-0"><b>Rp. {{ number_format($item->harga) }}</b></p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/highlight.js@10.7.2/lib/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('dash-ui/assets/js/theme.min.js') }}"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            getData()
        })

        let url = window.location.href

        let newsSplit = url.split('/')
        let newsId = newsSplit[newsSplit.length - 1];

        document.getElementById('id_berita').value = newsId

        function getData() {
            axios.get('/back/diskusi-berita/' + newsId).then(function(res) {
                let data = res.data.data

                // console.log(data);

                let diskusi = ''

                data.forEach(e => {

                    diskusi += `<p style="font-size: 12px; margin-top: 20px; margin-bottom: 5px">
                                        <i class="bi bi-people"></i> ${e.name} |
                                        <i class="mx-1 bi bi-calendar"></i> ${e.created_at}
                                    </p>
                                    ${e.pesan}
                                    `
                });


                document.getElementById('diskusi').innerHTML = diskusi
            })
        }

        form.onsubmit = (e) => {

            let formData = new FormData(form);

            e.preventDefault();

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: '/back/store-diskusi-berita',
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

                        document.getElementById("form").reset();
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
                    document.getElementById("tombol_kirim").disabled = false;
                });
        }
    </script>
    <script>
        var imgElements = document.querySelectorAll('.card-body img');

        // Loop through each <img> element and add the desired class
        imgElements.forEach(function(imgElement) {
            imgElement.classList.add('img-fluid');
            // imgElement.classList.add('shadow');
        });
    </script>
    <script>
        var pres = document.getElementsByTagName("pre");
        for (var i = 0; i < pres.length; i++) {
            pres[i].addEventListener("dblclick", function() {
                var selection = getSelection();
                var range = document.createRange();
                range.selectNodeContents(this);
                selection.removeAllRanges();
                selection.addRange(range);
            }, false);
        }
    </script>
@endpush
