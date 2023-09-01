

var listOfCases = document.getElementById('list-of-cases').getElementsByTagName('price');


for (var i = 0;i<listOfCases.length;i++) {

    //loop runs throughh
     var pc = calculatePriceChange(listOfCases[i].getAttribute("past_price"),listOfCases[i].getAttribute("current_price"));
    listOfCases[i].textContent="Price Change:"+pc;
    if(pc.charAt(0)==='+'){

        listOfCases[i].style.backgroundColor='#0F9D58';
    }else if(pc.charAt(0)==='-'){
        listOfCases[i].style.backgroundColor='#DB4437';
    }
}

function calculatePriceChange(oldPrice,newPrice){

    var oldDouble = parseFloat(removeDollarSign(oldPrice));
    var newDouble = parseFloat(removeDollarSign(newPrice));

    var pricechange= ((oldDouble-newDouble)/oldDouble)*100;

    var roundedPrice = Math.round(pricechange*1000)/1000;
    if(roundedPrice<0){
        return roundedPrice+"%";
    }else if (roundedPrice>0){
        return "+"+roundedPrice+"%";
    }else{
        return roundedPrice+"%";
    }
}
function removeDollarSign(input){
    var output = input.substring(1,input.length);

    return output;
}
