function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}

function hata_alert(text) {
    Swal.fire({
        title: "İşlem Başarısız!",
        text: text,
        icon: "error",
        showConfirmButton: !1,
        showCloseButton: !0
    })
}

function basari_alert(text) {
    Swal.fire({
        title: "İşlem Başarılı",
        text: text,
        icon: "success",
        showConfirmButton: !1,
        showCloseButton: !0
    })
}

$(document).ready(function () {
    (function ($) {
        $.fn.serializeFormJSON = function () {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    })(jQuery);

    $('form#serialize').submit(async function (e) {
        e.preventDefault();

        var btn = $('.btn');

        btn.prop('disabled', true);
        var data = $(this).serializeFormJSON();
        let url = "api/" + data.postUrl + '.php';


        if (data.upload && sessionStorage.getItem(data.token) === null) {

            if(data.bildiriEk){
                var filedata = await uploadbildirifiles(data.upload, data.bildiri, data.fileType)
            }else {
                var filedata = await uploadfiles(data.upload)
            }

            data.fileID = filedata.fileID;
            sessionStorage.setItem(data.token, data.fileID);
        } else {
            data.fileID = sessionStorage.getItem(data.token);
        }

        if (data.editorMesajID) {

            const mesajElem = $('#' + data.editorMesajID + ' .ql-editor');

            data.mesaj = mesajElem[0].innerHTML;
        }

        await $.ajax({
            type: 'POST', url: url, dataType: 'json', data: data, success: function (msg) {


                if (msg.hata) {

                    hata_alert(msg.hata);


                } else {
                    sessionStorage.removeItem(data.token);
                    basari_alert(msg.basari);
                    if (msg.operation === 'reload') {
                        if (msg.sleep) {
                            setTimeout(function () {
                                location.reload();
                            }, msg.sleep);
                        } else {
                            location.reload();
                        }
                    }

                    if (msg.operation === 'redirect') {
                        if (msg.sleep) {
                            setTimeout(function () {
                                window.location.assign(msg.location);
                            }, msg.sleep);
                        } else {
                            window.location.assign(msg.location);
                        }

                    }

                    if (msg.operation === 'none') {

                        if (msg.jsondata) {


                        }

                        if (msg.url) {

                            $('input#url').val(msg.url);

                        }

                    }
                    basari_alert(msg.basari);

                }

            }, error: function (msg) {
                hata_alert('Bir hata meydana geldi!');
                btn.prop('disabled', false);
            }
        });


        btn.prop('disabled', false);

    });

});


function processConfirm(fName, token, data, textonay = null) {


    title = 'İşleme devam etmek istiyor musunuz?'
    if (textonay === null) {
        text = 'Bu işlem geri alınamaz!'
    } else {
        text = textonay;
    }

    ButtonText = 'Evet, Devam et'

    Swal.fire({
        title: title,
        text: text,
        icon: "warning",
        showCancelButton: !0,
        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
        cancelButtonClass: "btn btn-danger w-xs mt-2",
        confirmButtonText: ButtonText,
        cancelButtonText: 'İptal',
        buttonsStyling: !1,
        showCloseButton: !0
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "İşlem Başarılı!",
                text: "",
                icon: "success",
                confirmButtonClass: "btn btn-primary w-xs mt-2",
                buttonsStyling: !1
            })
            window[fName](data, token);

        }
    })

}

async function userDelete(data, token) {


    let form_data = "";

    form_data = new FormData();
    form_data.append("userID", data.userID);
    form_data.append('token', token);

    await $.ajax({
        url: 'api/user/delete.php',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {

            location.reload();

        }, error: function (msg) {
            hata_alert('Bir hata meydana geldi!');
            btn.prop('disabled', false);
        }
    });

}

async function bildiriDelete(data, token) {


    let form_data = "";

    form_data = new FormData();
    form_data.append("bildiriID", sil2.userID);
    form_data.append('token', token);

    await $.ajax({
        url: 'api/bildiri/delete.php',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {

            setTimeout(function () {
                window.location.replace(msg.location);
            }, 3000);

        }, error: function (msg) {
            hata_alert('Bir hata meydana geldi!');
            btn.prop('disabled', false);
        }
    });

}


