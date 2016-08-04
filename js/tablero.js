/***********************************/
function  try_update_posicion(e) {				

			usr =  $("#usr").val();
			ubicacion=  $("#ubicacion").val();
			posicion =  e.target.id; 
			$("#dinamic_pos").val(posicion);	
			$("#ip").val("");
			$("#ext").val("");	
			$('.srv_aes > option[value="-"]').attr('selected', 'selected'); 
			$('.modelo_telefono > option[value="-"]').attr('selected', 'selected'); 

			

			$("#modelo_telefono").val("");		
			url =  "controller/mod.php/format/json/";	
			$(".update-ip-ext").click(update_data_ip_ext);
			
			$.ajax({url : url , 				
					method: "GET",
					data: {posicion : posicion , action : "list" , "ubicacion" :  ubicacion , "usr" : usr}
				,
				beforeSend: function(xhr){
					$(".load_pos").show();
				}		
			}).done(function(data){

				if(data.length == 0 ){$(".load_pos").hide();}

					puesto =  data[0].puesto; 
					pc_ip =  data[0].pc_ip; 
					pc_nombre = data[0].pc_nombre;
					voz_extension =  data[0].voz_extension; 
					modelo_telefono  =  data[0].modelo_telefono;
					srv_aes =  data[0].srv_aes; 

					$(".load_pos").hide();
					$("#ip").val(pc_ip);
					
					$("#ext").val(voz_extension);					
					$('.srv_aes > option[value="'+srv_aes+'"]').attr('selected', 'selected'); 
					$('.modelo_telefono > option[value="'+modelo_telefono+'"]').attr('selected', 'selected'); 
					


					$("#modelo_telefono").val(modelo_telefono);
					
				
				
			}).fail(function(){

				alert("Error al cargar datos");
			});	
			var posicion = 0; 
	}
/**/
/**/
function get_plano(){

	url =  "controller/mod.php"; 
	$.ajax({
			url : url , 
			method: "GET",
			data: { "action" : "plano" , "ubicacion" : ubicacion }
			,
				beforeSend: function( xhr ){

					$("#img-load-panel").show();

				}
	}).done(function(data){
				
				
				$(".pasillos").html(data);
				$(".posicion_edit").click(try_update_posicion);	
				$("#img-load-panel").hide();				
				$(".elimina-posicion").click(datos_eliminar);				

	}).fail(function(){
			//alert("Error");
	});


	carga_resumen_ubicacion();

}

/*************************************/
function update_data_ip_ext(){

		usr =  $("#usr").val();
		pos =  $("#dinamic_pos").val();
		if (pos> 0  ) {			
			url =  "controller/mod.php"; 		
			ubicacion=  $("#ubicacion").val(); 
			$.post(url , $("#form-update-ip").serialize()+"&"+ $.param({ action: "update_data_posicion" , "ubicacion" :  ubicacion , "usr" : usr }) ).done(function(data){							
				
			
				$(".response-update").html(data);						
				$('#posiciones_modal').modal('hide');

				get_plano();			
			}).fail(function(){
				alert("Error al actualizar los datos de la posición");
			}); 	
		}	
		

}

function datos_eliminar(e){

	url =  "controller/mod.php"; 		
	posicion =  e.target.id; 			
	$(".dinamic_del").val(posicion);
	$("#eliminar-pos").click(function(){
		posicion =  $(".dinamic_del").val();	
		usr =  $("#usr").val();
		$.post(url , { "action" : "eliminar" , "posicion" : posicion , "ubicacion" : ubicacion , "usr" : usr } ).done(function(data){
			
			$('#posiciones_del_modal').modal('hide');
			get_plano();			
		}).fail(function(){
			alert("Error al eliminar los datos de la posición");
		});

	});
}
/**/
/**********************************************PERU *************************************************/
/**********************************************PERU *************************************************/
function  carga_datos_peru(puesto , pasillo ){	
	/**/
	$.get(url , {"puesto" : puesto , "pasillo" : pasillo }).done(function(data){
		alert(data);
	}).fail(function(){
		alert("Falla al cargar datos reportar.");
	});	
	/**/
}