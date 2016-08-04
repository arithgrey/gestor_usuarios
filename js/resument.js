function  carga_resumen_ubicacion() {
	/**/
	url ="controller/mod.php"; 
	$.get(url , {"action" : "carga_resumen_ubicacion" , "ubicacion" : ubicacion }).done(function(data){
		
		$(".resumen").html(data);
	}).fail(function(){
		alert("Error al cargar");
	});
}