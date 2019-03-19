<?php 

function last_seen_product($last_seen_array,$product_id){
      if($last_seen_array == NULL){
        // if Variable is NULL set it to empty array
        $last_seen_array=[];
 
    }
    
    if(count($last_seen_array)<4){
        // if array is not full fill it
        if(in_array($product_id,$last_seen_array)){
            // if $product_id is already in array, dont fill array
        }
        else{  
            array_push($last_seen_array,$product_id);
        }
    }
    else{
        if(in_array($product_id,$last_seen_array)){
            // if $product_id is already in array, dont fill array

        }
        else{  
            // switch
            $length = count($last_seen_array);
            foreach($last_seen_array as $key => $element){
                $last_seen_array[$key]=$last_seen_array[$key+1];
              if($key==3){
                  $last_seen_array[$key]=$product_id;
              }
              

            }
        }
       
    }
   
    
  
    return $last_seen_array;
    


}

?>
