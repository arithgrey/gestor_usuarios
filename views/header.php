<br>
<div class='row'>
  <div class='col-lg-12 col-md-12'>
<nav class="navbar navbar-default" style='background:rgb(15, 62, 84);'>
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style='color:white;'>Gestor de posiciones konecta</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              
              <li class="dropdown" style='background:white;'>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <?=$_SESSION["user"]?>
                  <span class="caret">
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="user_password.php">
                    Cambiar password</a>
                  </li>
                  <!--
                  
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li> -->
                  
                  <li><a href="close.php">Salir</a></li>
                </ul>
              </li>
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
      <input type='hidden' name='usr' id='usr' class='usr' value='<?=$_SESSION["user"]?>'>
    </div>  
</div>      