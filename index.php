<?php
    session_start();

  if(!empty($_SESSION)){

    if($_SESSION['perfil'] == "ADMINISTRADOR" || $_SESSION['perfil'] == "SUPERINTENDENTE DE OBRA" || $_SESSION['perfil'] == "ESTIMACIONES" ){


    /* INCLUSION DE LIBRERIAS */

     include_once("../library/Componente.php");

     $componente = new Componente();
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