async function userPasswordReset(data, token) {

    let form_data = "";

    form_data = new FormData();
    form_data.append("userID", data.userID);
    form_data.append('token', token);

    await $.ajax({
        url: 'api/users/passwordreset.php',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {

            location.reload();

        }, error: function (msg) {
            hata_alert('Bir hata meydana geldi!');
            btn.prop('disabled', false);
        }
    });

}

async function userSendEmail(data, token) {

    let form_data = "";

    form_data = new FormData();
    form_data.append("userID", data.userID);
    form_data.append('token', token);

    await $.ajax({
        url: 'api/users/senduseremail.php',
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {

            location.reload();

        }, error: function (msg) {
            hata_alert('Bir hata meydana geldi!');
            btn.prop('disabled', false);
        }
    });

}


function isEmpty(obj) {
    for (var prop in obj) {
        if (obj.hasOwnProperty(prop))
            return false;
    }

    return true;
}

async function uploadfiles(fileInputID) {

    let fileList = $('#' + fileInputID).prop("files");
    let fileName = $('#name-' + fileInputID).val();


    let form_data = "";

    form_data = new FormData();
    form_data.append("file", fileList[0]);

    await $.ajax({
        url: "api/upload/upload.php",
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {

            data = msg;
        },
        fail: function (res) {
            //reject(res);
        }
    })

    return data;

}

async function uploadbildirifiles(fileInputID,bildiriID,fileType) {

    let fileList = $('#' + fileInputID).prop("files");



    let form_data = "";

    form_data = new FormData();
    form_data.append("file", fileList[0]);
    form_data.append("bildiriID", bildiriID);
    form_data.append("fileType", fileType);

    await $.ajax({
        url: "api/bildiri/upload.php",
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {

            data = msg;
        },
        fail: function (res) {
            //reject(res);
        }
    })

    return data;

}


async function hakemata(data, token) {


    let form_data = "";

    var sure = $("#sure_" + data.hakem).val();
    var mesajgonder = $("#mesajgonder_" + data.hakem).val();
    let url = "api/bildiri/bildiriUpdate.php";
    form_data = new FormData();
    form_data.append("islem", 'hakem');
    form_data.append("sure", sure);
    form_data.append("mesajgonder", mesajgonder);
    form_data.append("hakem", data.hakem);
    form_data.append("bildiri", data.bildiri);
    form_data.append('token', token);

    console.log(form_data);
    console.log(data);


    await $.ajax({
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {


        }, error: function (msg) {

            hata_alert('Bir hata meydana geldi!');
            $('.btn').prop('disabled', false);
        }
    });

    $('.btn').prop('disabled', false);
}


async function hakematamakaldir(data, token) {

    let url = "api/bildiri/bildiriUpdate.php";
    form_data = new FormData();
    form_data.append("islem", 'hakemkaldir');
    form_data.append("hakem", data.hakem);
    form_data.append("bildiri", data.bildiri);
    form_data.append('token', token);

    await $.ajax({
        url: "api/bildiri/bildiriUpdate.php",
        cache: false,
        contentType: false,
        processData: false,
        async: true,
        dataType: 'json',
        data: form_data,
        type: 'POST',
        success: function (msg) {


            if (msg.hata) {

                hata_alert(msg.hata);


            } else {

                if (msg.operation == 'reload') {


                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }

                if (msg.operation == 'redirect') {

                    setTimeout(function () {
                        window.location.replace(msg.location);
                    }, 3000);

                }

                if (msg.operation == 'none') {

                    if (msg.jsondata) {


                    }

                    if (msg.url) {

                        $('input#url').val(msg.url);

                    }

                }
                basari_alert(msg.basari);

            }

        }, error: function (msg) {

            hata_alert('Bir hata meydana geldi!');
            $('.btn').prop('disabled', false);
        }
    });

    $('.btn').prop('disabled', false);

}
