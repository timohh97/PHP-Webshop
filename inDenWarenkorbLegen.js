function inDenWarenkorbLegen(clicked_id)
{

    alert(clicked_id+" hinzugefügt!");
    
    var shoppingCart = localStorage.getItem("shoppingCart");
    
    
    if(shoppingCart=="")
    {
        shoppingCart=clicked_id;
    }
    else
    {
        shoppingCart = shoppingCart+","+clicked_id;
    }
    
    
    localStorage.setItem("shoppingCart",shoppingCart);
    
    warenkorbAnzeigen();
    
}

function warenkorbAnzeigen()
{
    document.getElementById("warenkorb").innerHTML=localStorage.getItem("shoppingCart");
}


function warenkorbEntleeren()
{
   localStorage.setItem("shoppingCart","");
   warenkorbAnzeigen();
}