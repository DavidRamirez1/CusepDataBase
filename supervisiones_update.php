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
  <title>CUSEP - Supervisiones y Casos Update</title>
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
          <li><a href="pacientes.html">Pacientes</a></li>
          <li><a href="profesores.html">Profesores</a></li>
          <li class="selected"><a href="supervisiones.html">Supervisiones y Casos</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
 		  <h1>Manejo de Datos - Supervisiones y Casos </h1>
        <ul>
          <li><a href="supervisiones_view.php">Ver Supervisiones y Casos</a></li>
          <li><a href="supervisiones_update.php">Actualizar informacion de Superviciones y Casos</a></li>
          <li><a href="supervisiones_insert.php">Insertar Nuevas Superviciones y Casos</a></li>
          <li><a href="supervisiones_delete.php">Borrar Superviciones y Casos</a></li>
        </ul>
        
          <?php
         if(isset($_POST['updatesuperv'])) {
              
            $numest = mysqli_real_escape_string($dbconnection, $_POST['numero_estudiante']);
            $nombprof = mysqli_real_escape_string($dbconnection, $_POST['nombre_profesor']);
            $appprof = mysqli_real_escape_string($dbconnection, $_POST['apellido_profesor']);
            $mes = mysqli_real_escape_string($dbconnection, $_POST['mes']);
            $anio = mysqli_real_escape_string($dbconnection, $_POST['anio']);
            $practica = mysqli_real_escape_string($dbconnection, $_POST['practica']);
            $mesn = mysqli_real_escape_string($dbconnection, $_POST['mesnuevo']);
            $anion = mysqli_real_escape_string($dbconnection, $_POST['anionuevo']);
            $practican = mysqli_real_escape_string($dbconnection, $_POST['practicanuevo']);
            
            $sqlAssig = sprintf("select P.profesor_id from Profesor P where P.nombre_profesor = '$nombprof' and P.apellido_profesor = '$appprof'");
  
            $resAssig = mysqli_query($dbconnection, $sqlAssig);

            while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 			  echo $rowAssig['profesor_id'] ;
              $profid = $rowAssig['profesor_id'] ;
            }
            echo $profid ;
            $sqlAssig = sprintf("select S.supervisado_id from Profesor P, Supervisado S, Estudiante E where S.profesor_id = '$profid' and S.mes = '$mes' and S.anio = '$anio' and S.practica = '$practica' and S.numero_estudiante = '$numest'");

            $resAssig = mysqli_query($dbconnection, $sqlAssig);

            while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 			  echo $rowAssig['supervisado_id'] ;
              $supervid = $rowAssig['supervisado_id'] ;
            }

            echo $supervid ;

            $sql = "update Supervisado set mes = '$mesn', anio = '$anion', practica = '$practican' where supervisado_id = $supervid" ;

           if(mysqli_query($dbconnection, $sql)){
            echo "Nueva informacion a~adida exitosamente" ;
           }
           else{
            echo "Error: ".$sql."<br>".mysqli_error($dbconnection);
           }
            
          mysqli_close($dbconnection);
         } 

         else if(isset($_POST['updatecaso'])){

            $numexp = mysqli_real_escape_string($dbconnection, $_POST['numero_expediente']);
            $tipointv = mysqli_real_escape_string($dbconnection, $_POST['tipo_intervencion']);
            $horases = mysqli_real_escape_string($dbconnection, $_POST['horas_de_sesion']);
            $numest = mysqli_real_escape_string($dbconnection, $_POST['numero_estudiante']);
            $nombprof = mysqli_real_escape_string($dbconnection, $_POST['nombre_profesor']);
            $appprof = mysqli_real_escape_string($dbconnection, $_POST['apellido_profesor']);
            $mes = mysqli_real_escape_string($dbconnection, $_POST['mes']);
            $anio = mysqli_real_escape_string($dbconnection, $_POST['anio']);
            $practica = mysqli_real_escape_string($dbconnection, $_POST['practica']);
            
            $sqlAssig = sprintf("select P.profesor_id from Profesor P where P.nombre_profesor = '$nombprof' and P.apellido_profesor = '$appprof'");
  
            $resAssig = mysqli_query($dbconnection, $sqlAssig);

            while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
              $profid = $rowAssig['profesor_id'] ;
            }

            $sqlAssig = sprintf("select S.supervisado_id from Profesor P, Supervisado S where S.profesor_id = '$profid' and S.mes = '$mes' and S.anio = '$anio' and S.practica = '$practica' and S.numero_estudiante = '$numest'");

            $resAssig = mysqli_query($dbconnection, $sqlAssig);

            while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
              $supervid= $rowAssig['supervisado_id'] ;
            }

            $sql = "update Atendido_Estudiante set tipo_intervencion = '$tipointv', horas_de_sesion = '$horases' where supervisado_id = '$supervid' and numero_expediente = '$numexp'" ;

           if(mysqli_query($dbconnection, $sql)){
            echo "Nueva informacion a~adida exitosamente" ;
           }
           else{
            echo "Error: ".$sql."<br>".mysqli_error($dbconnection);
           }
            
          mysqli_close($dbconnection);
         }

         else {
            ?>

        <h1>Actualizar Supervision</h1>
        <h5>Informacion Original</h5>
        <form action="supervisiones_update.php" method="post">
          Numero Estudiante: <input type="text" name="numero_estudiante"/><br></br>
          Nombre de Profesor: <input type="text" name="nombre_profesor"/><br></br>
          Apellido de Profesor: <input type="text" name="apellido_profesor"/><br></br>
          Mes: <input type="text" name="mes"/><br></br>
          Year: <input type="text" name="anio"/><br></br>
          Practica: <input type="text" name="practica"/><br></br>

        <h5>Informacion Actualizada</h5>
          Mes: <input type="text" name="mesnuevo"/><br></br>
          Year: <input type="text" name="anionuevo"/><br></br>
          Practica: <input type="text" name="practicanuevo"/><br></br>
        <input name= "updatesuperv" type="submit" id = "updatesuperv" value = "Actualizar"/>
        </form>


        <h1>Actualizar Caso de Estudiante</h1>
        <h5>Informacion Original</h5>
        <form action="supervisiones_update.php" method="post">
          Numero Expediente: <input type="text" name="numero_expediente"/><br></br>
          Numero de Estudiante: <input type="text" name="numero_estudiante"/><br></br>
          Nombre de Profesor: <input type="text" name="nombre_profesor"/><br></br>
          Apellido de Profesor: <input type="text" name="apellido_profesor"/><br></br>
          Mes: <input type="text" name="mes"/><br></br>
          Year: <input type="text" name="anio"/><br></br>
          Practica: <input type="text" name="practica"/><br></br>

        <h5>Informacion Actualizada</h5>
          Tipo de Intervencion: <input type="text" name="tipo_intervencion"/><br></br>
          Horas de Sesion: <input type="text" name="horas_de_sesion"/><br></br>
          <input name= "updatecaso" type="submit" id = "updatecaso" value = "Actualizar"/>
        </form>

        <?php
         }
      ?>

      </div>
    </div>
  </div>
</body>
</html>