<?php
  
   $db_username = "admin_cusep";
   $db_password = "d@v1d";
   $db_hostname = "localhost";
   $db_database = "CUSEP";

   mysqli_report(MYSQLI_REPORT_STRICT);

   try{

   $dbconnection = mysqli_connect($db_hostname, $db_username, $db_password, $db_database) or $error=1;
  }

   catch(Exception $ex)
  {
  die("FAIL".$ex->getMessage());
  }
?>

<!DOCTYPE HTML>
<html>

<head>
  <title>Estudiante - Insert Conf</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.html">CUSEP<span class="logo_colour"></span></a></h1>
          <h2>Centro Universitario de Servicios y Estudios Psicologicos - Base de Datos</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.html">Home</a></li>
          <li class="selected"><a href="estudiantes.html">Estudiantes</a></li>
          <li><a href="pacientes.html">Pacientes</a></li>
          <li><a href="profesores.html">Profesores</a></li>
          <li><a href="supervisiones.html">Supervisiones y Casos</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->

        <h1>Manejo de Datos - Estudiantes</h1>
        <ul>
          <li><a href="estudiantes_view.php">Ver Estudiantes</a></li>
          <li><a href="estudiantes_update.php">Actualizar informacion de Estudiante</a></li>
          <li><a href="estudiantes_insert.php">Insertar Estudiante nuevo</a></li>
          <li><a href="estudiantes_delete.php">Borrar Estudiante</a></li>
        </ul>

        <?php 

          if(!empty($_POST['numero_estudiante']) && !empty($_POST['nombre_estudiante']) && !empty($_POST['apellido_estudiante']) && !empty($_POST['numero_practica']) && !empty($_POST['disability']) && !empty($_POST['horas_facetoface']) && !empty($_POST['anio_ingreso']) && !empty($_POST['cantidad_pacientes']) && !empty($_POST['area'])){

          $numest = mysqli_real_escape_string($dbconnection, $_POST['numero_estudiante']);
          $nombest = mysqli_real_escape_string($dbconnection, $_POST['nombre_estudiante']);
          $appest = mysqli_real_escape_string($dbconnection, $_POST['apellido_estudiante']);
          $numpract = mysqli_real_escape_string($dbconnection, $_POST['numero_practica']);
          $disab = mysqli_real_escape_string($dbconnection, $_POST['disability']);
          $hftf = mysqli_real_escape_string($dbconnection, $_POST['horas_facetoface']);
          $aning = mysqli_real_escape_string($dbconnection, $_POST['anio_ingreso']);
          $cantpac = mysqli_real_escape_string($dbconnection, $_POST['cantidad_pacientes']);
          $area = mysqli_real_escape_string($dbconnection, $_POST['area']);


          $sql = "insert into Estudiante(numero_estudiante, nombre_estudiante, apellido_estudiante, numero_practica, disability, horas_facetoface, anio_ingreso, cantidad_pacientes, area) values ('$numest', '$nombest', '$appest', '$numpract', '$disab', '$hftf', '$aning', '$cantpac', '$area')" ;

          if(mysqli_query($dbconnection, $sql)){
            echo "Nueva informacion a~adida exitosamente" ;
            print "<h1>Exito</h1>";
          }
          else{
            echo "Error: ".$sql."<br>".mysqli_error($dbconnection);
          }
        }

        else{

          echo "Entrada tiene que tener un Numero de Estudiante" ;
        }

          mysqli_close($dbconnection);
        ?>

        

      </div>
    </div>
  </div>
</body>
</html>