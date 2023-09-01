<?php

require_once '../../vendor/autoload.php';
$connectionStr = "mongodb+srv://mainuser:UpxzsOcbvTZKsFHO@cluster0.pattjaw.mongodb.net/?retryWrites=true&w=majority";
$client = new MongoDB\Client($connectionStr);
function queryCurrentCase($name){
    global $client;
    $db = $client->Case;
    $collection = $db -> CurrentPriceData;
    try{
        $singleObject =(array) $collection->findOne(['name'=>$name]);
        $price = $singleObject["lowest_price"];
    }catch (Exception $e){
        print_r($e);
    }
    return $singleObject;
}
function getMedian($name){
    global $client;
    $db = $client->Case;
    $collection = $db -> CurrentPriceData;
    try{
        $singleObject =(array) $collection->findOne(['name'=>$name]);
        $m= $singleObject["median_price"];
    }catch (Exception $e){
        print_r($e);
    }
    return $m;
}
function queryCaseData($name, $yeslimit, $limit){  
    global $client;
    $db = $client->Case; 
    $collection = $db->CasePriceData; 
    if(!$yeslimit){
        $cursor = $collection->find(['name'=>$name]);
    }else{
        //$cursor = $collection->find(['name'=>$name],['limit'=>$limit]);
        $counter= $collection->count(['name'=>$name]);
        $iterate = $counter-$limit;
        $cursor = $collection->find(['name'=>$name],['skip'=>$iterate]);
        
    }

    /*
    foreach ($cursor as $i){
        echo $i['lowest_price'];
        echo $i['dateTime'],"\n";
    }
    */
    $arr = array(); 
    foreach ($cursor as $i){
        $tempArr = array($i['lowest_price'],$i['dateTime']);
        array_push($arr,$tempArr);
        
    }
    return $arr;
    

}

function removeDollarSign($input){
    return substr($input,1);
}
?>