function showData() {
//	 alert("hello");
	// var frmElm = $("#elmSearch").attr("id");
	// var elmVal = $("#"+frmElm).attr("value");
	// var frmElm = frmElm + "=";
	// alert(elmVal);
	$.ajax({
		type : 'post',
		data : $('#frmlogindata').serialize(),
		// data: frmElm + "=".concat($("#"+frmElm).attr("value")),
		url : 'mainentrance.php',
		success : function(data) {
			$("#disptable").html(data);
		}
	});
//	 return false;
}