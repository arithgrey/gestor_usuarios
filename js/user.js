$(document).ready(function(){

	$("#user-pass").submit(actualiza_pass);

});
/**/
function  actualiza_pass(){
	
	url = "controller/mod.php"; 

	$.post(url , $("#user-pass").serialize() + "&" + $.param({"action" : "actualiza_password"}) ).done(function(data){
		$(".response_update").html(data);
		$(".response_update").show();
	}).fail(function(){	
		alert("Error");		
	});
	return  false;
}
