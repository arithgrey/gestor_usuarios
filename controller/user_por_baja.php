<?php
        
    require "model/conexion72.php";
        $db_konecta = new  db_konecta();    
        $user_actual=    $_GET["user_actual"];

        /**/
        $query_drop =  "drop table if exists  campania_mexico.logines_empleados_campania;"; 
         $db_konecta->query_db_local($query_drop) ." ok  al borrar de tabla de logines sin usar"; 
        $query_insert ="CREATE TABLE  campania_mexico.logines_empleados_campania  AS  
                        SELECT 
                        logid 
                        FROM PBX_mx.hagent  
                        WHERE skill
                        IN (
                        '3000' , '3001', '3002' , '3005' 
                        )
                        AND  row_date BETWEEN 
                        DATE_ADD(CURRENT_DATE() ,  INTERVAL -8 DAY)
                        AND 
                        CURRENT_DATE()
                        group by logid"; 

        $db_konecta->query_db_local($query_insert ); 


    /*eliminamos la tmp */
    $query_drop =  "drop table if exists  campania_mexico.logines_no_empleados_campania;"; 
     $db_konecta->query_db_local($query_drop);      



    $sql_no_activos = "create 
                       table  
                       campania_mexico.logines_no_empleados_campania as  
                       select  * from  kapd_Movistar_Mexico_Portabilidad.logines_porta_2016 where  login not in(select * from campania_mexico.logines_empleados_campania );";    
     $db_konecta->query_db_local($sql_no_activos);          

    /*ahora sacamos todos los que están como activos */
    $sql = "select * from usuario where  login in(select login from  campania_mexico.logines_no_empleados_campania ) and estado = 1"; 
    $user_por_baja =   $db_konecta->query_db_local($sql);         




    $data_complete  = array();
    while( $row =  mysql_fetch_array($user_por_baja) ) {
        $data_complete[] =  $row;
    }

?>


<br>
#Usuarios posibles por dar de baja <?=count($data_complete) ?>
<div <?=$height;?> >
<table  border="1" style="font-size:.8em; text-align:center; padding:10px; width:100%;"    cellspacing='10'>
    <tr style='background:rgb(8, 41, 57); color:white; padding:10px;'>                                 
                <td>
                    Modificar estado
                </td>
                <td>
                    Usuario
                </td>
                <td>
                    Login
                </td>
                <td>
                    Skill 
                </td>
                <td>
                    Nombre
                </td>             
                <td>
                    Estado
                </td>
                <td>
                    Ubicacion
                </td>                          
                <td>
                    UltimaSession
                </td>            
                <td>
                    Centro
                </td>
                <td>
                    Servicio
                </td>
                <td>
                    Cargo
                </td>
                <td>
                    Jefe Actual
                </td>
                <td>
                    Localidad
                </td>                            
    </tr>
    <?php
        
        foreach ($data_complete as $row) {

            $nombre = $row["nombre"];        
            $estado =  $row["estado"];
            if ($estado == 1 ){
                $estado = "Activo";                 
            }else{
                $estado = "Baja";               
            }
            $ubicacion =  $row["ubicacion"];
            $login =  $row["login"];
            $username_usuario =  $row["username_usuario"];
            $ultimaSession =  $row["ultimaSession"];            
            $centro =  $row["centro"];
            $servicio =  $row["servicio"];
            $cargo =  $row["nombre_cargo"];
            $jefeActual =  $row["jefeActual"];           
            $skill =  $row["skill"];

            echo "<tr style='font-size:.8em; text-align:center; padding:10px;' > ";
                
                if ($estado  ==  "Activo") {
                    echo $db_konecta->td("<a class='baja_user' id='".$username_usuario."'>Dar baja </a>"   );   
                }else{
                    echo $db_konecta->td(" " );
                }
                
                echo  $db_konecta->td($username_usuario);   
                echo  $db_konecta->td($login);
                echo  $db_konecta->td($skill);
                echo  $db_konecta->td($nombre);                
                echo  $db_konecta->td($estado);
                echo  $db_konecta->td($ubicacion);                
                echo  $db_konecta->td($ultimaSession);         
                echo  $db_konecta->td($centro);
                echo  $db_konecta->td($servicio);
                echo  $db_konecta->td($cargo);
                echo  $db_konecta->td($jefeActual);
                echo  $db_konecta->td($localidad);
       
            echo "</tr>";
        }

    ?>
    </table>


</div>
