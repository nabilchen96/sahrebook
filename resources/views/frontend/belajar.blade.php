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

        h4 {
            font-size: 1.5rem;
        }

        p br {
            display: none;
        }

        pre {
            padding: 0.2rem 0.4rem;
            font-size: 16px;
            color: #fff;
            background-color: #212529 !important;
            border-radius: 0.2rem;
            max-height: 500px;
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
            <div class="container-fluid px-4 mt-4">
                <div class="card" style="border: none;">
                    <div class="card-body p-5">
                        <h2>🚀 {{ $konten->judul_detail_produk }}</h2>
                        <hr>
                        <div class="w-100">

                            <?php
                                
                                $content = str_replace('<kbd>', '<code class="quill-kbd">', $konten->isi_detail_produk);
                                $content = str_replace('</kbd>', '</code>', $content);

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

    <!-- Scripts -->
    <!-- Libs JS -->
    {{-- <script src='https://cdn.rawgit.com/Arlina-Design/redvision/cab7a72d/prisma.js' type='text/javascript'></script> --}}
    {{-- <script src='https://cdn.rawgit.com/Arlina-Design/redvision/cab7a72d/prisma.js' type='text/javascript'></script> --}}
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
    <script>
        // $('pre').attr('class', 'line-numbers');
        // Prism.hooks.add("after-highlight", function(e) {
        //     var t = e.element.parentNode;
        //     if (!t || !/pre/i.test(t.nodeName) || t.className.indexOf("line-numbers") === -1) {
        //         return
        //     }
        //     var n = 1 + e.code.split("\n").length;
        //     var r;
        //     lines = new Array(n);
        //     lines = lines.join("<span></span>");
        //     r = document.createElement("span");
        //     r.className = "line-numbers-rows";
        //     r.innerHTML = lines;
        //     if (t.hasAttribute("data-start")) {
        //         t.style.counterReset = "linenumber " + (parseInt(t.getAttribute("data-start"), 10) - 1)
        //     }
        //     e.element.appendChild(r)
        // })
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
</body>

</html>
