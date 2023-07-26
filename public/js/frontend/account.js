form.onsubmit = (e) => {

    let formData = new FormData(form);

    e.preventDefault();

    document.getElementById("tombol_kirim").disabled = true;

    axios({
            method: 'post',
            url: '/store-account',
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
