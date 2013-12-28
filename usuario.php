<?php
        session_start();

  if(!empty($_SESSION)){

    if($_SESSION['perfil'] == "ADMINISTRADOR" || $_SESSION['perfil'] == "SUPERINTENDENTE DE OBRA" ){

    /* INCLUSION DE LIBRERIAS */

     include_once("../library/Componente.php");
     include_once("../library/Usuario.php");

     $componente = new Componente();
     $usuario = new Usuario();
?>

<!DOCTYPE html>
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

              <div id="formulario_o" >
                <form method='post'>

                  <table>
                    
                    <tr>
                      <td>Nombre:</td>
                      <td><input type="text" name="nombre" required ></td>
                    </tr>
                    <tr>
                      <td>Clave de usuario:</td>
                      <td><input type="text" name="usuario" required ></td>
                      </tr>
                    <tr>
                      <td>Password:</td>
                      <td><input type="password" name="password" required ></td>
                    </tr>
                    <tr>
                      <td>Confirmar password:</td>
                      <td><input type="password" name="confirma_pass" required ></td>
                    </tr>
                    <tr>
                      <td>Compañía:</td>
                      <td>
                        <select name="compania" >
                          <option value="SMT" >SMT</option>
                          <option value="PEMEX" >PEMEX</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>Perfil:</td>
                      <td>
                         <select name="perfil" >
                          <option value="ESTIMACIONES" >ESTIMACIONES</option>
                          <option value="SUPERVISOR" >SUPERVISOR</option>
                          <option value="COORDINADOR" >COORDINADOR</option>
                          <option value="RESIDENTE" >RESIDENTE</option>
                          <option value="SUPERINTENDENTE DE OBRA" >SUPERINTENDENTE DE OBRA</option>
                          <option value="ADMINISTRADOR" >ADMINISTRADOR</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" ><input type="submit" value="Guardar" > </td>
                    </tr>
                  </table>

                </form>

                <?php
                  if(!empty($_POST)){
                    if($_POST['password'] == $_POST['confirma_pass']){
                      $_POST['psd']=$_POST['password'] ;
                      $_POST['password'] = md5($_POST['password']) ;

                      $usuario->insert($_POST);
                      ?>
                      <script type="text/javascript">
                          alert("Usuario registrado con éxito");
                          window.location="usuario.php";
                        </script>
                      <?php
                    }
                    else{
                      ?>
                      <script type="text/javascript">
                          alert("Las contraseñas no coinciden");
                          
                        </script>
                      <?php
                    }
                  }
                ?>

              </div>

              <div id="encabezado_o" >
                <table border="1">
                  <tr>
                    <th class="u_usuario">Usuario</th>
                    <th class="u_nombre">Nombre</th>
                    <th class="u_compania">Compañía</th>
                    <th class="u_perfil">Perfil</th>
                    <th class="u_estatus">Estatus</th>
                  </tr>
                </table>
              </div>

              <div id="tabla_captura_o" >
                <table border="1">
                  <?php
                    $usuarios = $usuario->getAll();
                  ?>
                  
                  <?php
                    foreach ($usuarios as $value) {
                      ?>
                      <tr>
                        <td class="u_usuario">
                          <?php echo $value['usuario'] ; ?>
                        </td>
                        <td class="u_nombre">
                          <?php echo $value['nombre'] ; ?>
                        </td>
                        <td class="u_compania"><?php echo $value['compania'] ; ?></td>
                        <td class="u_perfil"><?php echo $value['perfil'] ; ?></td>
                        <td class="u_estatus"><?php echo $value['estatus'] ; ?></td>
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