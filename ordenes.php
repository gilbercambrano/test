<?php
    session_start();

  if(!empty($_SESSION)){

    if($_SESSION['perfil'] == "ADMINISTRADOR" || $_SESSION['perfil'] == "SUPERINTENDENTE DE OBRA" || $_SESSION['perfil'] == "ESTIMACIONES" ){

    /* INCLUSION DE LIBRERIAS */

     include_once("../library/Componente.php");
     include_once("../library/Sector.php");
     include_once("../library/OrdenServicio.php");
     include_once("../library/Usuario.php");

     $componente = new Componente();
     $sector = new Sector();
     $orden_servicio = new OrdenServicio();
     $usuario = new Usuario();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../img/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" href="../css/ui-lightness/jquery-ui.css" />
    <script src="../js/jquery-1.8.3.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script type="text/javascript">
      $(function(){

        $("#fecha_programada_inicio").datepicker({
          changeYear: true,
          changeMonth: true,
          yearRange: "1950:2020",
          dateFormat:"yy-mm-dd",
          monthNamesShort:["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
          dayNamesMin:["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"]
        });

        $("#fecha_programada_fin").datepicker({
          changeYear: true,
          changeMonth: true,
          yearRange: "1950:2020",
          dateFormat:"yy-mm-dd",
          monthNamesShort:["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
          dayNamesMin:["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"]
        });

      });
    </script>
<title>.:Generador de obra:. </title>
</head>

<body>
<div id="container">
    <div id="header">
          
          <div id="pemex"></div>
          <div id="usuario" >

            
            <table>
              <tr>
                <th width="380">Sistema Electrónico  de Generadores de Obras</th>
              </tr>
              <tr width="350">
                <td style="text-align:left; width:350px;">Bienvenido <?php echo $_SESSION['nombre']; ?></td>
                <td style="text-align:center;"><a title="Cerrar sesión" style="color:#FFFFFF;" href="../library/cerrar.php">Salir</a></td>
              </tr>
            </table>
          </div>
            <div id="smt"></div>

        </div> 
        
        <div id="menu">
        	<?php
            echo $componente->getMainMenu();
            ?>
        </div>
        
        <div id="leftmenu">

        <div id="leftmenu_top"></div>

				<div id="leftmenu_main">    
                
               <?php
               echo $componente->getMenuAdministracion();
               ?>
</div>
                
                
              <div id="leftmenu_bottom"></div>
        </div>
        
        
        
        
		<div id="content">
        
        
        <div id="content_top"></div>
        <div id="content_main">
            <!-- INICIO DE LA PARTE EDITABLE -->

            
            <div id="contenido" >
              <div id="title" >

              </div>
              <div id="elementos" >

                <?php
                  if(!empty($_GET) && $orden_servicio->loadById($_GET['id_orden_servicio']) ){
                    $id = $orden_servicio->getId();
                    $id_sector = $orden_servicio->getSector();
                    $numero_orden = $orden_servicio->getNumeroOrden();
                    $ducto = $orden_servicio->getDucto();
                    $ubicacion_tecnica = $orden_servicio->getUbicacionTecnica();
                    $estatus = $orden_servicio->getEstatus();
                    $fecha_programada_inicio = $orden_servicio->getFechaProgramadaInicio();
                    $fecha_programada_fin = $orden_servicio->getFechaProgramadaFin();
                    $fecha_inicio_trabajo = $orden_servicio->getFechaInicioTrabajo();
                    $fecha_fin_trabajo = $orden_servicio->getFechaFinTrabajo();
                    $monto_estimado = $orden_servicio->getMontoEstimado();
                    $observaciones = $orden_servicio->getObservaciones();
                    $supervisor= $orden_servicio->getSupervisor();
                    $action = "update";
                  }
                  else{
                    $id = '';
                    $id_sector = '';
                    $numero_orden = '';
                    $ducto = '';
                    $ubicacion_tecnica = '';
                    $estatus = 'ACTIVO';
                    $fecha_programada_inicio = '';
                    $fecha_programada_fin = '';
                    $fecha_inicio_trabajo = '0000-00-00';
                    $fecha_fin_trabajo = '0000-00-00';
                    $monto_estimado = '';
                    $observaciones = '';
                    $supervisor= '';
                    $action = "insert" ;
                  }
                ?>

              <div id="formulario_o" >
                <form method='post'>
                  <input type="hidden" name="id_orden_servicio" value="<?php echo $id ; ?>" >
                  <input type="hidden" name="id_sector" value="<?php echo $id_sector ; ?>" >
                  <input type="hidden" name="fecha_inicio_trabajo" value="<?php echo $fecha_inicio_trabajo ; ?>" >
                  <input type="hidden" name="fecha_fin_trabajo" value="<?php echo $fecha_fin_trabajo ; ?>" >
                  <input type="hidden" name="action" value="<?php echo $action ; ?>" >
                  <input type="hidden" name="estatus" value="<?php echo $estatus; ?>">
                  <table>
                    <tr>
                      <td>Sector:</td>
                      <td>
                        <?php
                          $sectores = $sector->getAll();
                        ?>
                        <select name="id_sector" >
                          <?php
                            foreach ($sectores as $value) {
                              ?>
                              <option value=<?php echo "'".$value['id_sector']."'"; ?> <?php echo ($id==$value['id_sector']) ? "selected='selected'" : '' ?> ><?php echo $value['nombre']; ?></option>
                              <?php
                            }
                          ?>
                        </select>

                      </td>
                    </tr>
                    <tr>
                      <td>Número de orden:</td>
                      <td><input type="text" name="numero_orden" value="<?php echo $numero_orden ; ?>" required ></td>
                    </tr>
                    <tr>
                      <td>Ducto:</td>
                      <td><input type="text" name="ducto" value="<?php echo $ducto ; ?>"  required ></td>
                      </tr>
                    <tr>
                      <td>Ubicación técnica:</td>
                      <td><input type="text" name="ubicacion_tecnica" required  value="<?php echo $ubicacion_tecnica ; ?>" ></td>
                    </tr>
                    <tr>
                      <td>Fecha programada inicio:</td>
                      <td><input type="text" name="fecha_programada_inicio" id="fecha_programada_inicio" required value="<?php echo $fecha_programada_inicio ; ?>"  ></td>
                    </tr>
                    <tr>
                      <td>Fecha programada término:</td>
                      <td><input type="text" name="fecha_programada_fin" id="fecha_programada_fin" required  value="<?php echo $fecha_programada_fin ; ?>" ></td>
                    </tr>
                    <tr>
                      <td>Monto estimado:</td>
                      <td><input type="text" name="monto_estimado" required value="<?php echo $monto_estimado ; ?>"  ></td>
                    </tr>
                    <tr>
                      <td>Observaciones:</td>
                      <td><textarea name="observaciones"><?php echo $observaciones; ?></textarea></td>
                    </tr>


                    <tr>
                      <td>Supervisor:</td>
                      <td>
                        <?php
                          $supervisores = $usuario->getByPerfil("SUPERVISOR");
                       //   print_r($supervisores);
                        ?>
                        <select name="supervisor" >
                          <?php
                            foreach ($supervisores as $value) {
                              ?>
                              <option value=<?php echo "'".$value['id_usuario']."'"; ?> <?php echo ($supervisor==$value['id_usuario']) ? "selected='selected'" : '' ?> ><?php echo $value['nombre']; ?></option>
                              <?php
                            }
                          ?>
                        </select>

                      </td>
                    </tr>


                    <tr>
                      <td colspan="2" ><input type="submit" value="Guardar" > </td>
                    </tr>
                  </table>

                </form>


              </div>

              <?php
                if(!empty($_POST)){
                  if($_POST['action'] == "insert"){
                //  $sector->loadById($_POST['id_sector']);
              


                  $orden = $_POST['numero_orden'] ;
                 // print_r($orden_servicio->getByName($orden));
                  $orden = str_replace(' ', '', $orden) ;
                  $orden = str_replace('-', '', $orden) ;
                  $orden = str_replace('/', '', $orden) ;
                  $orden = str_replace('.', '', $orden) ;
                  $orden = str_replace('_', '', $orden) ;
                  $orden = strtoupper($orden) ;
                  //echo $orden;
                  //echo "<br><br>" ;



                  if( ! $orden_servicio->getByName($orden)){
                    $orden_servicio->insert($_POST);
                  }
                  else{
                    ?>
                    <script type="text/javascript">
                      alert("El número de orden ya ha sido capturado.");
                    </script>
                    <?php
                  }
                }else{
                //  echo $orden_servicio->update($_POST);
                    if ($orden_servicio->update($_POST)){
                      ?>
                    <script type="text/javascript">
                      alert("Registro modificado con éxito.");
                      window.location="ordenes.php"
                    </script>
                    <?php   
                    }
                    else{
                      ?>
                    <script type="text/javascript">
                      alert("Error al modificar registro.");
                    </script>
                    <?php
                    }

              }

                  

                }
              ?>
              <div id="encabezado_o">
              <table border="1">
              <tr>
                    <th class="e_sector">Sector</th>
                    <th class="e_numero">Número de orden</th>
                    <th class="e_ducto">Ducto</th>
                    <th class="e_ubicacion">Ubicación Técnica</th>
                    <th class="e_fecha_inicio">Fecha programada de inicio</th>
                    <th class="e_fecha_fin">Fecha programada de fin</th>
                    <th class="e_a">Acciones</th>

                  </tr>
                  </table>
              </div>
              <div id="tabla_captura_o" >
                <?php
                  $ordenes = $orden_servicio->getAll();
                ?>
                <table>

                </table>
                <table border="1">
                  
                  <?php

                    foreach ($ordenes as $value) {
                      ?>
                      <tr>
                        <td class="e_sector">
                          <?php
                            $sector->loadById($value['id_sector']);
                            echo $sector->getNombre();
                          ?>
                        </td>
                        <td class="e_numero"><?php echo $value['numero_orden'] ?></td>
                        <td class="e_ducto"><?php echo$value['ducto'] ?></td>
                        <td class="e_ubicacion"><?php echo$value['ubicacion_tecnica'] ?></td>
                        <td class="e_fecha_inicio"><?php echo$value['fecha_programada_inicio'] ?></td>
                        <td class="e_fecha_fin"><?php echo$value['fecha_programada_fin'] ?></td>
                        <td class="e_a"><a href="ordenes.php?id_orden_servicio=<?php echo $value['id_orden_servicio']; ?>"><img src="../img/edit.png" width="20" height="20" title="Modificar"></a></td>
                      </tr>
                      <?php
                    }

                  ?>
                </table>
              </div>

              </div>

            </div>

            <!-- FIN DE LA PARTE EDITABLE -->
        </div>
        <div id="content_bottom"></div>
            
        <div id="footer"> <!-- inicio footer -->
            <center>
            <?php
                echo $componente->getFooter(); 
            ?>
            </center>

        </div> <!-- fin footer -->

        </div> 
   </div>
</body>
</html>
<?php
  }else{
    switch ($_SESSION['perfil']) {
      case 'SUPERVISOR':
        ?>
          <script type="text/javascript">
            alert("Acceso denegado");
            window.location="../revisiones";
          </script>
        <?php
        break;
      case 'RESIDENTE':
        ?>
          <script type="text/javascript">
            alert("Acceso denegado");
            window.location="../revisiones";
          </script>
        <?php
        break;
        case 'ESTIMACIONES':
        ?>
          <script type="text/javascript">
            alert("Acceso denegado");
            window.location="../capturas";
          </script>
        <?php
        break;
        case 'COORDINADOR':
        ?>
          <script type="text/javascript">
            alert("Acceso denegado");
            window.location="../capturas";
          </script>
        <?php
        break;
    }
  }  
}
else
{
  ?>
  <?php
  header("location: ../index.php");
}
?>