<?php include "header.php"; ?>
<!--************************************
        Inner Baner Start
*************************************-->
<div class="tg-innerbanner tg-haslayout tg-bgparallax">
    <div class="container">
        <div class="tg-innerbannercontent">
            <div class="tg-pagetitle">
                <h1><?= $PageMeta['en'] ?></h1>
            </div>
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
                            <?=$PageMeta['content_en']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
