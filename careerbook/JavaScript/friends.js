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
function viewFrnd(frndId)
{

	 window.location="userHomePage.php?information&user_id="+frndId;
	//window.open('http://google.com','_newtab');
	
	 //window.open('information.php?user_id='+frndId, '_newtab');
    
}