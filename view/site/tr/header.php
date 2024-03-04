<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Türkiye 23. Uluslararası Kömür Kongresi ve Sergisi</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="view/site/assets/apple-touch-icon.png">
    <link rel="stylesheet" href="view/site/assets/css/beebootstrap.css">
    <link rel="stylesheet" href="view/site/assets/css/normalize.css">
    <link rel="stylesheet" href="view/site/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="view/site/assets/css/icomoon.css">
    <link rel="stylesheet" href="view/site/assets/css/customScrollbar.css">
    <link rel="stylesheet" href="view/site/assets/css/animate.css">
    <link rel="stylesheet" href="view/site/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="view/site/assets/css/prettyPhoto.css">
    <link rel="stylesheet" href="view/site/assets/css/jquery.fullpage.css">
    <link rel="stylesheet" href="view/site/assets/css/transitions.css">
    <link rel="stylesheet" href="view/site/assets/css/main.css?v=<?=rand(99,99999)?>">
    <link rel="stylesheet" href="view/site/assets/css/color.css">
    <link rel="stylesheet" href="view/site/assets/css/responsive.css?v=<?=rand(99,99999)?>">
    <script src="view/site/assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <style>
        html,
        body {
            height: auto;
        }
    </style>
</head>
<body class="tg-home tg-homeone">

<!--************************************
		Wrapper Start
*************************************-->
<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
    <!--************************************
            Header Start
    *************************************-->
    <header id="tg-header" class="tg-header tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <strong class="tg-logo" style="display: none"><a href="/"><img src="view/site/assets/images/uyak-logo-2.png"
                                                                                   alt="company logo here"></a></strong>
                    <div class="tg-navigationarea">
                        <nav id="tg-nav" class="tg-nav">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                        data-target="#tg-navigation" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                                <ul>

                                    <?php foreach (menuList() as $item): ?>
                                        <li>
                                            <a href="/<?=$item['guid_tr']?>"><?=$item['tr']?></a>
                                        </li>
                                    <?php endforeach; ?>

                                    <!--<li class="menu-item-has-children">
                                        <a href="javascript:void(0);">Sempozyum</a>
                                        <ul class="sub-menu">
                                            <li><a href="duzenleyen-kurumlar.php">Düzenleyen Kurumlar</a></li>
                                            <li><a href="sempozyum-daveti.php">Sempozyum Daveti</a></li>
                                            <li><a href="yurutme-kurulu.php">Yürütme Kurulu</a></li>
                                            <li><a href="bilim-kurulu-50">Bilim Kurulu</a></li>
                                            <li><a href="destekleyen-kurumlar-45">Destekleyen Kurumlar</a></li>
                                            <li><a href="uyak-tarihce.php">UYAK Tarihçesi</a></li>
                                            <li>
                                                <a href="fotograf-yarismasi.php">Fotoğraf Yarışması</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);">Delege</a>
                                        <ul class="sub-menu">
                                            <li><a href="delege-bilgileri-41">Delege Bilgileri</a></li>
                                            <li><a href="delege-kaydi-26">Delege Kaydı</a></li>
                                        </ul>
                                    </li>

                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);">Bildiriler</a>
                                        <ul class="sub-menu">
                                            <li><a href="sempozyum-konulari.php">Sempozyum Konuları</a></li>
                                            <li><a href="onemli-tarihler.php">Önemli Tarihler</a></li>
                                            <li><a href="ozet-sablonu.php">Bildiri Özet Gönderimi</a></li>
                                            <li><a href="bildiri-gonderimi-46">Bildiri Gönderimi</a></li>
                                            <li><a href="cagrili-konusmacilar-51">Çağrılı Konuşmacılar</a></li>
                                            <li><a href="uyak2023-bildiriler-kitabi.pdf">Sempozyum Bildiriler Kitabı</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);">Sergi & Sponsorluk</a>
                                        <ul class="sub-menu">
                                            <li><a href="sponsorluk-bilgileri-38">Sponsorluk Paketleri
                                                </a></li>
                                            <li><a href="sponsorluk-bilgileri-39">Sponsorluk Kaydı
                                                </a></li>
                                            <li><a href="sergi-bilgileri-36">Sergi & Stand Paketleri
                                                </a></li>
                                            <li><a href="sergi-bilgileri-40">Sergi & Stand Kaydı
                                                </a></li>
                                            <li><a href="sponsor-sergi-firmalari-52">Sponsor & Sergi Firmaları
                                                </a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);">Program</a>
                                        <ul class="sub-menu">
                                            <li><a href="teknik-program-54">Teknik Program
                                                </a></li>
                                            <li>
                                                <a href="cagrili-konusmacilar-51">Çağrılı Konuşmacılar</a>
                                            </li>
                                            <li><a href="fotograf-sergisi-13">Fotoğraf Sergisi
                                                </a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);">Sempozyum Yeri</a>
                                        <ul class="sub-menu">
                                            <li><a href="kongre-merkezi-34">Kongre Merkezi</a></li>
                                            <li><a href="istanbul.php">İstanbul</a></li>
                                            <li><a href="konaklama-42">Konaklama</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0);">İletişim</a>
                                        <ul class="sub-menu">
                                            <li><a href="iletisim.php">İletişim Bilgileri</a></li>
                                            <li><a href="#">Duyurular</a></li>
                                            <li><a href="medya.php">Medya</a></li>
                                            <li><a href="haberler.php">Haberler</a></li>
                                        </ul>
                                    </li>-->
                                    <li class="langswitch">
                                        <a  href="?lang=en">EN</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <a class="langswitchmobile tg-btn tg-btnbookseat" href="?lang=tr">TR</a>
                </div>
            </div>
        </div>
    </header>