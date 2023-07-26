document.addEventListener('DOMContentLoaded', function () {
    getData()
})

let url = window.location.href

let newsSplit = url.split('/')
let newsId = newsSplit[newsSplit.length - 1];


if (document.getElementById('id_produk')) {

    document.getElementById('id_produk').value

}

function getData() {
    axios.get('/back/diskusi-produk/' + newsId).then(function (res) {
        let data = res.data.data

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
            url: '/back/store-diskusi-produk',
            data: formData,
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

                document.getElementById("form").reset();
                getData()

            } else {
                //error validation
                // document.getElementById('password_alert').innerHTML = res.data.respon.password ?? ''
                // document.getElementById('email_alert').innerHTML = res.data.respon.email ?? ''
            }

            document.getElementById("tombol_kirim").disabled = false;
        })
        .catch(function (res) {
            //handle error
            console.log(res);
            document.getElementById("tombol_kirim").disabled = false;
        });
}

function toCart(id) {

    axios({
            method: 'post',
            url: '/store-cart',
            data: {
                id_produk: id
            }
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

                getCartNotif()

            } else if (res.data.responCode == 2) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: res.data.respon,
                    timer: 3000,
                    showConfirmButton: false
                })

            }

        })
        .catch(function (res) {
            //handle error
            console.log(res);
            document.getElementById("tombol_kirim").disabled = false;
        });
}

var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')

    var image = `<img class="img-fluid" src=${recipient}>`

    document.getElementById('foto').innerHTML = image
})
