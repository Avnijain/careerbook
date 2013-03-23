function frndAccept(frndId)
{
    
    $.post('../controller/mainentrance.php',{'action':'acceptFrnd','id':frndId},function(){
        
        
        
        alert(frndId);
        });
    
}