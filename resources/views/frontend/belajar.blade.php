<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon/favicon.ico" />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('dash-ui/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('dash-ui/assets/css/theme.min.css') }}" />
    <title>SAHRE BOOK</title>
    <style>
        .ql-align-center {
            text-align: center;
        }
        h4{
            font-size: 1.5rem;
        }
        p br{
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
                    @foreach ($data as $k => $item)
                        <li class="mx-4">
                            <a href="{{ url('belajar') }}/{{ $id }}?p={{ $item->id }}" class="text-white">
                                <i class="bi bi-file-earmark-text"></i> <b>Part {{ $k + 1 }}</b>:
                                {{ $item->judul_detail_produk }}
                            </a>
                            <hr style="color: white;" />
                        </li>
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
            <div class="container px-4 mt-4">
                <div class="card" style="border: none;">
                    <div class="card-body p-5">
                        <h2>🚀 {{ $konten->judul_detail_produk }}</h2>
                        <hr>
                        <div class="w-100">
                            {!! $konten->isi_detail_produk !!}
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

    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="{{ asset('dash-ui/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dash-ui/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- clipboard -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>

    <!-- Theme JS -->
    <script src="{{ asset('dash-ui/assets/js/theme.min.js') }}"></script>
    <script>
        // Get all <img> elements on the page
        var imgElements = document.querySelectorAll('img');

        // Loop through each <img> element and add the desired class
        imgElements.forEach(function(imgElement) {
            imgElement.classList.add('img-fluid', 'shadow');
        });
    </script>
</body>

</html>
