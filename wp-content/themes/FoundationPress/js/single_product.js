var selectedVariation;
var attributeValue;
var productId;
var addToCartLink;
var quantity;

$( document ).ready(function() {
  
    var currentUrl = window.location.href;
    var variation = 1;
    var urlConverted = new URL(currentUrl);
    var variationNumber = urlConverted.searchParams.get("variationNumber");
    if (variationNumber !=undefined){
        variation= variationNumber;
    }

    
    variationSetup(variation);
    attributeSelect(variation);


    
 });
function quantityUp(event){
    event.preventDefault()
    var quantityValue = $("#cart_quantity").val();
    quantityValue = parseInt(quantityValue);
    $("#cart_quantity").val(quantityValue+1);

}
function quantityDown(event){
    event.preventDefault()
    var quantityValue = $("#cart_quantity").val();
    quantityValue = parseInt(quantityValue);
    if( $("#cart_quantity").val()!= 1){
     $("#cart_quantity").val(quantityValue-1);
    }
}

function addToCart(){
   
   quantity = document.getElementById("cart_quantity").value;
   addToCartLink='?add-to-cart='+productId+'&variation_id='+selectedVariation+'&attribute_gramaza='+attributeValue+'&quantity='+quantity;
   window.location.href = addToCartLink;
    
}

 
function attributeSelect(selected){
// stock_blob klasa treba ima display none

    if($('.stock_blob_'+selected).text() == 1){
        // slucaj kada je na stanju
        console.log('na stanju');
    }else{
        // slucaj kada nije na stanju
        console.log('nije na stanju');
    }

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
        $('.stockIcon').html('<i class="far fa-check-circle"></i><p class="available">Na stanju!</p>');      
    }
    else{
        $('.stockIcon').html('<i class="far fa-times-circle"></i><p class="available">Nije na stanju!</p>');
    }
}