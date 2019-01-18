var priceLow ;
var priceHigh;

$( document ).ready(function() {
    var currentUrl = window.location.href ;
    if (currentUrl.indexOf("productOrderBy") <= 0){
        window.location.replace(currentUrl+'?productOrderBy=menu_order&itemOrder=ASC');
        } 
  
    var formattedUrl = new URL(currentUrl);
    var optionValue = formattedUrl.searchParams.get("productOrderBy");
    switch(optionValue) {
        case 'menu_order':
            $('#product-sort option:contains("Selected")').text('Najprodavanije');
            $('#product-sort option[value="najprodavanije"]').hide();
        break;
        case 'date':
            $('#product-sort option:contains("Selected")').text('Datum');
            $('#product-sort option[value="datum"]').hide();
        break;
        case 'title':
            $('#product-sort option:contains("Selected")').text('Ime proizvoda');
            $('#product-sort option[value="ime"]').hide();
        break;
        case 'cena':
            $('#product-sort option:contains("Selected")').text('Cena');
            $('#product-sort option[value="cena"]').hide();
        break;
      }
    

    $('#product-sort option[value="selected"]').hide();
    priceLow = lowValue *12;
    priceHigh = highValue *12;
    var gramaze= [];
    $('.low_value').text(priceLow+' rsd');
    $('.high_value').text(priceHigh+' rsd');
    $('.product_gramaza').each(function(i,value){
    var gramazaValue= $(this).text();
    gramazaValue=gramazaValue.replace(' ','');
      if ($.inArray($(this).text(), gramaze) == -1){
          gramaze.push($(this).text());
          $('.gramaza-content-inner').append(' <input class="button filter-neutral filter-weight" id="'+gramazaValue+'"type="button" onclick="gramazaFilter(this.value)" value="'+gramazaValue+'"> ');
        }

    });

 });


 // sorting 
 function productSort(siteUrl){
    var value = $('#product-sort').find(":selected").text();
    var productOrderby;
    switch(value) {
        case 'Najprodavanije':
            productOrderby='menu_order';
          break;
        case 'Datum':
            productOrderby='date';
          break;
        case 'Ime':
            productOrderby='title';
        break;
        case 'Cena':
            productOrderby='cena';
          break;
      }
      window.location.replace(siteUrl+'?post_type=product&productOrderBy='+productOrderby+'&itemOrder=ASC');
}
 function arrowAsc(){
    event.preventDefault();
     var currentUrl = window.location.href ;
     if (currentUrl.indexOf("itemOrder") >= 0){
        currentUrl = currentUrl.replace("DESC", "ASC");
        window.location.replace(currentUrl);
        } 
     else {
         alert('ne moze');
        }
    

 }
 function arrowDesc(){
    event.preventDefault();
    var currentUrl = window.location.href ;
     if (currentUrl.indexOf("itemOrder") >= 0){
        currentUrl = currentUrl.replace("ASC", "DESC");
        window.location.replace(currentUrl);
        } 
     else {
         alert('ne moze');
        }
 }
//  range
 $(document).on('input', '#range_slider', function() {
    priceLow = lowValue *12;
    priceHigh = highValue *12;
    $('.low_value').text(priceLow+' rsd');
    $('.high_value').text(priceHigh+' rsd');
    $('.product').each(function(i,value){
    var regularPrice= $('.regular_price',this).text();
    var salePrice= $('.sale_price',this).text();
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
var categoryCloseArray = [];
var vrsteMedaFilterCloseArray = [];
var gramazaFilterCloseArray = [];

function categoryFilter(category){
    var catFormatted = category.replace(/\ /g, '_');
    if(jQuery.inArray(catFormatted,classArray)==-1){
    classArray.push(catFormatted);
    categoryCloseArray.push(catFormatted);
    $('#'+catFormatted).removeClass("filter-off filter-neutral").addClass("filter-on");
    }
    else{
        classArray = $.grep(classArray, function(value) {
            return value != catFormatted;
          });
          $('#'+catFormatted).removeClass("filter-on filter-neutral").addClass("filter-off");

          categoryCloseArray = $.grep(categoryCloseArray, function(value) {
            return value != catFormatted;
          });
         
          
    }
    filtering();
  
}


function vrsteMedaFilter(id){
    if(jQuery.inArray(id,classArray)==-1){
        classArray.push(id);
        vrsteMedaFilterCloseArray.push(id);
        $('#'+id).removeClass("filter-off filter-neutral").addClass("filter-on");
    }
    else{
        classArray = $.grep(classArray, function(value) {
            return value != id;
          });
          $('#'+id).removeClass("filter-on").addClass("filter-off");
          vrsteMedaFilterCloseArray = $.grep(vrsteMedaFilterCloseArray, function(value) {
            return value != id;
          });
    }
    filtering();
  
}
function gramazaFilter(gramaza){
        if(jQuery.inArray(gramaza,classArray)==-1){
            classArray.push(gramaza);
            gramazaFilterCloseArray.push(gramaza)
            $('#'+gramaza).removeClass("filter-off filter-neutral").addClass("filter-on");
          }
         else{
             classArray = $.grep(classArray, function(value) {
            $('#'+gramaza).removeClass("filter-on").addClass("filter-off");
            return value != gramaza;
          });
          gramazaFilterCloseArray = $.grep(gramazaFilterCloseArray, function(value) {
            return value != gramaza;
          });
         
    }
    filtering();
  
}
function filtering(){

    $('.empty_results').text('');
    
    var classComp = classArray.toString();
   
    classComp = classComp.replace(/\,/g, ' ');
    $('.product').hide();
    $('.product').addClass('filter_hidden');
    $('.product').each(function(i,value){
        var self=$(this);
      var elementClasses = $(this).attr("class").split(' ');
      var br =0;
        classArray.forEach(function(item){  
            var arrayContainsClass = (elementClasses.indexOf(item) > -1);
            if(arrayContainsClass != false){
                self.show();
                self.removeClass('filter_hidden');
            }
            
        });
       
        
      
     
      
    });
    if(classArray.length==0){
        $('.product').removeClass('filter_hidden');
        $('.product').show();
    }
    if($('.product_title:visible').length==0){
        $('.empty_results').text('Nema rezultata');
    }
    
    
}
// Close
function categoryClose(){
    classArray = classArray.filter(function(x) { 
        $('.filter-categories').removeClass("filter-off filter-on").addClass("filter-neutral");
        return categoryCloseArray.indexOf(x) < 0;
      });
    
          filtering();

    
}
function vrsteMedaClose(){
    classArray = classArray.filter(function(x) { 
        $('.filter-type').removeClass("filter-off filter-on").addClass("filter-neutral");
        return vrsteMedaFilterCloseArray.indexOf(x) < 0;
      });
    
          filtering();
}
function gramazaClose(){
    
    classArray = classArray.filter(function(x) { 
        $('.filter-weight').removeClass("filter-off filter-on").addClass("filter-neutral");
        return gramazaFilterCloseArray.indexOf(x) < 0;
      });
    
          filtering();
}
function rangeClose(){
    $("input.original").val(0)
    $("input.ghost").val(100)
    priceHigh=1200;
    priceLow=0;
    $(".multirange").attr('style','--low:1%; --high:99%;');
    $('.low_value').text(priceLow+' rsd');
    $('.high_value').text(priceHigh+' rsd');


    filtering();

 }
