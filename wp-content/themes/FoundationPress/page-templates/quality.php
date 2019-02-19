<?php /* Template Name: quality */ ?>
<?php
/**
 * 
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

		<div class="hero hero_about">
			<img class="hero-quality-img" src="http://krnjevac.rs/wp-content/themes/FoundationPress/src/assets/images/heroK.png" alt="">
			<div class="hero-quality_content hero_content main-container ">
				<div class="hero-quality_content--text">
					<h1 class="hero-quality_content--title">Šta je potrebno da med postane Krnjevac?</h1>
					<h4 class="hero-quality_content--desc">U sedam pažljivo kontrolisanih koraka dolazimo do Krnjevac meda</h4>
					<div class="hero-quality_content--button-link-wrap">
						<a class="button hero-quality_content--button" type="button" href="?page_id=55"> Krnjevac med <i class="fas fa-arrow-right"></i></a>
						<a href="#step1" class="hero-quality_content--more-link"><h5>Kako nastaje Krnjevac</h5><i class="fas fa-angle-down"></i></a>
					</div>
				</div>
			</div>
		</div>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
			<div class="quality-steps">
				<div class="quality-steps_container">
					<div class="quality-steps_step-1 step" id="step1">
						<h1 class="step_title">1</h1>
						<h3 class="step_desc">Vrcanje meda</h3>
						<div class="step_text">Sve počinje vrcanjem najkvalitetnijeg meda koje su vredne pčele sakupljale tokom sezone. </div>
						<div class="step_line"></div>
					</div>
					<div class="quality-steps_step-2 step">
						<h1 class="step_title">2</h1>
						<h3 class="step_desc">Uzorkovanje meda</h3>
						<div class="step_text">Da se uverimo u kvalitet meda, pre otkupa, naši radnici prikupljaju uzorke meda za testiranje.</div>
						<div class="step_line"></div>
					</div>
					<div class="quality-steps_step-3 step">
						<h1 class="step_title">3</h1>
						<h3 class="step_desc">Testiranje uzoraka</h3>
						<div class="step_text">Svi uzorci se detaljno testiraju u laboratoriji kako bismo sa sigurnošću zadovoljili standarde.</div>
					</div>
					<div class="quality-steps_step-4 step">
						<h1 class="step_title">6</h1>
						<h3 class="step_desc">Prikuplajnje meda</h3>
						<div class="step_text">Ukoliko testirani med zadovoljava propisane standarde, organizuje se otkup meda.</div>
						<div class="step_line"></div>
					</div>
					<div class="quality-steps_step-5 step">
						<h1 class="step_title">5</h1>
						<h3 class="step_desc">Otklanjanje nečistoća</h3>
						<div class="step_text">Kako nastaje potpuno delom prirode, sitne nečistoće su deo otkupljenog meda, koje se dalje potpuno otklanjaju.</div>
						<div class="step_line"></div>
					</div>
					<div class="quality-steps_step-6 step">
						<h1 class="step_title">4</h1>
						<h3 class="step_desc">Homogenizacija</h3>
						<div class="step_text">U kupažeru mešamo med i još jednom ga kontrolišemu u cilju postizanja optimalnog prozivoda.</div>
					</div>
					<div class="quality-steps_step-7 step">
						<div class="step-7">
						<h1 class="step_title">7</h1>
						<h3 class="step_desc">Pakovanje Krnjevac meda</h3>
						<div class="step_text">Nakon svih provera, med je spreman da postane Krnjevac. Proizvod je spreman za tvoj obrok!</div>
						<div class="step_line--special"></div>
						</div>
					</div>
					<div class="quality-steps_step-8 step links">
						<div class="links_wrap">
							<a href="shop" class="link">Teglirani med <i class="fas fa-shopping-cart"></i> </a>
							<a href="shop" class="link">Pčelinji proizvodi sa medom  <i class="fas fa-shopping-cart"></i> </a>
							<a href="shop" class="link">HoReCa program <i class="fas fa-shopping-cart"></i> </a>
							<a href="shop" class="link">Akcijski proizvodi <i class="fas fa-shopping-cart"></i> </a>
						</div>
					</div>
				</div>
			</div>
			<div class="quality-post">
				<div class="quality-post_content">
					<h3 class="quality-post_content--title">Pažljiv rad i dugo iskustvo naših pčelara, za najbolji med</h3>
					<h5 class="quality-post_content--text">Naši procesi proizvodnje se neprekidno prate kako bi se nivo kvaliteta održao konstantnim. Kako bismo osigurali potpunu ispravnost i očekivani kvalitet, u našoj modernoj laboratoriji vršimo veliki broj analiza. Za potrebe naših partnera, analize radimo i u sertifikovanim nemačkim laboratorijama QSI i Intertek, koje se nalaze u Bremenu.</h5>
				</div>
				<div class="quality-post_image" >
				<img src="http://krnjevac.rs/wp-content/themes/FoundationPress/src/assets/images/kontpostL.png" alt="" class="quality-post_image--img-center">
				<img src="http://krnjevac.rs/wp-content/themes/FoundationPress/src/assets/images/kontpostRTL.png" alt="" class="quality-post_image--img-top-right">
				</div>
			</div>
		</main>
	</div>
</div>
<?php
get_footer();
