<?php   
    session_start();
    if($_SESSION["in_session"] !=  1 ){header("location:index.php");}   
    require "controller/model/conexion72.php";
    $db_konecta = new  db_konecta();
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta charset='utf8'>
<link rel="stylesheet" href="css/b1.css">
<link rel="stylesheet" href="css/b2.css">
<script src="js/j1.js"></script>
<script src="js/j2.js"></script>
<script src="js/j3.js"></script>

<script type="text/javascript" src="js/principal_gestor_users.js"></script>

<a href="close.php" class='pull-right' style="margin-right: 50px; color: rgb(101, 154, 168); background: rgb(251, 251, 251) none repeat scroll 0% 0%; padding: 10px;">
  <span>
        salir
  </span>
</a>
<a href="user_password.php" class='pull-right' style="margin-right: 1px; color: rgb(101, 154, 168); background: rgb(251, 251, 251) none repeat scroll 0% 0%; padding: 10px;">
  <span>
        Cambiar password
  </span>
</a>
<a href="" class='pull-right' style="margin-right: 1px; color: rgb(101, 154, 168); background: rgb(251, 251, 251) none repeat scroll 0% 0%; padding: 10px;">
  <span>
    <?=$_SESSION["user"]?>
  </span>
</a>
<a  class='pull-right lista_asistencia ' id="lista_asistencia" style="margin-right: 1px; color: rgb(101, 154, 168); background: rgb(251, 251, 251) none repeat scroll 0% 0%; padding: 10px;">
  <span>
    Lista de asistencia Movistar
  </span>
</a>


<div class="jumbotron">
  <h1>Bienvenido </h1>
  <h2 style='margin-left: 100px;'>
  	<small>
  	Gestión de usuarios
  	</small>    
</h2>
</div>
<input type="hidden" name='user_actual' id="user_actual" value="<?=$_SESSION['user'];?>" >

<?php  require "views/log/log_user.php";  ?>

                        
                     





<style type="text/css">
@-webkit-keyframes ld {
  0%   { transform: rotate(0deg) scale(1); }
  50%  { transform: rotate(180deg) scale(1.1); }
  100% { transform: rotate(360deg) scale(1); }
}
@-moz-keyframes ld {
  0%   { transform: rotate(0deg) scale(1); }
  50%  { transform: rotate(180deg) scale(1.1); }
  100% { transform: rotate(360deg) scale(1); }
}
@-o-keyframes ld {
  0%   { transform: rotate(0deg) scale(1); }
  50%  { transform: rotate(180deg) scale(1.1); }
  100% { transform: rotate(360deg) scale(1); }
}
@keyframes ld {
  0%   { transform: rotate(0deg) scale(1); }
  50%  { transform: rotate(180deg) scale(1.1); }
  100% { transform: rotate(360deg) scale(1); }
}

.m-progress {
    position: relative;
    opacity: .8;
    color: transparent !important;
    text-shadow: none !important;
}

.m-progress:hover,
.m-progress:active,
.m-progress:focus {
    cursor: default;
    color: transparent;
    outline: none !important;
    box-shadow: none;
}

.m-progress:before {
    content: '';
    
    display: inline-block;
    
    position: absolute;
    background: transparent;
    border: 1px solid #fff;
    border-top-color: transparent;
    border-bottom-color: transparent;
    border-radius: 50%;
    
    box-sizing: border-box;
    
    top: 50%;
    left: 50%;
    margin-top: -12px;
    margin-left: -12px;
    
    width: 24px;
    height: 24px;
    
    -webkit-animation: ld 1s ease-in-out infinite;
    -moz-animation:    ld 1s ease-in-out infinite;
    -o-animation:      ld 1s ease-in-out infinite;
    animation:         ld 1s ease-in-out infinite;
}

.btn-default.m-progress:before {
    border-left-color: #333333;
    border-right-color: #333333;
}

.btn-lg.m-progress:before {
    margin-top: -16px;
    margin-left: -16px;
    
    width: 32px;
    height: 32px;
}

.btn-sm.m-progress:before {
    margin-top: -9px;
    margin-left: -9px;
    
    width: 18px;
    height: 18px;
}

.btn-xs.m-progress:before {
    margin-top: -7px;
    margin-left: -7px;
    
    width: 14px;
    height: 14px;
}
</style>








<div class='container container-asistencia'>
  <center style="display:none;" id='load_asistencia'>
    <button class="btn m-progress" >
    Cargando
    </button>
    <br>
    Cargando ...
  </center>
  <div class='contenedor_asistencia'></div>
</div>
<div class="container container-users">

  <div class='row'>
    <button type="button" class="btn btn btn-info nuevo_user">
      +Nuevo
    </button>
    <button type="button" class="btn btn btn-danger bajas_users_button">
      Posibles bajas
    </button>
  </div>
  <br>

	<div class="row">
        <div class="span12">
            <form method="GET" action="" id="busqueda_user" class="form-inline" >
                <input name="q" class="span5 form-control" type="text"  placeholder="Usuario" >
                <!--<input name="login_b" class="span5 form-control" type="text"  placeholder="1815..." >-->
                <select class='form-control' name='pais'>
                	<option value="TODOS">
                		Todos
                	</option >
                	<option value="PERU" >
                		PERU
                	</option >
                	<option value="MEXICO">
                		MEXICO
                	</option >
                	<option value="COLOMBIA">
                		COLOMBIA
					       </option>
					<option value="ESPAÑA">
						ESPAÑA
					</option>
                </select>


                <select class='form-control' name='cargo'>
                  <option value="3">
                    Agente
                  </option>
                  <option value="2">
                    BO
                  </option>
                  <option value='1'>
                    Supervisor
                  </option>
                  <option value="9">
                    Validación
                  </option>
                </select>

                <select class='form-control' name='activo'>
                  <option value="1">
                    Activos
                  </option >
                  <option value="0">
                    Bajas
                  </option >                
                </select>







                <button type="submit" class="btn btn-primary"> 
                	búsqueda<i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>


    <div class='row'>

        <div class='usuarios_encontrados' id="usuarios_encontrados">
        </div>

    </div>
</div>




<input type="hidden" id="user_actual"  value="<?=$_SESSION["user"]?>">








































<!-- 
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
-->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog lg">    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
            Alta usuario
        </h4>
      </div>
      <div class="modal-body">
         <div class='user_mod'>
         </div>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


