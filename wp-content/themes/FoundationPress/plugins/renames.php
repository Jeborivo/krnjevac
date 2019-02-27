<?php
// cart Total label renamed

add_filter('gettext', 'wc_renaming_checkout_total', 20, 3);
function wc_renaming_checkout_total( $translated_text, $untranslated_text, $domain ) {
    if( !is_admin() && is_checkout ) {
        if( $untranslated_text == 'Total' )
            $translated_text = __( 'Ukupno','theme_slug_domain' );
    }
    return $translated_text;
}
// cart Subotal label renamed
add_filter('gettext', 'wc_renaming_checkout_subtotal', 20, 3);
function wc_renaming_checkout_subtotal( $translated_text, $untranslated_text, $domain ) {

    if( !is_admin() && is_checkout ) {
        if( $untranslated_text == 'Subtotal' )
            $translated_text = __( 'Proizvodi','theme_slug_domain' );
    }
    return $translated_text;
}
// cart Shipping label renamed
add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
  return 'Poštarina';
}

// cart Total label renamed
add_filter('gettext', 'wc_renaming_order_recieved_total', 20, 3);
function wc_renaming_order_recieved_total( $translated_text, $untranslated_text, $domain ) {

    if( !is_admin() && order_received ) {
        if( $untranslated_text == 'Total' )
            $translated_text = __( 'Ukupno','theme_slug_domain' );
    }
    return $translated_text;

}
?>