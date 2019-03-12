var priceLow ;
var priceHigh;
var gramaze= [];
var classArray = [];
var categoryCloseArray = [];
var vrsteMedaFilterCloseArray = [];
var gramazaFilterCloseArray = [];
var allArray=[];
var categoryMemory;
var categoryState =0;
$( document ).ready(function() {
    
    $('.tnp-email').addClass('shop-newsletter_email--text');
    $('.tnp-email').attr('placeholder','E mail adresa');
    $('.tnp-submit').addClass('button btn-grey shop-newsletter_email--submit');
    var currentUrl = window.location.href ;
    if (currentUrl.indexOf("teglirani") > 0){
        classArray.push('Teglirani_med');
        $('#Teglirani_med').removeClass("filter-off filter-neutral").addClass("filter-on");

    }
    if (currentUrl.indexOf("pcelinji") > 0){
    //    dizajn
    }
    if (currentUrl.indexOf("horeca") > 0){
        classArray.push('Horeca');
        $('#Horeca').removeClass("filter-off filter-neutral").addClass("filter-on");
       

    }
    if (currentUrl.indexOf("akcija") > 0){
        classArray.push('Akcija');
        $('#Akcija').removeClass("filter-off filter-neutral").addClass("filter-on");
       

    }
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
            $('#product-sort option:contains("Selected")').text('Ime');
            $('#product-sort option[value="ime"]').hide();
        break;
        case 'cena':
            $('#product-sort option:contains("Selected")').text('Cena');
            $('#product-sort option[value="cena"]').hide();
        break;
      }
     filtering();
      gramazaFilters()
      
    $('#product-sort option[value="selected"]').hide();
    priceLow = lowValue *12;
    priceHigh = highValue *12;
   
    $('.low_value').text(priceLow+' rsd');
    $('.high_value').text(priceHigh+' rsd');
   

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
      window.location.replace(siteUrl+'/shop?productOrderBy='+productOrderby+'&itemOrder=ASC');
}
 function arrowAsc(event){
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
 function arrowDesc(event){
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
function range(){
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
    if ( $( this ).hasClass( 'new_category' )){
        return true;

    }
     if ( $( this ).hasClass( 'new_gramaza' )){
        return true;

    }
    if ( $( this ).hasClass( 'new_vrstemeda' )){
        return true;

    }
    if (salePrice !=''){
        if(priceLow> salePrice || priceHigh<salePrice){
            $(this).hide();
            $(this).addClass("range_hidden")
        }
        else{$(this).show();
            $(this).removeClass("range_hidden")}
    }else{
        if(priceLow> regularPrice || priceHigh<regularPrice){
            $(this).hide();
            $(this).addClass("range_hidden")
        }
        else{
            $(this).show();
            $(this).removeClass("range_hidden")
        }

    }
    if($('.product_title:visible').length==0){
        $('.empty_results').text('Nema rezultata');
    }
    
        
       

        });
}
 $(document).on('input', '#range_slider', function() {
    range();
    });






function categoryFilter(category){
    vrsteMedaFilterCloseArray=[];
    $('.vrste-meda-button').addClass("filter-off filter-neutral").removeClass("filter-on ");
    category = category.replace(/ /g, '_');
    // brojac za funck
    

    if(categoryMemory == category){
        categoryMemory=category;
        
            if(categoryState==0){
                $('.product').each(function(i,value){
                        if ($(this).hasClass('new_gramaza')){
                            return true;
                        }
                        if ($(this).hasClass('range_hidden')){
                            return true;
                        }
                        $(this).show();
                    
                });
                  $('.product').removeClass('new_category');

                  $('.filter-categories').addClass("filter-off filter-neutral").removeClass("filter-on ");
                categoryState=1;
            }else {
                 $('.filter-categories').addClass("filter-off filter-neutral").removeClass("filter-on");
                 $('#'+category).removeClass("filter-off filter-neutral").addClass("filter-on");
                categoryState=0;
                $('.product').hide();
                $('.product').addClass('new_category');
                $('.product').each(function(i,value){
                    if($(this).hasClass(category)){
                        $(this).removeClass('new_category');
                    }
                });
                $('.product').each(function(i,value){
                    if($(this).hasClass(category)){
                        if ($(self).hasClass('new_gramaza')){
                            return true;
                        }
                        if ($(self).hasClass('range_hidden')){
                            return true;
                        }
                        $(this).show();
                    }
                });
            }
        
        
    }
    else{
        categoryState=0;
      categoryMemory = category;
      $('.filter-categories').addClass("filter-off filter-neutral").removeClass("filter-on");
      $('#'+category).removeClass("filter-off filter-neutral").addClass("filter-on");
      $('.product').hide();
      $('.product').addClass('new_category');
      $('.product').each(function(i,value){
          if($(this).hasClass(category)){
              $(this).removeClass('new_category');
          }
      });
      $('.product').each(function(i,value){
          if($(this).hasClass(category)){
              if ($(self).hasClass('new_gramaza')){
                  return true;
              }
              if ($(self).hasClass('range_hidden')){
                  return true;
              }
              $(this).show();
          }
      });
        }
        $('.product').each(function(i,value){
                    if($(this).hasClass('range_hidden')){
                        $(this).hide();
                      
                    }
                });
                range();
}


