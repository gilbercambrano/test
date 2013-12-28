<?php
    session_start();

  if(!empty($_SESSION)){

    if($_SESSION['perfil'] == "ADMINISTRADOR" || $_SESSION['perfil'] == "SUPERINTENDENTE DE OBRA" || $_SESSION['perfil'] == "ESTIMACIONES" ){

    /* INCLUSION DE LIBRERIAS */

     include_once("../library/Componente.php");
     include_once("../library/Sector.php");
     include_once("../library/Contrato.php");
     include_once("../library/Usuario.php");
     include_once("../library/SectorCoordinador.php");
     include_once("../library/NumeroEstimacion.php");

     $componente  = new Componente();
     $sector      = new Sector();
     $contrato    = new Contrato ();
     $usuario     = new Usuario();
     $sector_coordinador = new SectorCoordinador();
     $numero_estimacion = new NumeroEstimacion();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../img/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link rel="stylesheet" type="text/css" href="../css/style.css" />
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

              <div id="formulario" >
                <form method='get'>

                  <table>
                    
                    <tr>
                      <td>Número de estimación:</td>
                      <td><input type="text" name="numero_estimacion" required ></td>
                    </tr>
                    <tr>
                      <td colspan="2" ><input type="submit" value="Guardar" > </td>
                    </tr>
                  </table>

                </form>
				
				

                <?php
				
				//print_r($_SESSION);
                  if( !empty($_GET) ){
                   $numero_estimacion->insert($_GET, $_SESSION['nombre']);
                      ?>
                        <script type="text/javascript">
                          alert("Número de estimación registrado con éxito");
                          window.location="numero_estimacion.php";
                        </script>
                      <?php
                      }
                ?>


              </div>

              <div id="tabla_captura" >
                <?php

                  $numeros_estimaciones = $numero_estimacion->getAll();


                ?>
                <table border="1">
                  <tr>
                    <th>Número Estimación</th>
                    <th>Estatus</th>
                  </tr>
                  <?php
                  foreach ($numeros_estimaciones as $value) {
                    ?>
                    <tr>
                      <td><?php echo $value['numero_estimacion']; ?></td>
                      <td>
                          <?php  
                            echo $value['estatus'];
                          ?>
                      </td>
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