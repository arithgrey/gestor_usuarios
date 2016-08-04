<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<div class="row">
    <div>


        <div class='p-oculpar'> 
        
            ocultar
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
        
        </div>
        <div class='p-mostrar'>            
            Últimas actividades
            <i class="fa fa-chevron-up" aria-hidden="true">
            </i>           
        </div>
        <div class='p-ultimas'> 
            <div class='contenedor-log'></div>                     
        </div>
    </div>
</div>


    

<style type="text/css">
.contenedor-log{
    display: none;
}
.p-ultimas{
    margin-right: 50px;
    font-size: .9em;
    position: fixed;
    bottom: 30px;
    left: 10px;
    width: 100%;
}
.p-oculpar{
    margin-right: 50px;
    font-size: .9em;
    position: fixed;
    bottom: 10px;
    left: 10px;
    width: 100%;
    display: none;
    z-index: 100;
}
.p-mostrar{
    margin-right: 50px;
    font-size: .9em;
    position: fixed;
    bottom: 10px;
    left: 10px;
    width: 100%;
   
}

.p-ultimas:hover{
    cursor: pointer;
}

.p-ultimas:hover   .contenedor_log {
   background: red;
}
.contenedor-log{
    height: 230px;
    width: 100%;
    background: #000000;
}
</style>


<script type="text/javascript">
$(document).ready(function(){
    $(".p-mostrar").click(carga_log_actividades);  
    $(".p-oculpar").click(oculata_contenedor);    

});

function oculata_contenedor(){
    $(".contenedor-log").hide();  
    $(".p-mostrar").show();
     $(".p-oculpar").hide();
}
function carga_log_actividades(){     
    $(".contenedor-log").show();    
    $(".p-oculpar").show();
    $(".p-mostrar").hide();
    url = "controller/log_actividades.php";
    $.ajax({                
        url :  url ,
        type: "GET",
        beforeSend:function(){
            $(".contenedor-log").html("Cargando ... ");
        }
    }).done(function(data){
            $(".contenedor-log").html(data);
    }).fail(function(){
            $(".contenedor-log").html("Falla al cargar log c");
    }); 
}
</script>