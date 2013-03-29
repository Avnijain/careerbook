function frndAccept(frndId)
{
    
    $.post('../controller/mainentrance.php',{'action':'acceptFrnd','id':frndId},function(){
        
        
        
    	$("#aid"+frndId).html("<p class='ReqSentstatus'>Request Accepted</p>");
    	$("#cid"+frndId).html(" ");
        });
    
}

function frndDelete(frndId)
{
    
    $.post('../controller/mainentrance.php',{'action':'delFrnd','id':frndId},function(){
        
        
        
    	$("#aid"+frndId).html("<p class='ReqSentstatus'>Not Intrested</p>");
    	$("#cid"+frndId).html(" ");
        });
    
}