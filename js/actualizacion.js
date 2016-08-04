$(document).ready(function(){
	$("#form-actualizacion-usuario").submit(actulizacion);
});
/**/
function actulizacion(e){
	/**/
	alert($("#form-actualizacion-usuario").serialize());
	url =  "controller/actualiza.php";
	$.ajax({
		url , url , 
		type :"POST" , 
		data :  $("#form-actualizacion-usuario").serialize(), 
		beforSend:function(){
			/**/
			$(".usuarios_encontrados").html("Cargando ..");	
		}
	}).done(function(data){
		$(".usuarios_encontrados").html(data);	
	}).fail(function(){
		alert("Error al actulializar intente de nuevo ");
	});
	e.preventDefault();
}