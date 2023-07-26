document.addEventListener('DOMContentLoaded', function () {
    getCartNotif()
})

function getCartNotif() {

    axios.get('/get-cart-notif').then(function (res) {

        document.getElementById('notif').innerHTML =

            `<span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                ${res.data.data}
                <span class="visually-hidden">unread messages</span>
            </span>`
    })
}
