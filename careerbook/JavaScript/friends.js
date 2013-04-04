function frndAccept(frndId)
{
    
    $.post('../controller/mainentrance.php',{'action':'acceptFrnd','id':frndId},function(){
        
        
        
    	$("#aid"+frndId).html("<p class='ReqSentstatus'>Request Accepted</p>");
    	$("#cid"+frndId).html(" ");
        });
    
}

function frndDelete(frndId)
{
    var chk=window.confirm("Are You Sure");
    if(chk==true)
    	{

	    $.post('../controller/mainentrance.php',{'action':'delFrnd','id':frndId},function(){
	    	$("#aid"+frndId).html("<p class='ReqSentstatus'>Not Intrested</p>");
	    	$("#cid"+frndId).html(" ");
	        });
    	}
    else
    	{
    	
    	}
    
}
function cancle()
{	
	 window.location="userHomePage.php";
}
function viewFrnd(frndId)
{

	
	var key=$("#hash_code"+frndId).val();
	
	 window.location="userHomePage.php?information&user_id="+frndId+"&hash="+key;
	//window.open('http://google.com','_newtab');
	
	 //window.open('information.php?user_id='+frndId, '_newtab');
    
}