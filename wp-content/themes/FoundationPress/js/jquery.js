var priceLow ;
var priceHigh;

$( document ).ready(function() {
    priceLow = lowValue *12;
    priceHigh = highValue *12;
    var gramaze= [];
    $('.low_value').text(priceLow+' rsd');
    $('.high_value').text(priceHigh+' rsd');
    $('.product_gramaza').each(function(i,value){
    var gramazaValue= $(this).text()
    gramazaValue=gramazaValue.replace(' ','');
      if ($.inArray($(this).text(), gramaze) == -1){
          gramaze.push($(this).text());
          $('#gramaza').append(' <input id="'+gramazaValue+'"type="button" onclick="gramazaFilter(this.value)" value="'+gramazaValue+'"> ');
        }

    });

 });
 
//  range
 $(document).on('input', '#range_slider', function() {
    priceLow = lowValue *12;
    priceHigh = highValue *12;
    $('.low_value').text(priceLow+' rsd');
    $('.high_value').text(priceHigh+' rsd');
    $('.product').each(function(i,value){
    var regularPrice= $('#regular_price',this).text();
    var salePrice= $('#sale_price',this).text();
    if ( $( this ).hasClass( 'filter_hidden' )){
        return true;

    }
        if (salePrice !=''){
            if(priceLow> salePrice || priceHigh<salePrice){
                $(this).hide();
            }
            else{$(this).show();}
        }else{
            if(priceLow> regularPrice || priceHigh<regularPrice){
                $(this).hide();
            }
            else{$(this).show();}

        }
    if($('.product_title:visible').length==0){
        $('.empty_results').text('Nema rezultata');
    }
    
        
       

        });
    });



var classArray = [];
function categoryFilter(category){
    var catFormatted = category.replace(' ','_');
    if(jQuery.inArray(catFormatted,classArray)==-1){
    classArray.push(catFormatted);
    $('#'+category).css("background-color","yellow");
    }
    else{
        classArray = $.grep(classArray, function(value) {
            return value != catFormatted;
          });
          $('#'+category).css("background-color","red");
          
    }
    filtering();
  
}


function vrsteMedaFilter(id){
    if(jQuery.inArray(id,classArray)==-1){
        classArray.push(id);
        $('#'+id).css("background-color","yellow");
    }
    else{
        classArray = $.grep(classArray, function(value) {
            return value != id;
          });
          $('#'+id).css("background-color","red");
    }
    filtering();
  
}
function gramazaFilter(gramaza){
        if(jQuery.inArray(gramaza,classArray)==-1){
            classArray.push(gramaza);
            $('#'+gramaza).css("background-color","yellow");
          }
         else{
             classArray = $.grep(classArray, function(value) {
            $('#'+gramaza).css("background-color","red");
            return value != gramaza;
            
          });
         
    }
    filtering();
  
}
function filtering(){

    $('.empty_results').text('');
    br=0;
    
    var classComp = classArray.toString();
    classComp = classComp.replace(/\,/g, ' ');
    $('.product').hide();
    $('.product').addClass('filter_hidden');
    $('.product').each(function(i,value){
        if ( $( this ).hasClass( classComp )){
            br++;
            $(this).show();
            $(this).removeClass('filter_hidden');
            
        }
    });
    if(classArray.length==0){
        $('.product').show();
    }
    if($('.product_title:visible').length==0){
        $('.empty_results').text('Nema rezultata');
    }
    
        
    
}