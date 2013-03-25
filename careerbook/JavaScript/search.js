function addFrnd(frndId)
{
    
    $.post('../controller/mainentrance.php',{'action':'addFrnd','id':frndId},function(){
        
        
        
        alert(frndId);
        });
    
}