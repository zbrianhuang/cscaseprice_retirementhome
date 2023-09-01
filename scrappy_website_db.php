
<?php
require_once './vendor/autoload.php';//direct file path
//require_once './vendor/autload.php'; //vm
$connectionStr = "mongodb+srv://mainuser:UpxzsOcbvTZKsFHO@cluster0.pattjaw.mongodb.net/?retryWrites=true&w=majority";
$client = new MongoDB\Client(
    $connectionStr
);
$db = $client->Case;   
$collection = $db->CurrentPriceData; 
$case = $collection->find();
$date = "ten minutes ago i promise.";
try{
    $singleObject =(array) $collection->findOne(['name'=>"Recoil Case"]);
    $date = $singleObject["dateTime"];
}catch (Exception $e){
    print_r($e);
}

//idk
/*
foreach($case as $i){
    echo '<div class="case-wrap" data-id="';
    echo $i["_id"];
    echo '">';
    echo  '<div class="case-name">';
    echo $i["name"];
    echo "</div>";
    echo '<div class="case-price">';
    echo $i["median_price"];
    echo "</div>";
    echo '</div>';
}

*/
?>
