async function login() {

    var bilgi = {
        usercode: $('#kullaniciadi').val(),
        password: $('#sifre').val(),
    }

    var email1 = bilgi["email"];
    var password1 = bilgi["password"];
    var token = bilgi["token"];


   await $.ajax({
        type: 'post',
        url: 'api/login/APILogin.php',
        data: {query: bilgi},
        success: function (result) {

            console.log(result);
            if(result == 0){

                $('#danger').show();
                $('#loading').hide();
                $('#success').hide();

            }else{


                if(result == '-1'){
                    $('#danger').show();
                    $('#loading').hide();
                    $('#success').hide();
                    alert('Kullanım süreniz doldu!')
                }
                if(result > 0){
                    $('#danger').hide();
                    $('#loading').hide();
                    $('#success').show();
                    window.location.reload();

                }



            }

        }

    });


}
