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
    variationSetup(selected);
// stock_blob klasa treba ima display none

    if($('.stock_blob_'+selected).text() == 1){
        // slucaj kada je na stanju
        $('.stockIcon').html('<i class="far fa-check-circle"></i><p class="available">Na stanju!</p>');      
    }else{
        // slucaj kada nije na stanju
        $('.stockIcon').html('<i class="far fa-times-circle"></i><p class="available">Nije na stanju!</p>');
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
  
  
}
function lastSeen(){
    // document.getElementsByClassName('last_seen')[0].style.display='block';
    // document.getElementsByClassName('related-cards')[0].style.display='none';

}
function related(){
    // document.getElementsByClassName('last_seen')[0].style.display='none';
    // document.getElementsByClassName('related-cards')[0].style.display='block';
    
}