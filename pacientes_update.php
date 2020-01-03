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
  <title>CUSEP - Pacientes Update</title>
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

        if(isset($_POST['update'])) {
              
         if(!empty($_POST['numero_expediente']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['edad']) && !empty($_POST['genero']) && !empty($_POST['estatus']) && !empty($_POST['horas_sesiones']) && !empty($_POST['diagnostico']) && !empty($_POST['fecha_solicitud']) && !empty($_POST['fecha_asignacion']) && !empty($_POST['fecha_asignacion']) && !empty($_POST['victima_crimen']) && !empty($_POST['programa']) && !empty($_POST['disability'])){

            $numexp = mysqli_real_escape_string($dbconnection, $_POST['numero_expediente']);
            $nomb = mysqli_real_escape_string($dbconnection, $_POST['nombre']);
            $app = mysqli_real_escape_string($dbconnection, $_POST['apellido']);
            $edad = mysqli_real_escape_string($dbconnection, $_POST['edad']);
            $genero = mysqli_real_escape_string($dbconnection, $_POST['genero']);
            $estatus = mysqli_real_escape_string($dbconnection, $_POST['estatus']);
            $horas_sesiones = mysqli_real_escape_string($dbconnection, $_POST['horas_sesiones']);
            $diag = mysqli_real_escape_string($dbconnection, $_POST['diagnostico']);
            $fechasol = mysqli_real_escape_string($dbconnection, $_POST['fecha_solicitud']);
            $fechasig = mysqli_real_escape_string($dbconnection, $_POST['fecha_asignacion']);
            $viccrimen = mysqli_real_escape_string($dbconnection, $_POST['victima_crimen']);
            $prog = mysqli_real_escape_string($dbconnection, $_POST['programa']);
            $disab = mysqli_real_escape_string($dbconnection, $_POST['disability']);

            $sql = "update Paciente set nombre = '$nomb', apellido = '$app', edad = $edad, genero = '$genero', estatus = '$estatus', horas_sesiones = $horas_sesiones, diagnostico = '$diag', fecha_solicitud = '$fechasol', fecha_asignacion = '$fechasig', victima_crimen = '$viccrimen', programa = '$prog', disability = '$disab' where numero_expediente = $numexp" ;

           if(mysqli_query($dbconnection, $sql)){
            echo "Nueva informacion actualizada exitosamente" ;
           }
           else{
            echo "Error: ".$sql."<br>".mysqli_error($dbconnection);
           }
          }

         else{
            echo "Asegurese que se entre toda la informacion!" ;
         }
          mysqli_close($dbconnection);
         } 

        ?>


        <?php
         if(isset($_POST['update1'])) {

          $numexp = mysqli_real_escape_string($dbconnection, $_POST['numero_expediente']);

          $sqlAssig = sprintf("select * from Paciente P where P.numero_expediente = '$numexp'");

          $resAssig = mysqli_query($dbconnection, $sqlAssig);

          $rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC) ;
          echo $rowAssig['numero_expediente'] ;
          
          print "<h1>Informacion Actualizada de Paciente</h1>";
          print "<form action=pacientes_update.php method=post>";
          
          print "Numero Expediente: <input type=text name=numero_expediente value=".$numexp." ><br></br>" ;
          print "Nombre de Paciente: <input type=text name=nombre value=";
          echo $rowAssig['nombre'] ; print " /><br></br>" ;
          print "Apellido de Paciente: <input type=text name=apellido value=" ; 
          echo $rowAssig['apellido'];
          print " ><br></br>" ;
          print "Edad: <input type=text name=edad value=" ;
          echo $rowAssig['edad']; 
          print " ><br></br>" ;
          print "Genero: <input type=text name=genero value=" ;
          echo $rowAssig['genero'] ; 
          print " ><br></br>";
          print "Estatus: <input type=text name=estatus value=" ;
          echo $rowAssig['estatus'] ;
          print " ><br></br>";
          print "Horas de Sesiones Totales: <input type=text name=horas_sesiones value=" ;
          echo $rowAssig['horas_sesiones'];
          print " ><br></br>";
          print "Diagnostico: <input type=text name=diagnostico value=" ;
          echo $rowAssig['diagnostico'] ;
          print " ><br></br>" ;
          print "Fecha de Solicitud: <input type=text name=fecha_solicitud value=";
          echo $rowAssig['fecha_solicitud'];
          print " ><br></br>";
          print "Fecha de Asignacion: <input type=text name=fecha_asignacion value=";
          echo $rowAssig['fecha_asignacion'];
          print " ><br></br>";
          print "Victima de Crimen: <input type=text name=victima_crimen value=";
          echo $rowAssig['victima_crimen'];
          print " ><br></br>";
          print "Programa: <input type=text name=programa value=" ;
          echo $rowAssig['programa'];
          print " ><br></br>";
          print "Discapacidad: <input type=text name=disability value=";
          echo $rowAssig['disability'];
          print " ><br></br>";
          print "<input name=update type=submit id = update value = Update />";
          print "</form>";
            
          mysqli_close($dbconnection);
         } 
         else {
            ?>

        <h1>Informacion Actualizada de Paciente</h1>
        <form action="pacientes_update.php" method="post">
          <h5>Paciente que quiere actualizar</h5>
          Numero Expediente: <input type="text" name="numero_expediente"/><br></br>
          <input name= "update1" type="submit" id = "update1" value = "Update"/>
        </form>
        <?php
         } ;
      ?>

      </div>
    </div>
  </div>
</body>
</html>