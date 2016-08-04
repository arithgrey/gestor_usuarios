<?php	
	session_start();
	if($_SESSION["in_session"] !=  1 ){header("location:index.php");}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta charset='utf8'>	
<link rel="stylesheet" href="css/b1.css">
<link rel="stylesheet" href="css/b2.css">
<script src="js/j1.js"></script>
<script src="js/j2.js"></script>
<script src="js/j3.js"></script>
<script type="text/javascript" src="js/user.js"> </script>
<html>
 <head>
	 <title>
	 	Control konecta
	 </title>  
	 <link type="text/css" href="css/manager.css" rel="stylesheet">  
 </head>   
<body>
<div>
<link href="css/estilo.css" rel="stylesheet" type="text/css" media="screen" />	
	
				
	<div class='container'>
	

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="user-pass" action="controller/mod.php" method="post" role="form" style="display: block;">
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="passwordold" id="passwordold" tabindex="2" class="form-control" placeholder="Contraseña actual" required>
									</div>
									<label>Nueva</label>
									<div class="form-group">
										<input type="password" name="passwordn" id="passwordn" tabindex="2" class="form-control" placeholder="Nueva contraseña" required >
									</div>
									<label>Confirmación</label>			
									<div class="form-group">
										<input type="password" name="passwordconfirm" id="passwordconfirm" tabindex="2" class="form-control" placeholder="Confirmar nueva" required>
									</div>
									
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Cambiar password">
											</div>
										</div>
									</div>
								</form>

								<div style='display:none;' class='response_update well' id='response_update'></div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>

