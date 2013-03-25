function frndAccept(frndId)
{
    
    $.post('../controller/mainentrance.php',{'action':'acceptFrnd','id':frndId},function(){
        
        
        
    	$("#aid"+frndId).html("<p class='ReqSentstatus'>Request Sent</p>");
    	$("#cid"+frndId).html(" ");
        });
    
}