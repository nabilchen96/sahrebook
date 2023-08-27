<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('dash-ui/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" />
    <!-- <link rel="stylesheet" href="assets/css/style.css" /> -->
    <link rel="shortcut icon" href="{{ asset('sahretech.png') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    @stack('meta-description')
    <title>SAHRE BOOK</title>
    <style>
        .card {
            border-radius: 10px;
            border: none;
        }

        .tentang {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .judul_produk,
        .judul_berita {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* number of lines to show */
            line-clamp: 2;
            -webkit-box-orient: vertical;
            height: 42px;
        }

        ::-webkit-scrollbar-thumb:vertical {
            background: #888 !important;
        }

        ::-webkit-scrollbar {
            width: 0.5rem;
        }

        .nama_toko {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* number of lines to show */
            line-clamp: 1;
            -webkit-box-orient: vertical;
            height: 19px;
        }

        .deskripsi_singkat {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* number of lines to show */
            line-clamp: 3;
            -webkit-box-orient: vertical;
            height: 63px;
        }

        .foto_produk,
        .foto_berita {
            border-radius: 10px 10px 0 0;
            object-fit: cover;
            height: 100%;
        }
    </style>
    @stack('style')
</head>

<body style="background-color: #f6f6f6">
    <div style="z-index: 9; position: sticky; top: 0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
            <div class="container py-2 px-3">
                <a class="navbar-brand py-0" href="{{ url('/') }}">
                    <div class="float-left tentang">
                        <img src="{{ url('sahretech.png') }}" height="25" alt="">
                        <div style="margin-left: 10px; margin-top: 3px; margin-bottom: auto;">
                            <h6 class="">SAHRE BOOK</h6>
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}"
                                style="margin-right: 20px">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('produk') }}" style="margin-right: 20px">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('berita') }}" style="margin-right: 20px">Artikel</a>
                        </li>
                        <li class="nav-item" data-bs-toggle="modal" data-bs-target="#modalcari">
                            <button class="btn btn-primary mb-1" style="margin-right: 5px; border-radius: 50px">
                                <i class="bi bi-search"></i>
                            </button>
                        </li>
                        <li class="nav-item">
                            @if (Auth::check())
                                <a href="{{ url('account') }}/{{ auth::id() }}" class="btn btn-primary"
                                    style="border-radius: 50px">
                                    <i class="bi bi-person"></i> Account
                                </a>
                                <a href="{{ url('cart') }}" class="btn btn-primary position-relative"
                                    style="border-radius: 50px">
                                    <i class="bi bi-cart"></i>
                                    <div id="notif">

                                    </div>
                                </a>
                            @else
                                <a href="{{ url('login') }}" class="btn btn-primary" style="border-radius: 50px">
                                    Login
                                </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="modal fade" id="modalcari" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cari Produk....</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="{{ url('produk') }}">
                    {{-- @csrf --}}
                    <div class="modal-body">
                        <input type="text" class="form-control" name="cari" placeholder="laravel ..." required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @yield('content')

    <br /><br>
    {{-- maps --}}
    <div class="mt-5" style="min-height: 200px; background: #f6f6f6">
        <div class="text-center py-4">
            Copyright ©2022 All rights reserved | Created By Nabil <a target="_blank"
                href="https://sahretech.com">sahretech</a>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/frontend/app.js') }}"></script>
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
    @stack('script')
</body>

</html>
