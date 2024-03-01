<?php include "header.php";

?>
<!--************************************
		Inner Baner Start
*************************************-->
<div class="tg-innerbanner tg-haslayout tg-bgparallax">
    <div class="container">
        <div class="tg-innerbannercontent">
            <div class="tg-pagetitle">
                <h1>Bildiri Özet Gönderimi</h1>
            </div>
            <ol class="tg-breadcrumb">
                <li><a href="#">Anasayfa</a></li>
                <li><a href="#">Bildiri</a></li>
                <li class="tg-active">Bildiri Özet Gönderimi</li>
            </ol>
        </div>
    </div>
</div>
<!--************************************
		Inner Baner End
*************************************-->
<!--************************************
		Main Start
*************************************-->
<main id="tg-main" class="tg-main tg-haslayout">
    <!--************************************
				About Us Start
		*************************************-->
    <section class="tg-sectionspace tg-haslayout">
        <div class="container">
            <div class="row">
                <div class="tg-shortcode tg-aboutusshortcode">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="tg-description">
                            <p>12 punto Times News Roman (doc, docx veya pdf) formatında, çalışma ve sonuçları yeterince
                                açıklayan minimum 500 kelime ve maksimum 2 sayfalık özetler en geç <strong>30 Ekim
                                    2022</strong> tarihine
                                kadar aşağıdaki Bildiri Özet Gönderim Formunu doldurarak gönderilmelidir.
                            </p>
                            <p>Bildiriler Türkçe ya da İngilizce olmalıdır. Sempozyum sırasında Türkçe ve İngilizce
                                simultane tercüme yapılacaktır.</p>
                            <p>Bildiriler hakkında sormak istediğiniz sorular için uyak@uyak.org.tr adresine e-posta
                                gönderebilirsiniz</p>
                            <p>Özetlerin kabul bildirimi sonrası tam metin bildiriler, bildiri şablonu ve yazım
                                kurallarına göre “Bildiri Yönetim Sistemine” yüklenerek gönderilmelidir.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="tg-packages">
                    <div class="text-center"><h4>Bildiri Özet Gönderimi</h4></div>
                    <div class="tg-package tg-premium" style="width: 50%">
                        <div class="tg-packagehead">
                            <a href="UYAK2023-Özet%20Şablonu.docx" target="_blank"> <i
                                    class="fa fa-solid fa-file-word"></i>
                                <h2>WORD</h2></a>
                        </div>
                    </div>
                    <div class="tg-package tg-premium" style="width: 50%">
                        <div class="tg-packagehead">
                            <a href="UYAK2023-Özet%20Şablonu.pdf" target="_blank"> <i
                                    class="fa fa-solid fa-file-pdf"></i>
                                <h2>PDF</h2></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--************************************
			About Us End
	*************************************-->
    <!--************************************
			  About Us Start
	  *************************************-->

    <?php

    if ( $_GET['step'] == 2 ) {





        $bildiriler = $db->from( 'bildiriler' )->where( 'yazar', $_GET['authorID'] )->all();


        ?>


        <?php if ( count( $bildiriler ) > 0 ) { ?>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 offset-md-3">
                            <div class="tg-commonquestions">
                                <div class="tg-detailinfo">
                                    <div class="tg-box">
                                        <h4>Sisteme Kayıtlı Bildirileriniz:</h4>
                                        <ul>
                                            <?php foreach ( $bildiriler as $item ) { ?>
                                                <li><?= $item['name'] ?></li>
                                            <?php } ?>

                                        </ul>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>


        <section class="tg-sectionspace tg-haslayout">
            <div class="container">


                <div class="row">


                    <h4 class="text-center">Adım 2 / 2</h4>
                    <form class="tg-formtheme" id="serialize">
                        <fieldset>
                            <div class="form-group offset-md-3 col-lg-6">
                                <input type="text" name="title" class="form-control" placeholder=" Bildiri Başlığı "
                                       required>
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <textarea name="note" id="note" class="form-control"
                                          placeholder="Bildiriniz ile ilgili iletmek istediğiniz notları bu alana yazabilirsiniz."></textarea>
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <select name="konu" class="form-control">
                                    <?php

                                    foreach ( getTopicList() as $country ) {
                                        echo '<option value="' . $country['id'] . '">' . $country['tr'] . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <input type="file" name="file" id="file" class="form-control" required>
                            </div>
                            <input type="hidden" name="type" value="upload">
                            <input type="hidden" name="upload" value="yazar">
                            <input type="hidden" name="author" value="<?= $_GET['authorID'] ?>">
                            <div class="form-group col-lg-6">

                                <button class="btn tg-btn" type="submit">Gönder</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
    <?php } elseif ( $_GET['step'] == 3 ) {


        ?>

        <section class="tg-sectionspace tg-haslayout">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <h4 class="text-center mb-4">İŞLEM BAŞARILI</h4>
                        <h4 class="text-center mb-4">BİLDİRİNİZ SİSTEME EKLENDİ</h4>
                        <p class="text-center mt-4"><a href="yonetim">Bildiri Yönetim Sistemi</a> kullanıcı bilgileriniz
                            e-posta adresinize gönderilecektir.</p>
                        <p class="text-center">Bildiriniz ile ilgili tüm işlemleri ve yeni bildiri ekleme işlemlerinizi
                            <a href="yonetim">Bildiri Yönetim Sistemi</a> üzerinden yapabilirsiniz.</p>
                    </div>
                </div>
            </div>
        </section>
    <?php } else { ?>

        <section class="tg-sectionspace tg-haslayout">
            <div class="container">

                <div class="row">
                    <h4 class="text-center">Adım 1 / 2</h4>
                    <form class="tg-formtheme" id="serialize">
                        <fieldset>
                            <div class="form-group offset-md-3 col-lg-6">
                                <input type="text" name="gorev" class="form-control" placeholder=" Görev / Ünvan "
                                       required>
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <input type="text" name="name" class="form-control" placeholder="İsim Soyisim" required>
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <input type="email" name="email" class="form-control" placeholder=" E-Mail Adresi "
                                       required>
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <input type="text" name="telefon" class="form-control" placeholder=" Telefon "
                                       required>
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <input type="text" name="kurum" class="form-control" placeholder="Kurum">
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <select name="ulke" class="form-control">
                                    <?php

                                    foreach ( listUlke() as $country ) {
                                        echo '<option value="' . $country['kod'] . '">' . $country['tr'] . '</option>';
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <input type="text" name="password" class="form-control" placeholder="Bildiri Yönetim Sistemi Yeni Şifre">
                            </div>
                            <div class="form-group offset-md-3 col-lg-6">
                                <input type="text" name="password2" class="form-control" placeholder="Şifre Tekrar">
                            </div>
                            <div class="form-group offset-md-3 col-lg-2">
                                <img src="https://kys.ozbilisim.net/cc.php">
                            </div>
                            <div class="form-group col-lg-4">
                                <input type="text" name="captha" class="form-control" placeholder="Güvenlik Kodu"
                                       required>
                            </div>

                            <?php var_dump($_SESSION['captcha']); ?>

                            <div class="form-group col-lg-6">
                                <input type="hidden" name="type" value="yazar/APIyazarkayit">
                                <button class="btn tg-btn" type="submit">Gönder</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </section>

    <?php } ?>
    <!--************************************
			About Us End
	*************************************-->
</main>
<div id="loader-overlay" class="ui-front loader ui-widget-overlay bg-black opacity-60"><img
        src="../../../app-assets/loader-light.gif" alt=""/></div>
<!--************************************
		Main End
*************************************-->
<?php include 'footer.php'; ?>
