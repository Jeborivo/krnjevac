var classArray = [];
function categoryFilter(category){
    if(jQuery.inArray(category,classArray)==-1){
    classArray.push(category);
    $('#'+category).css("background-color","yellow");
    }
    else{
        classArray = $.grep(classArray, function(value) {
            return value != category;
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

function filtering(){
    $('.empty_results').text('');
    br=0;
    
    var classComp = classArray.toString();
    classComp = classComp.replace(/\,/g, ' ');
    $('.product').hide();
    $('.product').each(function(i,value){
        if ( $( this ).hasClass( classComp )){
            br++;
            $(this).show();
        }
    });
    if(classArray.length==0){
        $('.product').show();
    }
    if($('.product_title:visible').length==0){
        $('.empty_results').text('Nema rezultata');
    }
    
        
    
}