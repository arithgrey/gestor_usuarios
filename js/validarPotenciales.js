
function validarObligatorios(){

	if(!$("#idtrack").val()) {alert("Falta Agregar un TRACK"); return false;}
	if($("#tipo").val()==0) {alert("Falta Seleccionar un Producto"); return false;}
	if(!$("#cantidad").val()) {alert("Falta Agregar una cantidad"); return false;}
	var si
	si=confirm("Esta Seguro de guardar los Datos");
	if(si) $("#frmPotencial").submit()

	//if(confirm("Esta Seguro de guardar los Datos"))//	$("#frmPotencial").submit()
}


function validarObligatoriosT(){
/*
	//if($("#cboAgente").val()==0) {alert("Falta Seleccionar un Agente"); return false;}
	var str=$("#idtrack2").val();
	var n=str.substr(0,1);
	var c=str.substr(1,6);
	//alert(c);
	
	//if(!$("#cboAgente").val() || $("#cboAgente").val()=="Array") {alert("Falta Definir un Agente, REINICIE SU SESION"); return false;}
	if(!$("#idtrack2").val()) {alert("Falta Agregar un TRACK"); return false;}
	//if($("#idtrack").val()=="."||$("#idtrack").val()=="?") {alert("TRACK no valido"); return false;}
	
	if(!isNaN(n)||n=="."||n=="?"||n=="*"||n=="/"){alert(" TRACK no valido-Primero Letra"); return false;}
	if(isNaN(c)){alert(" TRACK no valido-ultimos digitos tienen que ser numéricos"); return false;}
	if(str.length<7){alert(" TRACK no valido-tienen que ser 6 digitos"); return false;}
	//if (isNaN($.trim($("#idtrack").val()))){ alert("EL MSISDN  TIENE QUE SER NUMERICO"); return false;} 
	if($("#tipo").val()==0) {alert("Falta Seleccionar un Producto"); return false;}
	if(!$("#cantidad").val()) {alert("Falta Agregar una cantidad"); return false;}
	*/
	var si;
	si=confirm("Esta Seguro de guardar los Datos");
	if(si) $("#frmTelegestion").submit();

	//if(confirm("Esta Seguro de guardar los Datos"))//	$("#frmPotencial").submit()
}