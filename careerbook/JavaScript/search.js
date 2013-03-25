function addFrnd(frndId)
{
    
    $.post('../controller/mainentrance.php',{'action':'addFrnd','id':frndId},function(){
        
        
        $("#aid"+frndId).html("<p class='ReqSentstatus'>Request Sent</p>");
        
        });
    
}