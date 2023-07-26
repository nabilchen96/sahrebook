<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 p-5">
        <div class="d-flex">
            <img class="me-2" src="{{ url('sahretech.png') }}" height="35" alt="">
            <h3 class="">SAHRE BOOK</h3>
        </div>
        <br>
        <p class="">
            Invoice <b>{{ $data[0]->invoice }}</b> <br>
            STATUS: <b>{{ $data[0]->status }}</b> <br>
            <span style="font-size: 12px;">Diupdate Tanggal {{ $data[0]->updated_at }}</span>
        </p>
        <hr>
        <p class="">
            <b>Invoice, </b> <br>
            <i>
                Name: {{ $data[0]->name }} <br>
                Phone: {{ $data[0]->no_hp }} <br>
                Email: {{ $data[0]->email }}
            </i>
            <br><br>
        <table style="font-size: 14px;" class="table table-striped">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Produk</th>
                    <th class="text-end" width="25%">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    
                    $total = 0;
                    
                ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->judul_produk }}</td>
                        <td class="text-end">Rp {{ number_format($item->harga) }}</td>
                    </tr>
                    <?php $total += $item->harga; ?>
                @endforeach
                <tr>
                    <td>
                        <h6>Total</h6>
                    </td>
                    <td class="text-end">
                        Rp {{ number_format($total) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Diskon</h6>
                    </td>
                    <td class="text-end">
                        Rp {{ number_format(0) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Grand Total</h6>
                    </td>
                    <td class="text-end">
                        Rp {{ number_format($total) }}
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <p class="">
            <b>Notes:</b><br>
            <i>*Jika anda memiliki pertanyaan seputar invoice, website sahrebook atau masalah lainnya silahkan
                hubungi
                whatsapp: 081271449921
            </i>
        </p>
        </p>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>
