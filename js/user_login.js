function   valida_session_user(e) {

	/**/
	flag  =  valida_form_login();
	if (flag>0) {

		url =  $("#login-form").attr("action");		
		data_send=  $("#login-form").serialize()+"&"+ $.param({action : "login_user"}); 
		$.ajax({url : url , 				
				method: "POST",
				data: data_send ,
				beforeSend: function(xhr){			
					$("#response_session").html("Validando datos ....");	
					$("#response_session").show();
				}		
		}).done(function(data){		

			if (data == 1){
				window.location.replace("");
			}else{
				$("#response_session").html("Credenciales de acceso incorrectas");
			}
			

		}).fail(function(){
				alert("Error al cargar datos");
		});

	}
	return false;
}
/**/
function valida_form_login(){
	username = $("#username").val(); 
	password =  $("#password").val(); 
	flag =1; 

	if (username.length ==  0 ) {
		flag =0; 
		$("#username").css('border' , '1px solid rgb(36, 60, 58)');
	}if (password.length ==  0) {
		$("#password").css('border' , '1px solid rgb(36, 60, 58)');
		flag =0; 	
	}
	return flag;
	
	
}