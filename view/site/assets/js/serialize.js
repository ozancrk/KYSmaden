function overlay(type) {

    var type;
    var loadertheme = 'bg-black';
    var loaderopacity = '60';
    var loaderstyle = 'light';


    var loader = '<div id="loader-overlay" class="ui-front loader ui-widget-overlay bg-black opacity-60" ><img style="margin-top: 14%;" src="view/yonetim/app-assets/loader-light.gif" alt="" /></div>';

    if ($('#loader-overlay').length) {
        $('#loader-overlay').remove();
    }
    $('body').append(loader);

    if (type == 'in') {
        $('#loader-overlay').fadeIn('fast');
    } else {
        $('#loader-overlay').fadeOut('fast');
    }
}

function hata_alert(text) {

    Swal.fire({
        title: "Hata", text: text, type: "error", confirmButtonClass: "btn btn-danger", buttonsStyling: !1
    })

}

function basari_alert(text) {

    Swal.fire({
        title: "İşlem Başarılı", text: text, type: "success", confirmButtonClass: "btn btn-success", buttonsStyling: !1
    })


}

$(document).ready(function () {
    $('#exampleModal').modal('show');
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
        $('.btn').prop('disabled', true);
        var data = $(this).serializeFormJSON();

        let url = "api/" + data.type + '.php';
        overlay('in');

        /*
        * DOSYA YÜKLEMEK İÇİN type inputu'nu upload olarak düzenlemeli ve
        * upload inputunu ise yüklemek istediğiniz türü yazmalısınız
        *
        */

        if (data.type === 'upload') {


            function formdataset(form_data, item, index) {
                form_data.append(index, item);
            }


            let form_data = "";

            console.log(data)


            if (data.upload === 'fotograf') {
                form_data = new FormData();
                let fileList = $('#file-' + data.adet).prop("files");
                form_data.append("file", fileList[0]);
                form_data.append("foto_adi", data.foto_adi);
                form_data.append("foto_yeri", data.foto_yeri);
                form_data.append("foto_tarih", data.foto_tarih);
                form_data.append("foto_code", data.adet);
                form_data.append("author", data.author);
                form_data.append("konu", data.konu);
            } else if (data.upload === 'yazar') {
                let fileList = $('#file').prop("files");
                form_data = new FormData();
                form_data.append("file", fileList[0]);
                form_data.append("author", getParam('authorID'));

                form_data.append("konu", data.konu);
                form_data.append("title", data.title);
                form_data.append("note", data.note);
            } else {
                let fileList = $('#file').prop("files");
                form_data = new FormData();
                form_data.append("file", fileList[0]);
                form_data.append('inputs', JSON.stringify(data));

            }

            await $.ajax({
                url: "api/" + data.upload + "/upload.php",
                cache: false,
                contentType: false,
                processData: false,
                async: true,
                dataType: 'json',
                data: form_data,
                type: 'POST',
                success: function (msg) {
                    overlay('out');
                    if (msg.hata) {

                        hata_alert(msg.hata);

                    } else {

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
                        }

                        if (msg.operation === 'foto') {

                            $('#foto-' + msg.kod).html('OK');
                            $('#foto-' + msg.kod).prop('disabled', true);

                        }

                        if (msg.basari !== false) {
                            basari_alert(msg.basari);
                        }


                    }
                },
                fail: function (res) {

                }
            })


        } else {

            /*
            *
            * FORM POST
            *
            *
            */

            overlay('in');

            await $.ajax({
                type: 'POST', url: url, dataType: 'json', data: data, success: function (msg) {

                    if (msg.editorbildirim) {
                        $.get("api/emailsend/editor.php", function (data) {
                        });
                    }

                    if (msg.hata) {
                        hata_alert(msg.hata);
                    } else {
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
                        if (msg.basari !== false) {
                            basari_alert(msg.basari);
                        }
                    }
                }, error: function (msg) {
                    overlay('out');
                    hata_alert('Bir hata meydana geldi!');
                    $('.btn').prop('disabled', false);
                }
            });
        }
        overlay('out');
        $('.btn').prop('disabled', false);

    });

});


async function deletecontent(id, type, button) {

    $(button).html('Siliniyor...');
    $(button).removeClass("btn-success").addClass("btn-warning");
    if (confirm('Silmek istediğinize emin misiniz? Bu işlem geri alınamaz')) {

        await $.get("api/APISilme.php?id=" + id + '&type=' + type, function (data) {

            if (data == 1) {

                $(button).html('Silindi');
                $(button + '-1').hide();
            } else {

                $(button).html('HATA OLUŞTU');


            }

        });
    } else {


        $(button).html('SİL');

    }


}

function getParam(param) {
    return new URLSearchParams(window.location.search).get(param);
}


function svgturkiyeharitasi() {
    const element = document.querySelector('#standplan');
    const element2 = document.querySelector('#standplan');
    const info = document.querySelector('.firma-title');
    const infomobile = document.querySelector('#firmaname-mobile');


    element.addEventListener(
        'mouseover',
        function (event) {
            console.log(event)

            const infos = event.target;
            if (event.target.classList[0] === 'standpath') {
                var firmaname = infos.dataset.firma;
                var firmalogo = infos.dataset.logo;
                //var firmalogo = $(infos).data("logo");

                if (screen.width > 375) {
                    info.innerHTML = '<div id="firmainfo"><img width="150px" src="' + firmalogo + '"><div>' + firmaname + '</div></div>';

                } else {
                    infomobile.innerHTML = '<div id="firmainfo2" style="width: 100%"><img width="150px" src="' + firmalogo + '"><div>' + firmaname + '</div></div>';
                }

            }

        }
    );


    element2.addEventListener(
        'touchstart',
        function (event) {
            if (!$(event.target).is("path.standpath")) {
                info.innerHTML = '';
                return false;
            }
        }
    );

    element.addEventListener(
        'touchstart',
        function (event) {
            //alert(1)

            const infos = event.targetTouches[0];


            if (infos.target.classList[0] === 'standpath') {
                var firmaname = infos.target.dataset.firma;
                var firmalogo = infos.target.dataset.logo;

                if (screen.width >= 450) {
                    info.innerHTML = '<div id="firmainfo"><img width="150px" src="' + firmalogo + '"><div>' + firmaname + '</div></div>';


                } else {

                    infomobile.innerHTML = '<div id="firmainfo2" style="width: 100%"><img width="150px" src="' + firmalogo + '"><div>' + firmaname + '</div></div>';

                }
            }
        }
    );


    element.addEventListener(
        'mousemove',
        function (event) {
            info.style.top = event.pageY + 25 + 'px';
            info.style.left = event.pageX - 140 + 'px';
        }
    );

    element.addEventListener(
        'mouseout',
        function (event) {
            info.innerHTML = '';
        }
    );
}

svgturkiyeharitasi();



