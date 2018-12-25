$( document ).ready(function() {
    var variation = 1;
    
    variationSetup(variation);

    
 });
function addToCart(){
   var quantity=1;
   quantity = $('.quantity').val();
   console.log(quantity);
    
}

 
function attributeSelect(selected){
        variation = selected;
        variationSetup(selected);
     


}
function variationSetup(variation){
    var selectedVariation = $('.variation_'+variation).text();
    var attributeValue = $('#attributeSelectorButton'+variation).val();
    var productId= $('#product_id').text();
    var addToCartLink='?add-to-cart='+productId+'&variation_id='+selectedVariation+'&attribute_gramaza='+attributeValue+'&quantity=3';

 
    
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