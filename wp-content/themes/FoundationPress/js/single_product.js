var selectedVariation;
var attributeValue;
var productId;
var addToCartLink;
var quantity;

$( document ).ready(function() {
    var variation = 1;
    
    variationSetup(variation);

    
 });
function addToCart(){
   
   quantity = document.getElementById("cart_quantity").value;
   addToCartLink='?add-to-cart='+productId+'&variation_id='+selectedVariation+'&attribute_gramaza='+attributeValue+'&quantity='+quantity;
   window.location.href = addToCartLink;
    
}

 
function attributeSelect(selected){
        variation = selected;
        variationSetup(selected);
     


}
function variationSetup(variation){
    selectedVariation = $('.variation_'+variation).text();
    attributeValue = $('#attributeSelectorButton'+variation).val();
    productId= $('#product_id').text();
   

 
    
    $('#product_id').hide();
    $('.variationId').hide();
    $('.variation_image').hide();
    $('.variation_image_'+variation).show();
    $('.variation_price').hide();
    $('.variation_price'+variation).show();
    $('.active_attribute').text(attributeValue).val();
    $('.stock').hide();
  
    $('#variation_add_to_cart').attr('href',addToCartLink);
  
    if($('.stock'+variation+':contains("1")').length > 0){   
        $('.stockIcon').text('Na stanju!');      
    }
    else{
        $('.stockIcon').text('Nije na stanju!');
        
    }
}