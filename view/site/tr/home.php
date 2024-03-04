<?php require_once 'header.php'; ?>
<div class="tg-bannerholder">
	<ul class="tg-socialicons tg-bannersocialicons">
		<li><a href="#" target="_blank"><i
					class="fa fa-brands fa-linkedin-in"></i></a></li>
		<li><a href="#" target="_blank"><i class="fa fa-brands fa-instagram"></i></a>
		</li>
		<li><a href="#" target="_blank"><i class="fa fa-brands fa-twitter"></i></a></li>
		<li><a href="#" target="_blank"><i class="fa fa-brands fa-facebook-f"></i></a>
		</li>
		<li><a href="#" target="_blank"><i
					class="fa fa-brands fa-youtube"></i></a></li>
	</ul>

	<div id="tg-homeslider" class="tg-homeslider tg-haslayout owl-carousel">
		<?php

		for ($i = 1;$i<2;$i++){

			?>
			<figure class="item tg-bannerimg" data-vide-bg="poster: view/site/assets/images/slider/slider-<?=$i?>.jpg" data-vide-options="position: center">
				<figcaption>
					<div class="container">

						<div class="tg-slidercontent mt-4">
                            <span>Yapım Aşamasında</span>
							<h1>Türkiye 23. Uluslararası Kömür Kongresi ve Sergisi</h1>
							<ul class="tg-matadata tg-eventmatadata">

								<li>
									<i class="fa fa-map-pin"></i>
									<span>Zonguldak</span>
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
</div>
<?php require_once 'footer.php'; ?>