function vrsteMedaFilter(id){
    categoryState=0;
    categoryMemory=undefined;
    $('.filter-categories').addClass("filter-off filter-neutral").removeClass("filter-on ");
    $('.product').hide();
    $('.product').removeClass('new_category')
    $('.product').addClass('new_vrstemeda');
    if(jQuery.inArray(id,vrsteMedaFilterCloseArray)==-1){
        vrsteMedaFilterCloseArray.push(id);
        // allArray.push(id);
        $('#'+id).removeClass("filter-off filter-neutral").addClass("filter-on");
    }
    else{
        vrsteMedaFilterCloseArray = $.grep(vrsteMedaFilterCloseArray, function(value) {
            return value != id;
          });
          $('#'+id).removeClass("filter-on").addClass("filter-off");
         
    }

    $('.product').each(function(){
        let self= this;
        vrsteMedaFilterCloseArray.forEach(function(el){
            if ($(self).hasClass(el)){
                $(self).removeClass('new_vrstemeda');

             }
           
        })

    });
  
    $('.product').each(function(){
     
        let self= this;
             vrsteMedaFilterCloseArray.forEach(function(el){
                if ($(self).hasClass('new_gramaza')){
                    return true;
                }
                if ($(self).hasClass('range_hidden')){
                    return true;
                }
                 
                 if ($(self).hasClass(el)){
                    $(self).show();

                 }

             })
    });
    
    if(vrsteMedaFilterCloseArray.length==0){
        $('.product').each(function(el){
            $(this).removeClass('new_vrstemeda');
            if ($(this).hasClass('new_gramaza')){
                return true;
            }
            if ($(this).hasClass('range_hidden')){
                return true;
            }
           $(this).show();
          
    
           
        });
    }
  
    range();
  
}
function gramazaFilter(gramaza){
    if(vrsteMedaFilterCloseArray.length==0){
        $('.product').each(function(el){
            $(this).removeClass('new_vrstemeda');
        });
     }
    $('.product').hide();
    $('.product').addClass('new_gramaza');
    if(jQuery.inArray(gramaza,gramazaFilterCloseArray)==-1){
        gramazaFilterCloseArray.push(gramaza);
        // allArray.push(id);
        $('#'+gramaza).removeClass("filter-off filter-neutral").addClass("filter-on");
    }
    else{
        gramazaFilterCloseArray = $.grep(gramazaFilterCloseArray, function(value) {
            return value != gramaza;
          });
          $('#'+gramaza).removeClass("filter-on").addClass("filter-off");
          
    }$('.product').each(function(){
        let self= this;
        gramazaFilterCloseArray.forEach(function(el){
            if ($(self).hasClass(el)){
                $(self).removeClass('new_gramaza');

             }
           
        })

    });
    $('.product').each(function(el){
        if ($(this).hasClass('new_vrstemeda')){
            return true;
        }
        if ($(this).hasClass('new_category')){
            return true;
        }
        if ($(this).hasClass('range_hidden')){
            return true;
        }
        var self= this;
        gramazaFilterCloseArray.forEach(function(el){
                 if ($(self).hasClass(el)){
                    $(self).show();

                 }

             })
             

       
    });
    if(gramazaFilterCloseArray.length==0){
        $('.product').each(function(el){
            $(this).removeClass('new_gramaza');
            if ($(this).hasClass('new_vrstemeda')){
                return true;
            }
            if ($(this).hasClass('new_category')){
                return true;
            }
            if ($(this).hasClass('range_hidden')){
                return true;
            }
           
           $(this).show();
    
           
        });
      }
    //     if(jQuery.inArray(gramaza,classArray)==-1){
    //         classArray.push(gramaza);
    //         gramazaFilterCloseArray.push(gramaza)
    //         allArray.push(gramaza);
    //         $('#'+gramaza).removeClass("filter-off filter-neutral").addClass("filter-on");
    //       }
    //      else{
    //          classArray = $.grep(classArray, function(value) {
    //         $('#'+gramaza).removeClass("filter-on").addClass("filter-off");
    //         return value != gramaza;
    //       });
    //       gramazaFilterCloseArray = $.grep(gramazaFilterCloseArray, function(value) {
    //         return value != gramaza;
    //       });
    //       allArray = $.grep(allArray, function(value) {
    //         return value != gramaza;
    //       });
         
    // }
    // filtering();
    range();
  
}
function filtering(){
    var classComp = classArray.toString();

   
    classComp = classComp.replace(/\,/g, ' ');
    $('.product').hide();
    $('.product').addClass('filter_hidden');
    $('.product').removeClass('to_be_removed');

    $('.product').each(function(i,value){
        var categoryBr=0;
        var self=$(this);
        if(categoryCloseArray.length>0){
            categoryCloseArray.forEach(function(item){
            if(self.hasClass(item)==true){
                categoryBr=categoryBr+1;
            }
            });
            if(!categoryBr>0){
                self.addClass('to_be_removed');
            }
           
        }
        if($('.sale_price',this).text()!= ''){
            $(this).addClass('Akcija');
        }
        var regularPrice= $('.regular_price',this).text();
        var salePrice= $('.sale_price',this).text();
        if(classArray.length==0){
            $('.product').removeClass('filter_hidden');
            if (salePrice !=''){
                if(priceLow> salePrice || priceHigh<salePrice){
                    $(this).hide();
                    $(this).addClass("range_hidden")
                }
                else{$(this).show();
                    $(this).removeClass("range_hidden")}
            }else{
                if(priceLow> regularPrice || priceHigh<regularPrice){
                    $(this).hide();
                    $(this).addClass("range_hidden")
                }
                else{
                    $(this).show();
                    $(this).removeClass("range_hidden")
                }
    
            }
            
        }
        else{    
    
      var elementClasses = $(this).attr("class").split(' ');
      var br =0;
        classArray.forEach(function(item){  
            
            // OVde cu odratiti I logiku za kategorije... u slucaju da produkt ima kategoriju, dodacu mu klasu po kojoj cu da razvrstavam
           
            var arrayContainsClass = (elementClasses.indexOf(item) > -1);
            if(arrayContainsClass != false){
                br++;
                // za logiku da se prikazuju proiuzvodi koji imaju sve otkaceno
                // if(br == classArray.length){ 
                    
                    self.show();
                    self.removeClass('filter_hidden');
                // }
                
            }

            
        });
        allArray.forEach(function(item){  
            var arrayContainsClass = (elementClasses.indexOf(item) > -1);
            if(arrayContainsClass == false){     
                    self.hide();
                    self.addClass('filter_hidden');
                
            }

            
        });
        
        if ( $( this ).hasClass( 'filter_hidden' )){
           
    
        }else{
            if (salePrice !=''){
                if(priceLow> salePrice || priceHigh<salePrice){
                    $(this).hide();
                    $(this).addClass("range_hidden")
                }
                else{$(this).show();
                    $(this).removeClass("range_hidden")}
            }else{
                if(priceLow> regularPrice || priceHigh<regularPrice){
                    $(this).hide();
                    $(this).addClass("range_hidden")
                }
                else{
                    $(this).show();
                    $(this).removeClass("range_hidden")
                }
    
            }
        }
    }
    // categoryCloseArray.forEach(function(item){ 
    //     console.log(item)
    //     if(!self.hasClass("filter_hidden")){
    //         if(!self.hasClass(item)){
    //         self.hide();
    //         self.addClass('filter_hidden');
    //         }
    //     }
    // });
    });
  
    
    if($('.product_title:visible').length==0){
        
    }
    gramazaFilters();
    
}
// Close
function categoryClose(){
    categoryMemory=undefined;
    categoryState =0;
    categoryClose=[];
    $('.filter-categories').removeClass("filter-off filter-on").addClass("filter-neutral");
    $('.product').each(function(i,value){
       $(this).removeClass('new_category')
       if ($(this).hasClass('new_gramaza')){
        return true;
    }
    if ($(this).hasClass('range_hidden')){
        return true;
    }
    $(this).show();
    });
    range();

    
}
function vrsteMedaClose(){
    $('.vrste-meda-button').addClass("filter-off filter-neutral").removeClass("filter-on ");
    vrsteMedaFilterCloseArray=[];
    $('.product').each(function(i,value){
        $(this).removeClass('new_vrstemeda')
        if ($(this).hasClass('new_gramaza')){
         return true;
        }
        if ($(this).hasClass('range_hidden')){
            return true;
        }
     $(this).show();
     });
     range();
    
}
function gramazaClose(){
    gramazaFilterCloseArray=[];
        $('.filter-weight').removeClass("filter-off filter-on").addClass("filter-neutral");
        $('.product').each(function(i,value){
            $(this).removeClass('new_gramaza')
            if ($(this).hasClass('new_vrstemeda')){
             return true;
            }
            if ($(this).hasClass('range_hidden')){
                return true;
            }
            if ($(this).hasClass('new_category')){
                return true;
               }
         $(this).show();
         });
         range();

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
 function productSearch(){
    var inputValue = $('#product-search').val().toLowerCase();
    if(inputValue.length != 0){
            $('.product').each(function(i,value){
                var productName= $('.card-content_description--title',this).text().toLowerCase();
               
                if ($(this).hasClass('new_vrstemeda')){
                    return true;
                }
                if ($(this).hasClass('new_category')){
                    return true;
                }
                if ($(this).hasClass('new_gramaza')){
                    return true;
                }
                if ($(this).hasClass('range_hidden')){
                    return true;
                }
                if (productName.indexOf(inputValue) >= 0){
                    $(this).show();
                    
                }
                else{
                    $(this).hide();

                   
                }

                });
      }
      else{
        $('.product').each(function(i,value){
            if ($(this).hasClass('new_vrstemeda')){
                return true;
            }
            if ($(this).hasClass('new_category')){
                return true;
            }
            if ($(this).hasClass('new_gramaza')){
                return true;
            }
            if ($(this).hasClass('range_hidden')){
                return true;
            }
            $(this).show();
        
        })
          
      }
     
     }
     function gramazaFilters(){
         gramaze= [];
         var br=0;
        $('.gramaza-content-inner').html('');
        
        $('.product_gramaza').each(function(i,value){
            var gramazaValue= $(this).text();
            gramazaValue=gramazaValue.replace(' ','');
            
              if ($.inArray($(this).text(), gramaze) == -1){
                if($(this.closest('.product')).hasClass('filter_hidden') == false){
                    br++;
                  gramaze.push($(this).text());
                  $('.gramaza-content-inner').append(' <input class=" gramaza-filter button filter-neutral filter-weight" id="'+gramazaValue+'"type="button" onclick="gramazaFilter(this.value)" value="'+gramazaValue+'"> ');
                  }
                }
        
            });
            if(br==1){
                $(".gramaza-filter").addClass('filter-on');
                $(".gramaza-filter").removeClass('filter-neutral');
            }
           
      }

// LOAD MORE FUNCTIONALITY 

// $(function () {
//     $(".product").slice(0, 9).show();
//     $("#load-more").on('click', function (e) {
//         e.preventDefault();
//         $(".product:hidden").slice(0, 9).slideDown();
//         if ($(".product:hidden").length == 0) {
//             $("#load").fadeOut('slow');
//         }
//         $('.products-container').animate({
//             scrollTop: $(this).offset().top
//         }, 1500);
//     });
// });

// $('a[href=#top]').click(function () {
//     $(".products-container").animate({
//         scrollTop: 0
//     }, 600);
//     return false;
// });

// $(window).scroll(function () {
//     if ($(this).scrollTop() > 50) {
//         $(".totop").fadeIn();
//     } else {
//         $(".totop").fadeOut();
//     }
// });