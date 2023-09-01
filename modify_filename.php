<?php

function replaceFileName($originalName){   
    $newFileName = str_replace(" ","_",$originalName);
    return $newFileName;
   // echo join("",["./case_images/",$newFileName,".png"]);
}

?>