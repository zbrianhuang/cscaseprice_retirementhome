<!DOCTYPE html>
<html>

<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-B8TSHX5BN9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-B8TSHX5BN9');
</script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>CS:GO Case Prices</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="./favicon.ico?">
  <link href="./style.css" rel="stylesheet" type="text/css" />
  

  
</head>

<body >
<navigation>
    <div class="header">
        <l>CSGO Case Prices</l>
        <div class ="rightAlign">
            <l><a href="index.php" >Home</a></l>
            <l><a href="about.html" >About</a></l>

        </div>
    
    </div>    
  </navigation> 


  <div id="list-of-cases" onload="setPriceChange()">

      <?php 
      require "scrappy_website_db.php";
      require "modify_filename.php";
      require "./cases/query.php";
      
      foreach ($case as $i) { 
        list($pPrice,$cPrice)=queryCasePrices($i["name"]);
      ?>
      <a href=<?php echo join("",["./cases/",replaceFileName($i["name"]),"/index.php"])?> > 
     
        <div class="case-wrap" data-id="<?=$i["_id"]?>" id="<?=$i["url"]?>">
          <div class="case-name"><?=$i["name"]?></div>
          <div class="case-price">Price: <?=$i["median_price"]?></div>
          <price past_price= <?php echo $pPrice ?> current_price=<?php echo $cPrice ?>> </price>
          <img src=<?php echo join("",["./case_images/",replaceFileName($i["name"]),".png"])?>>
        </div>
      </a>
      <?php }
      
    ?>
    </div>
    <script src="./script.js"></script> 
    
    <footer>

    
    <p>Case Prices Last Updated: <?php require "scrappy_website_db.php"; echo $date;?></p>  
    <a href = "./about.html"><p>About</p></a>
    <a href ="https://github.com/zbrianhuang/cscaseprice"><p>Github</p></a>
  </footer>
</body>

</html>
