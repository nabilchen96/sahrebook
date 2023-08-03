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
        h4{
            font-size: 1.5rem !important;
        }

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
                            <label class="form-label">Judul Detail Produk <sup class="text-danger">*</sup></label>
                            <input type="text" placeholder="Judul Detail Produk" class="form-control"
                                id="judul_detail_produk" name="judul_detail_produk" required
                                value="{{ $data->judul_detail_produk }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Isi Pembahasan <sup class="text-danger">*</sup></label>
                            <div id="editor" style="height: 500px;">
                                <?php
                                
                                // $content = str_replace('<kbd>', '<code class="quill-kbd">', $data->isi_detail_produk);
                                // $content = str_replace('</kbd>', '</code>', $content);
                                
                                ?>
                                {{-- {!! $content !!} --}}

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

                                {!! str_replace($charactersToRemove, '', $content) !!}

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
    <script src='https://cdn.rawgit.com/Arlina-Design/redvision/cab7a72d/prisma.js' type='text/javascript'></script>
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

            document.getElementById("tombol_kirim").disabled = true;

            axios({
                    method: 'post',
                    url: '/back/update-detail-product/{{ $id }}',
                    data: {
                        'judul_detail_produk': document.getElementById('judul_detail_produk').value,
                        'isi_detail_produk': quill.root.innerHTML,
                        'id': document.getElementById('id').value
                    },
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
