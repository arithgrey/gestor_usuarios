$(document).ready(function(){
		$("#inicio,#fin").datepicker({dateFormat:'yy-mm-dd'});	
		$("#procesar").click(function(){
			if($("#inicio").val()==""){
				alert("Ingrese la fecha de inicio");
				return;
			}if($("#inicio").val()==""){
				alert("Ingrese la fecha final");
				return;
			}
			$("#form-periodo").submit();

		});

		$(".botonExcel").click(function(event) {   
			 $("#datos_a_enviar").val($("<div>").append($("#grid").eq(0).clone()).html());   
			 $("#frmExcel").submit();   
		});


	$("footer").ready(load_data_codificacion);			

});


/**/
function load_data_codificacion(){

	url = "controller/mod.php";

	$(".response").html("Cargando....");
	$.get(url , {"action" : "load_data_codificaciones_mod", "tipi" : "Llamar después" ,  "inicio" : ""  , "fin" : "" , "flag" : "1" } ).done(function(data){
		$("#table-dinamic").html(data);
		$(".val-tipificacion").change(load_dinamic);
		$(".response").html("");
	}); 

}

/**/
function load_dinamic(){

	$(".response").html("Cargando....");
	tipificacion = $(".val-tipificacion").val();


	
	


	$.get(url , {"action" : "load_data_codificaciones_mod", "tipi" : tipificacion  , "inicio" : $("#inicio").val()  , "fin" : $("#fin").val() , "flag" : "0" } ).done(function(data){
		$("#table-dinamic").html(data);
		$(".val-tipificacion").change(load_dinamic);
		$(".response").html("");

	}); 

	
}