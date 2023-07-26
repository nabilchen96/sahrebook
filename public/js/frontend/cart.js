document.addEventListener('DOMContentLoaded', function () {
    getData()
})

function getData() {
    axios.get('/get-cart-user').then(function (res) {
        let data = res.data.data

        let dataTable = ''
        let table = ''
        let total = 0

        data.forEach(e => {

            dataTable += `
                <tr>
                    <td width="5px">
                        <a href="#" onclick="deleteCart(${e.id})">
                            <i style="font-size: 20px;" class="text-danger bi bi-trash"></i>
                        </a>
                    </td>
                    <td>
                        ${e.judul_produk}
                    </td>
                    <td class="text-end">
                        Rp ${formatNumber(e.harga)}
                    </td>
                </tr>
            `

            total += Number(e.harga)

        });

        if (data != '') {

            table = `                
                <table class="mt-2 table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th></th>
                            <th>Nama Produk</th>
                            <th class="text-end">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${dataTable}
                    </tbody>
                </table>`

            document.getElementById('tombol_pembayaran').innerHTML = `
                <div class="d-grid gap-2">
                    <button id="tombol_kirim" onclick="storeTagihan()" type="submit" class="btn btn-primary" type="button">Selesaikan Pembayaran</button>
                </div>
                `

        } else {

            table = `<div class="col-lg-12 text-center">
                        <img src="/search.svg" width="300px" height="300px" alt="">
                        <div class="mt-2 mb-5">
                            <h4>Oops!, anda belum memiliki apapun di keranjang</h4>
                            <h6>Ayo cari ebook dulu disini <a href="/produk">list ebook</a></h6>
                        </div>
                    </div>`

            document.getElementById('tombol_pembayaran').innerHTML = ``

        }

        document.getElementById('myTable').innerHTML = table
        document.getElementById('total').innerHTML = 'Rp ' + formatNumber(total.toString())
        document.getElementById('grand_total').innerHTML = 'Rp ' + formatNumber(total.toString())
    })
}

function deleteCart(id) {

    Swal.fire({
        title: "Yakin hapus data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonColor: '#3085d6',
        cancelButtonText: "Batal"

    }).then((result) => {

        axios({
            method: 'post',
            url: '/delete-cart',
            data: {
                id: id
            },
        }).then(function (res) {

            if (res.data.responCode == 1) {
                getData()
                getCartNotif()
            }
        })
    })

}

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function storeTagihan() {

    document.getElementById("tombol_kirim").disabled = true;

    axios({
            method: 'post',
            url: '/store-tagihan',
        })
        .then(function (res) {
            //handle success         
            if (res.data.responCode == 1) {

                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: res.data.respon,
                    timer: 3000,
                    showConfirmButton: false
                })

                getData()
                location.replace("/transaksi");

            } else {
                //error handling
            }

            document.getElementById("tombol_kirim").disabled = false;
        })
        .catch(function (res) {
            //handle error
            console.log(res);
        });
}
