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

        /* CSS Prism Syntax Highlighter */
        pre {
            overflow: scroll !important;
            padding: 50px 10px 10px 10px;
            margin: .5em 0;
            white-space: pre;
            word-wrap: break-word;
            overflow: auto;
            background-color: #2c323c;
            position: relative;
            border-radius: 4px;
            max-height: 450px
        }

        pre::before {
            padding-left: 20px !important;
            font-size: 16px;
            content: attr(title) !important;
            position: absolute;
            top: 0;
            background-color: #fff;
            padding: 10px;
            left: 0;
            right: 0;
            color: #fff !important;
            text-transform: uppercase;
            display: block;
            /* margin: 0 0 15px 5px; */
            font-weight: bold
        }

        pre::after {
            content: 'Double click to selection';
            padding: 2px 10px;
            width: auto;
            height: auto;
            position: absolute;
            right: 8px;
            top: 8px;
            color: #fff;
            line-height: 20px;
            transition: all 0.3s ease-in-out
        }

        pre:hover::after {
            opacity: 0;
            top: -8px;
            visibility: visible
        }

        code {
            font-family: Consolas, Monaco, 'Andale Mono', 'Courier New', Courier, Monospace;
            line-height: 16px;
            color: #88a9ad;
            background-color: transparent;
            padding: 1px 2px;
            font-size: 12px
        }

        pre code {
            display: block;
            background: none;
            border: none;
            color: #e9e9e9;
            direction: ltr;
            text-align: left;
            word-spacing: normal;
            padding: 0 0;
            font-weight: bold
        }

        code .token.punctuation {
            color: #ccc
        }

        pre code .token.punctuation {
            color: #fafafa
        }

        code .token.comment,
        code .token.prolog,
        code .token.doctype,
        code .token.cdata {
            color: #777
        }

        code .namespace {
            opacity: .8
        }

        code .token.property,
        code .token.tag,
        code .token.boolean,
        code .token.number {
            color: #e5dc56
        }

        code .token.selector,
        code .token.attr-name,
        code .token.string {
            color: #88a9ad
        }

        pre code .token.selector,
        pre code .token.attr-name {
            color: #fafafa
        }

        pre code .token.string {
            color: #40ee46
        }

        code .token.entity,
        code .token.url,
        pre .language-css .token.string,
        pre .style .token.string {
            color: #ccc
        }

        code .token.operator {
            color: #1887dd
        }

        code .token.atrule,
        code .token.attr-value {
            color: #009999
        }

        pre code .token.atrule,
        pre code .token.attr-value {
            color: #1baeb0
        }

        code .token.keyword {
            color: #e13200;
            font-style: italic
        }

        code .token.comment {
            font-style: italic
        }

        code .token.regex {
            color: #ccc
        }

        code .token.important {
            font-weight: bold
        }

        code .token.entity {
            cursor: help
        }

        pre mark {
            background-color: #ea4f4e !important;
            color: #fff !important;
            padding: 2px;
            border-radius: 2px
        }

        code mark {
            background-color: #ea4f4e !important;
            color: #fff !important;
            padding: 2px;
            border-radius: 2px
        }

        pre code mark {
            background-color: #ea4f4e !important;
            color: #fff !important;
            padding: 2px;
            border-radius: 2px
        }

        .comments pre {
            padding: 10px 10px 15px 10px;
            background: #2c323c
        }

        .comments pre::before {
            content: 'Code';
            font-size: 13px;
            position: relative;
            top: 0;
            background-color: #f56954;
            padding: 3px 10px;
            left: 0;
            right: 0;
            color: #fff;
            text-transform: uppercase;
            display: inline-block;
            margin: 0 0 10px 0;
            font-weight: bold;
            border-radius: 4px;
            border: none
        }

        .comments pre::after {
            font-size: 11px
        }

        .comments pre code {
            color: #eee
        }

        .comments pre.line-numbers {
            padding-left: 10px
        }

        pre.line-numbers {
            position: relative;
            padding-left: 3.0em;
            counter-reset: linenumber
        }

        pre.line-numbers>code {
            position: relative
        }

        .line-numbers .line-numbers-rows {
            height: 100%;
            position: absolute;
            pointer-events: none;
            top: 0;
            font-size: 100%;
            left: -3.5em;
            width: 3em;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            padding: 0
        }

        .line-numbers-rows>span {
            pointer-events: none;
            display: block;
            counter-increment: linenumber
        }

        .line-numbers-rows>span:before {
            content: counter(linenumber);
            color: #999;
            display: block;
            padding-right: 0.8em;
            text-align: right;
            transition: 350ms
        }

        pre[data-codetype='php']:before {
            background-color: #00a1d6
        }

        pre[data-codetype='HTMLku']:before {
            background-color: #3cc888
        }

        pre[data-codetype='JavaScriptku']:before {
            background-color: #75d6d0
        }

        pre[data-codetype='JQueryku']:before {
            background-color: #e5b460
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
                            {{-- {!! $konten->isi_detail_prod   uk !!} --}}

                            <?php
                            
                            $charactersToRemove = [
                                '&Acirc;', 
                                '&acirc;', 
                                '&#157;', 
                                '&#140;', 
                                '&#156;', 
                                '&#143;', 
                                '&iuml;', 
                                '&cedil;', 
                                '&#143;', 
                            ];
                            
                            ?>

                            {!! str_replace($charactersToRemove, '', $konten->isi_detail_produk) !!}

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
    <script src='https://cdn.rawgit.com/Arlina-Design/redvision/cab7a72d/prisma.js' type='text/javascript'></script>
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
        $('pre').attr('class', 'line-numbers');
        Prism.hooks.add("after-highlight", function(e) {
            var t = e.element.parentNode;
            if (!t || !/pre/i.test(t.nodeName) || t.className.indexOf("line-numbers") === -1) {
                return
            }
            var n = 1 + e.code.split("\n").length;
            var r;
            lines = new Array(n);
            lines = lines.join("<span></span>");
            r = document.createElement("span");
            r.className = "line-numbers-rows";
            r.innerHTML = lines;
            if (t.hasAttribute("data-start")) {
                t.style.counterReset = "linenumber " + (parseInt(t.getAttribute("data-start"), 10) - 1)
            }
            e.element.appendChild(r)
        })
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
