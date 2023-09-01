<?php

require_once './vendor/autoload.php';//change later

function queryCasePrices($name){   
    $connectionStr = "mongodb+srv://mainuser:UpxzsOcbvTZKsFHO@cluster0.pattjaw.mongodb.net/?retryWrites=true&w=majority";
    $client = new MongoDB\Client($connectionStr);
    $db = $client->Case;   
    $pastPriceCollection = $db->PastPriceData; 
    $currentPriceCollection = $db -> CurrentPriceData;
    $old = $pastPriceCollection->findOne(['name'=>$name]);
    $new = $currentPriceCollection->findOne(['name'=>$name]) ;  
    

    /*
    foreach ($cursor as $i){
        echo $i['lowest_price'];
        echo $i['dateTime'],"\n";
    }
    */
    $arr = array(); 

    array_push($arr,$old['lowest_price']);
    array_push($arr,$new['lowest_price']);

    return $arr;
    

}

function removeDollarSign($input){
    return substr($input,1);
}
?>
