$(document).ready(function(){
	$("#busqueda_user").submit(busqueda_user);	
	$(".nuevo_user").click(load_nuevo_user);
	$(".bajas_users_button").click(carga_ususarios_por_baja);

	$(".lista_asistencia").click(carga_asistencia_movistar);


});


/**/
function  busqueda_user(e){

	url = "controller/data_user.php/format/html/"; 
	e.preventDefault();
	$.ajax({
		url :  url , 
		type: "GET" ,		
		data : $("#busqueda_user").serialize() , 
		dataType: "HTML" , 
		beforeSend: function(){
				$(".usuarios_encontrados").html("Cargando ..");	
		}
	}).done(function(data){
		$(".usuarios_encontrados").html(data);
		$(".baja_user").click(dar_baja_user);
		$(".alta_mod").click(alta_modificacion);

	
	}).fail(function(){
		alert();
	});

}
/**/
function dar_baja_user(e){
	
	/**/
	usuario =  e.target.id; 
	confirm =  confirm("Segurio quiere dar de baja al usuario el usuario "+ usuario  +"???? ");

	if (confirm ==  true) {

		update_user_baja_212(usuario); 
	}
}
/**/
function update_user_baja_212(usuario){
	
	/**/	
	user_modifica =  $("#user_actual").val();
	url  =  "controller/user_baja.php";

	$.ajax({	

		url :  url ,
		data :  {user_modifica : user_modifica , usuario : usuario }  , 
		type : "GET", 
		dataType :  "HTML", 
		beforeSend :  function(){
			//alert("antes "); 
			$(".usuarios_encontrados").html("Actualizando ....");		
		}

	}).done(function(data){

		$(".usuarios_encontrados").html(data);		 


	}).fail(function(){
		alert("Error al dar de baja al usuario en la 212 ");
	});
}
/**/
function alta_modificacion(e){
	user  =  e.target.id;	
	url = "controller/data_user_mod.php/format/html/"; 
	e.preventDefault();
	$.ajax({
		url :  url , 
		type: "GET" ,		
		data :  {user : user }, 
		dataType: "HTML" , 
		beforeSend: function(){
				$(".usuarios_encontrados").html("Cargando ..");	
		}
	}).done(function(data){

		$("#usuarios_encontrados").html(data);
	
	}).fail(function(){
		alert();
	});
}
/**/
function load_nuevo_user(){

	$.ajax({
		url : "controller/nuevo.php",
		dataType: "HTML", 
		type : "GET", 
		beforeSend : function(){
			$(".usuarios_encontrados").html("Cargando ..");	
		}

	}).done(function(data){
		$(".usuarios_encontrados").html(data);	
		
	}).fail(function(){
		alert("Falla al cargar ");
	});
}
/**/
function carga_ususarios_por_baja(){

	user_actual =  $("#user_actual").val();		
	url =  "controller/user_por_baja.php";		
	$.ajax({
		url : url , 
		data: {"user_actual" :  user_actual } , 
		type :  "GET", 
		beforeSend:function(){
			$(".usuarios_encontrados").html("Cargando ..");	
		}
	}).done(function(data){
		
		$(".usuarios_encontrados").html(data);	
		$(".baja_user").click(dar_baja_user);
		
	}).fail(function(){
		alert("Error al cargar ");
	});


}
/**/
function carga_asistencia_movistar(){
	$(".container-users").hide();
	url = "controller/asistencia.php";  
	$.ajax({
		url :  url , 
		type : "GET" , 
		beforeSend :  function(){
			//$(".contenedor_asistencia").html("Cargando ..... ");
			$("#load_asistencia").show();
		}
	}).done(function(data){
		$(".contenedor_asistencia").html(data);
		$("#load_asistencia").hide();
	}).fail(function(){
		$(".contenedor_asistencia").html("Error al cargar la asistencia, reporte a jgovindams@grupokonecta.com");
		$("#load_asistencia").hide();
	});


}