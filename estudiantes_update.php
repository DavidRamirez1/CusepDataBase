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
  <title>Estudiante</title>
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

        if(isset($_POST['update'])) {
              
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

            $sql = "update Estudiante set nombre_estudiante = '$nombest', apellido_estudiante = '$appest', numero_practica = '$numpract', disability = '$disab', horas_facetoface = '$hftf', anio_ingreso = '$aning', cantidad_pacientes = '$cantpac', area = '$area' where numero_estudiante = $numest" ;

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

          $numest = mysqli_real_escape_string($dbconnection, $_POST['numero_estudiante']);

          $sqlAssig = sprintf("select * from Estudiante E where E.numero_estudiante = '$numest'");

          $resAssig = mysqli_query($dbconnection, $sqlAssig);

          $rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC) ;
          echo $rowAssig['numero_estudiante'] ;
          echo 'hi';
          print "<h1>Informacion Actualizada de Estudiante</h1>";
          print "<form action=estudiantes_update.php method=post>";
          
          print "Numero Estudiante: <input type=text name=numero_estudiante value=".$numest." ><br></br>" ;
          print "Nombre Estudiante: <input type=text name=nombre_estudiante value=";
          echo $rowAssig['nombre_estudiante'] ; print " /><br></br>" ;
          print "Apellido Estudiante: <input type=text name=apellido_estudiante value=" ; 
          echo $rowAssig['apellido_estudiante'];
          print " ><br></br>" ;
          print "Numero de Practica: <input type=text name=numero_practica value=" ;
          echo $rowAssig['numero_practica']; 
          print " ><br></br>" ;
          print "Discapacidad: <input type=text name=disability value=" ;
          echo $rowAssig['disability'] ; 
          print " ><br></br>";
          print "Horas Face-To-Face: <input type=text name=horas_facetoface value=" ;
          echo $rowAssig['horas_facetoface'] ;
          print " ><br></br>";
          print "A~o de Ingreso: <input type=text name=anio_ingreso value=" ;
          echo $rowAssig['anio_ingreso'];
          print " ><br></br>";
          print "Cantidad de Pacientes: <input type=text name=cantidad_pacientes value=" ;
          echo $rowAssig['cantidad_pacientes'] ;
          print " ><br></br>" ;
          print "Area: <input type=text name=area value=";
          echo $rowAssig['area'];
          print " ><br></br>";
          print "<input name=update type=submit id = update value = Update />";
          print "</form>";
            
          mysqli_close($dbconnection);
         } 
         else {
            ?>

        <h1>Actualizacion de Estudiante</h1>
        <form action="estudiantes_update.php" method="post">
          <h5>Estudiante que quiere actualizar</h5>
          Numero Estudiante: <input type="text" name="numero_estudiante"/><br></br>
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