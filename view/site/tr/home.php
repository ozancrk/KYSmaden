<?php require_once 'header.php'; ?>
<div class="tg-bannerholder">
	<ul class="tg-socialicons tg-bannersocialicons">
		<li><a href="https://www.linkedin.com/company/uyak2023/" target="_blank"><i
					class="fa fa-brands fa-linkedin-in"></i></a></li>
		<li><a href="https://www.instagram.com/uyak2023/" target="_blank"><i class="fa fa-brands fa-instagram"></i></a>
		</li>
		<li><a href="https://twitter.com/uyak2023" target="_blank"><i class="fa fa-brands fa-twitter"></i></a></li>
		<li><a href="https://www.facebook.com/UYAK2023/" target="_blank"><i class="fa fa-brands fa-facebook-f"></i></a>
		</li>
		<li><a href="https://www.youtube.com/channel/UCNd1IepoBh6QKumtTFCJ9JA" target="_blank"><i
					class="fa fa-brands fa-youtube"></i></a></li>
	</ul>

	<div id="tg-homeslider" class="tg-homeslider tg-haslayout owl-carousel">
		<?php

		for ($i = 1;$i<6;$i++){

			?>
			<figure class="item tg-bannerimg" data-vide-bg="poster: view/site/assets/images/slider/slider-<?=$i?>.jpg" data-vide-options="position: center">
				<figcaption>
					<div class="container">
						<a class="btn btn-success" target="_blank"  href="https://drive.google.com/drive/folders/12F2-ruN5tl8tQycvivbyShY4zTPp3C4N">UYAK2023 FOTOĞRAFLARI</a>

						<!--
						<a class="btn btn-success" href="https://uyak.org.tr/technical-program-54">
							TEKNİK PROGRAM
						</a>
						<a class="btn btn-warning"  href="https://uyak.org.tr/delege-kaydi-26">DELEGE KAYDI</a>
						<a class="btn btn-danger" target="_blank"  href="https://uyak.org.tr/yonetim">BİLDİRİ YÖNETİM SİSTEMİ</a>
						-->
						<div class="tg-slidercontent mt-4">
							<span>Geleceğin Şehirleri <br> Şehir Tünelciliği ve Yeraltı Kazıları</span>
							<h1>5. Uluslararası<br> Yeraltı Kazıları<br> Sempozyumu ve Sergisi </h1>
							<ul class="tg-matadata tg-eventmatadata">
								<li>
									<i class="fa fa-calendar-check-o"></i>
									<time datetime="2017-12-12">5-6-7 Haziran 2023</time>
								</li>
								<li>
									<i class="fa fa-map-pin"></i>
									<span>İstanbul</span>
								</li>
							</ul>
						</div>
					</div>
				</figcaption>
			</figure>
			<?php
		}


		?>
	</div>
</div> <?php var_dump($_SESSION['captcha']); ?>
<?php require_once 'footer.php'; ?>
