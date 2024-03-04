<footer id="tg-footer" class="tg-footer tg-haslayout">
	<div class="tg-foorterbar">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<ul class="tg-address tg-addressfooter">
						<li><span><i class="fa fa-solid fa-location-pin"></i></span>
							<span><address>TMMOB Maden Mühendisleri Odası Zonguldak Şubesi
Liman Cad. No: 25
67100 - Zonguldak

                            </address></span>
						</li>
						<li><span><i class="fa fa-solid fa-phone"></i></span><span><em>+90 546 4251085</em></span></li>
						<li><span><i class="fa fa-brands fa-whatsapp"></i></span><span><em>+90 546 4251079</em></span>
						</li>
						<li><span><i class="fa fa-solid fa-paper-plane"></i></span><span>komur.kongresi@gmail.com</span></li>
						<li><span></span><span>2022 Tüm Hakları Saklıdır</span></li>
					</ul>
					<ul class="tg-socialicons">
						<li><a href="#" target="_blank"><i
									class="fa fa-brands fa-linkedin-in"></i></a></li>
						<li><a href="#" target="_blank"><i
									class="fa fa-brands fa-instagram"></i></a></li>
						<li><a href="#" target="_blank"><i
									class="fa fa-brands fa-twitter"></i></a></li>
						<li><a href="#" target="_blank"><i
									class="fa fa-brands fa-facebook-f"></i></a></li>
						<li><a href="#" target="_blank"><i
									class="fa fa-brands fa-youtube"></i></a></li>
					</ul>

				</div>
			</div>
		</div>
	</div>
</footer>

<a href="https://api.whatsapp.com/send?phone=+905464251079&text=&nbsp;" class="float" target="_blank">
	<i class="fa fa-brands fa-whatsapp my-float"></i>
</a>
<!--************************************
		Footer End
*************************************-->
</div>
<!--************************************
		Wrapper End
*************************************-->
<script src="view/site/assets/js/vendor/jquery-library.js"></script>
<script src="view/site/assets/js/vendor/bootstrap.min.js"></script>
<script src="https://maps.google.com/maps/api/jsc257?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
<script src="view/site/assets/js/customScrollbar.min.js"></script>
<script src="view/site/assets/js/packery.pkgd.min.js"></script>
<script src="view/site/assets/js/owl.carousel.min.js"></script>
<script src="view/site/assets/js/jquery.hoverdir.js"></script>
<script src="view/site/assets/js/jquery.vide.min.js"></script>
<script src="view/site/assets/js/jquery.fullpage.js"></script>
<script src="view/site/assets/js/isotope.pkgd.js"></script>
<script src="view/site/assets/js/prettyPhoto.js"></script>
<script src="view/site/assets/js/countdown.js"></script>
<script src="view/site/assets/js/countTo.js"></script>
<script src="view/site/assets/js/appear.js"></script>
<script src="view/site/assets/js/gmap3.js"></script>
<script src="view/site/assets/js/main.js"></script>
<script src="view/site/assets/js/serialize.js?v=<?=rand(9999,9999999)?>"></script>
<script src="view/site/assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script>

    $("#konaklama").change(function () {
        var select = this;
        if (select.value != 0) {
            $('.konaklama').show();
        } else {
            $('.konaklama').hide();
        }
        hesapladelegeucreti();

    });

    $("#giris").change(function () {
        hesapladelegeucreti()
    });
    $("#delegeturu").change(function () {
        hesapladelegeucreti()
    });
    $("#cikis").change(function () {
        hesapladelegeucreti()
    });

    $("input[name='delegeturu']").click(function(){
        hesapladelegeucreti()
    });


    async function hesapladelegeucreti() {

        var delege = $("input[name='delegeturu']:checked").val();
        var giris = $("#giris").val();
        var cikis = $("#cikis").val();
        var konaklama = $("#konaklama").val();
        var total = 0;

        await $.get("api/odeme/ucretgetir.php?id=" + delege, function (data) {
            total = Number(data);
        });

        if(konaklama != 0){
            await $.get("api/odeme/ucretgetir.php?id=" + konaklama, function (data) {
                total = total + (Number(data) * [cikis - giris]);
            });
        }



        $(".toplamtutar strong").html('€ ' + total);

    }
    $( document ).ready(function() {
        $('#exampleModal').modal('show');
    });

</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1L78D12P69"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'G-1L78D12P69');
</script>
</body>
</html>
