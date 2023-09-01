<!DOCTYPE html>
<html>
<!-- 
    TODO
    link to case


-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Spectrum Case - CS:GO Case Prices</title>
  <link rel="icon" type="image/x-icon" href="../../favicon.ico?">
  <link href="../../style.css" rel="stylesheet" type="text/css" />
  <script src = "./price_chart.js"></script>
  <script>
    <?php 
    require "../case_query.php";
    $name = "Spectrum Case";
        //$phpPriceArray = json_encode(queryCaseData("Chroma Case",1,48));
    $caseObj = queryCurrentCase($name);
    $caseName = $caseObj["name"];
    $currentPrice = $caseObj["lowest_price"];
    $currentVolume = $caseObj["volume"];
    $phpArray = queryCaseData($name,1,350);
    $medianPrice = getMedian($name);
    $phpPriceArray=[];
    $phpDateArray=[];
    
    for($i= 0;$i<count($phpArray);$i++){
        array_push($phpPriceArray,$phpArray[$i][0]);
        array_push($phpDateArray,$phpArray[$i][1]);
    }
    echo "var caseName = '" . $caseName . "';";
    echo "var currentPrice = '". $currentPrice . "';";
    echo "var currentVolume = '". $currentVolume."';";
    echo "var jsPriceArray = ". json_encode($phpPriceArray) . ";";
    echo "var jsDateArray =" . json_encode($phpDateArray) . ";";
    echo "var medianPrice = '" . $medianPrice . "';";
    ?>;
    var ctx;
    var myChart;
    var displayPriceArray=[];
    var displayDateArray=[];

    for(var i= 0;i<jsPriceArray.length;i++){
                //jsDateArray[i] = jsDateArray[i].substring(5,19);
                displayDateArray.push(jsDateArray[i].substring(5,16));
                //jsPriceArray[i]=jsPriceArray[i].substring(1);
                displayPriceArray.push(jsPriceArray[i].substring(1));
            }
   
       
         
    function chart(relative){
        ctx = document.getElementById('priceChart').getContext('2d');
            
        myChart = new Chart(ctx, {
            type: 'line',
            plugins:{
                legend:{
                    display:false
                }
            }   
            ,
            data: {
        //labels: ['12:00','1:00','2:00','3:00','4:00','5:00','6:00','7:00','8:00','9:00','10:00','11:00'],
                labels:displayDateArray,
                datasets: [{
                label: 'USD',
                data:displayPriceArray,
                backgroundColor: [
                    'rgba(66, 132, 244,0.7)'
                ],
                borderColor: [
                    'rgba(66, 132, 244,1)'
                ],
                pointBackgroundColor: ['rgba(255,99,132,0)'],
                pointBorderColor: ['rgba(255,99,132,0'],
                fill:true,
                borderWidth: 2,
                
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero:relative
                }
            }
        }
    });
        
        }
        function changeDate(howManyToShow){
            displayPriceArray =[];
            displayDateArray=[];
            var cut = howManyToShow;
            for(var i = jsPriceArray.length-howManyToShow;i<jsPriceArray.length;i++){
                
                displayDateArray.push(jsDateArray[i].substring(5,19));
                displayPriceArray.push(jsPriceArray[i].substring(1)); 
            }
            myChart.data.labels=displayDateArray;
            myChart.data.data=displayPriceArray;
            myChart.update();
        }
        function changeGraphMode(){
            
            if(myChart.options.scales.y.beginAtZero==false){
                myChart.options.scales.y.beginAtZero=true;
                myChart.update();
            }else{
                myChart.options.scales.y.beginAtZero=false;
                myChart.update();
            }

            
        }  
        function onLoad(){

            changeDate(12);
        } 
  </script>
</head>

<body onload="onLoad()">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <navigation>
    <div class="header">
        <l><a href="index.php">CSGO Case Prices</a></l>
        <div class ="rightAlign">
            <l><a href="../../index.php" >Home</a></l>
            <l><a href="../../about.html" >About</a></l>

        </div>
    
    </div>    
  </navigation> 
 
    <h1 id=title>Loading...</h1>
    <div id="chart_div">
        <canvas id="loading"></canvas>
        <canvas id="priceChart" >
            <p>error</p>
        </canvas>
        <button onclick="changeGraphMode()">Toggle Relative Price</button>
        <button onclick="changeDate(12)"> 12 hours</button>
        <button onclick="changeDate(24)"> 1 Day</button>
        <button onclick="changeDate(168)">1 Week</button>
        <button onclick="changeDate(350)">1 Month</button>
        
        <p id="stats"></p>

    </div>
    
      
    <script>
        chart(true);
        var t = document.getElementById("title");
        t.innerHTML = caseName;
        var p = document.getElementById("stats");
        p.innerHTML = "Name: "+caseName+"<br> Lowest Price: "+currentPrice+"<br> Median Price: "+medianPrice+"<br> Volume: "+currentVolume;
        
</script>
    <footer>

    

    <a href = "../../about.html"><p>About</p></a>
    <a href ="https://github.com/zbrianhuang/cscaseprice"><p>Github</p></a>
  </footer>
</body>

</html>
