document.addEventListener('DOMContentLoaded', function () {
    getData()
})

function getData() {
    $("#myTable").DataTable({
        "ordering": false,
        ajax: '/data-transaksi-user',
        processing: true,
        'language': {
            'loadingRecords': '&nbsp;',
            'processing': 'Loading...'
        },
        columns: [{
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: "invoice"
            },
            {
                render: function (data, type, row, meta) {

                    const input = row.created_at
                    const date = new Date(input);

                    const day = date.getDate();
                    const month = date.getMonth() + 1;
                    const year = date.getFullYear();
                    const hours = date.getHours();
                    const minutes = date.getMinutes();
                    const seconds = date.getSeconds();

                    const formattedDate = `${day}-${month}-${year}`;
                    const formattedTime = `${hours}:${minutes}:${seconds}`;

                    return `${formattedDate} ${formattedTime}`

                }
            },
            {
                render: function (data, type, row, meta) {
                    if (row.status == 'PAID') {

                        return `<span class="badge bg-success">${row.status}</span>`

                    } else {

                        return `<span class="badge bg-danger">${row.status}</span>`
                    }
                }
            },
            {
                render: function (data, type, row, meta) {
                    return 'Rp ' + (row.total - row.diskon).toString().replace(/\D/g, "").replace(
                        /\B(?=(\d{3})+(?!\d))/g, ",")
                }
            },
            {
                render: function (data, type, row, meta) {
                    return `<a class="btn btn-sm btn-primary" data-bs-id="${row.id}" data-bs-toggle="modal" data-bs-target="#modal-detail" style="border-radius: 25px;" href="javascript:void(0)">
                            Detail
                        </a>`
                }
            },
            {
                render: function (data, type, row, meta) {
                    if (row.status == 'UNPAID') {

                        return `<button id="pay-button" onclick=pay() data-transaction-token="${row.snap_token}" class="btn btn-sm btn-danger" style="border-radius: 25px;">
                                Bayar
                            </button>`
                    } else {

                        return ``
                    }
                }
            },
        ]
    })
}

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function pay() {

    const payButton = document.getElementById('pay-button');
    const transactionToken = payButton.dataset.transactionToken;

    window.snap.pay(transactionToken, {
        onSuccess: function (result) {
            /* You may add your own implementation here */
            alert("payment success!");
            console.log(result);
        },
        onPending: function (result) {
            /* You may add your own implementation here */
            alert("wating your payment!");
            console.log(result);
        },
        onError: function (result) {
            /* You may add your own implementation here */
            alert("payment failed!");
            console.log(result);
        },
        onClose: function () {
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
        }
    })

}

$('#modal-detail').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('bs-id') // Extract info from data-* attributes

    axios.get('/data-detail-transaksi-user/' + id).then(function (res) {
        let data = res.data.data
        let dataTable = ''
        let total = 0
        let grandtotal = 0
        // let diskon = 0

        data.forEach(e => {
            dataTable += `
                <tr>
                    <td>${e.judul_produk}</td>
                    <td class="text-end">
                        Rp ${e.harga.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")}
                    </td>
                </tr>
            `
            total += e.harga
        });

        let content = `
            <div class="d-flex">
                <img class="me-2" src="/sahretech.png" height="35" alt="">
                <h3 class="">SAHRE BOOK</h3>
            </div>
            <a href="/print-invoice/${data[0].id_tagihan}" class="mt-2"><i class="bi bi-printer"></i> Print Invoice</a>
            <br>
            <p class="">
                Invoice <b>${data[0].invoice}</b> <br>
                STATUS: <b>${data[0].status}</b> <br>
                <span style="font-size: 12px;">Diupdate Tanggal ${data[0].updated_at}</span>
            </p>
            <hr>
            <p class="">
                <b>Invoice, </b> <br>
                <i>
                    Name: ${data[0].name} <br>
                    Phone: ${data[0].no_hp} <br>
                    Email: ${data[0].email}
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
                    ${dataTable}
                    <tr>
                        <td>
                            <h6>Total</h6>
                        </td>
                        <td class="text-end">Rp ${total.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Diskon</h6>
                        </td>
                        <td class="text-end">Rp ${data[0].diskon.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
                    </tr>
                    <tr>
                        <td>
                            <h6>Grand Total</h6>
                        </td>
                        <td class="text-end">Rp ${(total - data[0].diskon).toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</td>
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
        </p>`

        document.getElementById('modal-content').innerHTML = content
    })
})
