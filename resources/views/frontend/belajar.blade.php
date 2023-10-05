<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('dash-ui/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" />
    <link rel="shortcut icon" href="{{ asset('sahretech.png') }}" />
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('dash-ui/assets/css/theme.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@10.7.2/styles/atom-one-dark.min.css">

    <title>SAHRE BOOK</title>
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

        img {
            border: 1px solid #858d9399;
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

        .w-100>ol>li {
            margin-bottom: 10px;
            padding-right: 2rem;
        }

        .img-fluid {
            margin-bottom: 50px !important;
        }

        .navbar-vertical .navbar-nav .nav .nav-item .nav-link:before {
            background-color: white !important;
            border-radius: 10px !important;
            content: "" !important;
            height: 4px !important;
            left: 37px !important;
            position: absolute !important;
            top: 15px !important;
            transition: all .4s ease-in-out !important;
            width: 4px !important;
        }

        .front-icon {
            /* left: 37px !important; */
            top: 8px !important;
            /* height: 55px; */
            position: absolute;
            /* margin-top: -31px; */
        }

        .navbar-vertical .navbar-nav .nav-item .nav-link[data-bs-toggle=collapse]:after {
            top: 10px;
        }

        .navbar-vertical .navbar-nav .nav-item .nav-link.not-collapse[data-bs-toggle=collapse]:after {
            display: none;
        }
    </style>
</head>

<body>
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->
        <nav class="navbar-vertical navbar">
            <div class="nav-scroller">
                <!-- Brand logo -->
                <a style="margin-top: 3px;" class="navbar-brand" href="{{ url('/user-produk?q=Ebook') }}">
                    <h4 class="text-white">
                        <i class="bi bi-arrow-left"></i> Back to Account
                    </h4>
                </a>
                <!-- Navbar nav -->
                <ul class="navbar-nav flex-column" id="sideNavbar">
                    @foreach ($data->groupBy('kategori') as $kategori => $item)
                        @if (empty($kategori))
                            {{-- <li class="nav-item">
                                <a class="nav-link text-white not-collapse" href="#!" data-bs-toggle="collapse">
                                    <i class="front-icon bi bi-file-earmark-text"></i> &nbsp;
                                    <span
                                        style="white-space: normal; margin-left: 19px !important; margin-right: 15px;">
                                        {{ $item->judul_detail_produk }}
                                    </span>
                                </a>
                                <hr class="mx-4 my-1" style="color: white;" />
                            </li> --}}
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white has-arrow" href="#!"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#nav{{ preg_replace('/[^A-Za-z0-9]/', '', $kategori) }}"
                                    aria-expanded="false" aria-controls="navEmail">
                                    <i class="front-icon bi bi-file-earmark-text"></i>
                                    <span
                                        style="white-space: normal; margin-left: 19px !important; margin-right: 15px;">
                                        &nbsp; {{ $kategori }}
                                    </span>
                                </a>

                                <div id="nav{{ preg_replace('/[^A-Za-z0-9]/', '', $kategori) }}" class="collapse
                                    {{ Request('k') == preg_replace('/[^A-Za-z0-9]/', '', $kategori) ? 'show' : '' }}"
                                    data-bs-parent="#sideNavbar">
                                    <ul style="font-size: 14px;" class="custom-list nav flex-column">
                                        @foreach ($item as $item)
                                            <li class="nav-item">
                                                <a class="nav-link has-arrow sub-nav {{ Request('p') == $item->id ? 'text-warning' : 'text-white' }}"
                                                    style="margin-left: 8px; white-space: normal; position: relative;"
                                                    href="{{ url('belajar') }}/{{ $id }}?k={{ preg_replace('/[^A-Za-z0-9]/', '', $kategori) }}&p={{ $item->id }}#{{ $item->id }}">
                                                    {{ $item->judul_detail_produk }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <hr class="mx-4 my-1" style="color: white;">
                        @endif
                    @endforeach
                    @foreach ($data->where('kategori', null) as $kategori => $item)
                        <a href="{{ url('belajar') }}/{{ $id }}?p={{ $item->id }}#{{ $item->id }}">
                            <li class="nav-item" id="{{ $item->id }}">
                                <span class="nav-link {{ Request('p') == $item->id ? 'text-warning' : 'text-white' }} not-collapse"
                                    data-bs-toggle="collapse">
                                    <i class="front-icon bi bi-file-earmark-text"></i> &nbsp;
                                    <span style="white-space: normal; margin-left: 19px !important; margin-right: 10px;">
                                        {{ $item->judul_detail_produk }}
                                    </span>
                                </span>
                                <hr class="mx-4 my-1" style="color: white;" />
                            </li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </nav>
        <!-- Page content -->
        <div id="page-content">
            <div class="header @@classList">
                <!-- navbar -->
                <nav class="navbar-classic navbar navbar-expand-lg">
                    <a class="btn btn-sm btn-primary text-white" id="nav-toggle" href="#">
                        <i class="bi bi-list"></i>
                    </a>
                </nav>
            </div>
            <div class="container-fluid px-4 mt-4">
                <div class="card" style="border: none;">
                    <div class="card-body p-5">
                        <h2>🚀 {{ $konten->judul_detail_produk }}</h2>
                        <hr>
                        <div class="w-100">

                            <?php
                            
                            $content = str_replace('<pre>', '<pre><code class="hljs">', $konten->isi_detail_produk);
                            $content = str_replace('</pre>', '</code></pre>', $content);
                            
                            $charactersToRemove = ['&Acirc;', '&acirc;', '&#157;', '&#140;', '&#156;', '&#143;', '&iuml;', '&cedil;', '&#143;'];
                            ?>

                            {!! str_replace($charactersToRemove, '', $content) !!}

                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ url('belajar') }}/{{ $id }}?p={{ $nextData }}"
                        class="mt-2 mb-2 btn btn-primary">
                        Selanjutnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dash-ui/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dash-ui/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/highlight.js@10.7.2/lib/highlight.min.js"></script> --}}


    <!-- Theme JS -->
    <script src="{{ asset('dash-ui/assets/js/theme.min.js') }}"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>

    <script>
        // Get all <img> elements on the page
        var imgElements = document.querySelectorAll('img');

        // Loop through each <img> element and add the desired class
        imgElements.forEach(function(imgElement) {
            imgElement.classList.add('img-fluid');
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
    <!-- Default Statcounter code for sahrebook
    https://sahrebook.com -->
    <script type="text/javascript">
        var sc_project = 12908410;
        var sc_invisible = 1;
        var sc_security = "3f88d2a7";
    </script>
    <script type="text/javascript" src="https://www.statcounter.com/counter/counter.js" async></script>
    <noscript>
        <div class="statcounter"><a title="Web Analytics" href="https://statcounter.com/" target="_blank"><img
                    class="statcounter" src="https://c.statcounter.com/12908410/0/3f88d2a7/1/" alt="Web Analytics"
                    referrerPolicy="no-referrer-when-downgrade"></a></div>
    </noscript>
    <!-- End of Statcounter Code -->
</body>

</html>
