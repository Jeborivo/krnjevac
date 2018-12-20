<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

<footer class="footer">
    <div class="footer-container">
        <div class="links-logo-wrap">
            <div class="footer-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="http://localhost/krnjevac/wp-content/themes/FoundationPress/src/assets/images/krnjevac_logo.svg" alt="krnjevac"></a>
                <h6 class="footer-logo_text">Ne mešamo se u posao prirode.</h6>
            </div>

            <div class="footer-links">
            <?php foundationpress_footer(); ?>
            </div>
        </div>

        <div class="footer-search"><?php get_search_form(); ?></div>

        <div class="footer-addres">
            <h4 class="footer-addres_phone">+381 26 821 080</h4>
            <h4 class="footer-address_mail">office@krnjevac.rs</h4>
        </div>
        <div class="footer-company"><h6>Medino DOO Krnjevo - www.medino.rs</h6></div>
    </div>
</footer>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>