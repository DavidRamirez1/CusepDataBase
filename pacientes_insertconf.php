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
  <title>CUSEP - Pacientes Insert Conf</title>
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
          <li><a href="estudiantes.html">Estudiantes</a></li>
          <li class="selected"><a href="pacientes.html">Pacientes</a></li>
          <li><a href="profesores.html">Profesores</a></li>
          <li><a href="supervisiones.html">Supervisiones y Casos</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->

        <h1>Manejo de Datos - Pacientes</h1>
        <ul>
          <li><a href="pacientes_view.php">Ver Pacientes</a></li>
          <li><a href="pacientes_update.php">Actualizar informacion de Paciente</a></li>
          <li><a href="pacientes_insert.php">Insertar Paciente nuevo</a></li>
          <li><a href="pacientes_delete.php">Borrar Paciente</a></li>
        </ul>

        <?php 

          if(!empty($_POST['numero_expediente']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['edad']) && !empty($_POST['genero']) && !empty($_POST['estatus']) && !empty($_POST['horas_sesiones']) && !empty($_POST['diagnostico']) && !empty($_POST['fecha_solicitud']) && !empty($_POST['fecha_asignacion']) && !empty($_POST['fecha_asignacion']) && !empty($_POST['victima_crimen']) && !empty($_POST['programa']) && !empty($_POST['disability'])){

          $numexp = mysqli_real_escape_string($dbconnection, $_POST['numero_expediente']);
          $nomb = mysqli_real_escape_string($dbconnection, $_POST['nombre']);
          $app = mysqli_real_escape_string($dbconnection, $_POST['apellido']);
          $edad = mysqli_real_escape_string($dbconnection, $_POST['edad']);
          $gen = mysqli_real_escape_string($dbconnection, $_POST['genero']);
          $estatus = mysqli_real_escape_string($dbconnection, $_POST['estatus']);
          $horas = mysqli_real_escape_string($dbconnection, $_POST['horas_sesiones']);
          $diag = mysqli_real_escape_string($dbconnection, $_POST['diagnostico']);
          $fechasol = mysqli_real_escape_string($dbconnection, $_POST['fecha_solicitud']);
          $fechasig = mysqli_real_escape_string($dbconnection, $_POST['fecha_asignacion']);
          $victcrim = mysqli_real_escape_string($dbconnection, $_POST['victima_crimen']);
          $programa = mysqli_real_escape_string($dbconnection, $_POST['programa']);
          $disab = mysqli_real_escape_string($dbconnection, $_POST['disability']);

          $sql = "insert into Paciente(numero_expediente, nombre, apellido, edad, genero, estatus, horas_sesiones, diagnostico, fecha_solicitud, fecha_asignacion, victima_crimen, programa, disability) values ('$numexp', '$nomb', '$app', '$edad', '$gen', '$estatus', '$horas', '$diag', '$fechasol', '$fechasig', '$victcrim', '$programa', '$disab')" ;

          if(mysqli_query($dbconnection, $sql)){
            echo "Nueva informacion a~adida exitosamente" ;
          }
          else{
            echo "Error: ".$sql."<br>".mysqli_error($dbconnection);
          }
        }
          else{

          echo "Entrada tiene que tener un Numero de Expediente" ;
        }

          mysqli_close($dbconnection);
        ?>

        <h1>Exito</h1>

      </div>
    </div>
  </div>
</body>
</html>