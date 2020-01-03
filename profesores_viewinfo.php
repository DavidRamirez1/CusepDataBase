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
  <title>CUSEP - Profesores View Info</title>
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
          <h2>Centro de Servicios Psicologicos - Base de Datos</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li><a href="index.html">Home</a></li>
          <li><a href="estudiantes.html">Estudiantes</a></li>
          <li><a href="pacientes.html">Pacientes</a></li>
          <li class="selected"><a href="profesores.html">Profesores</a></li>
          <li><a href="supervisiones.html">Supervisiones</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->

        <h1>Manejo de Datos - Profesor</h1>
        <ul>
          <li><a href="profesores_view.php">Ver Profesores</a></li>
          <li><a href="profesores_update.php">Actualizar informacion de Profesor</a></li>
          <li><a href="profesores_insert.php">Insertar Profesor nuevo</a></li>
          <li><a href="profesores_delete.php">Borrar Profesor</a></li>
        </ul>

        <h1>Informacion de Profesor</h1>
        <table>
          <tr>
            <th>Profesor ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Creditos</th>
          </tr>
        <?php 

        if(isset($_GET['profesor_id'])){

        $pid = mysqli_real_escape_string($dbconnection, $_GET['profesor_id']);

        $sqlAssig = sprintf("select * from Profesor P where P.profesor_id = %s", $pid);
  
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
          print "<tr>" ;
          print "<td>".$rowAssig['profesor_id']."</td>" ;
          print "<td>".$rowAssig['nombre_profesor']."</td>" ;
          print "<td>".$rowAssig['apellido_profesor']."</td>";
          print "<td>".$rowAssig['creditos']."</td>";
          print "</tr>";
        }

        print "</table>" ;
      }

        else if(isset($_POST['nombre_profesor']) and isset($_POST['apellido_profesor'])){

          if(empty($_POST['nombre_profesor']) or empty($_POST['apellido_profesor'])){
          header("Location: profesores_view.php");
        }

          $nameprof = mysqli_real_escape_string($dbconnection, $_POST['nombre_profesor']) ;
          $apellidoprof = mysqli_real_escape_string($dbconnection, $_POST['apellido_profesor']) ;

          $sqlAssig2 = sprintf("select * from Profesor P where P.nombre_profesor = '$nameprof' and P.apellido_profesor = '$apellidoprof'");

          $resAssig = mysqli_query($dbconnection, $sqlAssig2);

          while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
            print "<tr>" ;
            print "<td>".$rowAssig['profesor_id']."</td>" ;
            print "<td>".$rowAssig['nombre_profesor']."</td>" ;
            print "<td>".$rowAssig['apellido_profesor']."</td>";
            print "<td>".$rowAssig['creditos']."</td>";
            print "</tr>";
          }
          print "</table>" ;
        }
        ?>

        <h1>Estudiantes Supervisado por Profesor</h1>
        <table>
          <tr>
            <th>Numero Estudiante</th>
            <th>Nombre Estudiante</th>
            <th>Apellido Estudiantee</th>
            <th>Mes</th>
            <th>Year</th>
            <th>Practica</th>
          </tr>

        <?php

        if(isset($_GET['profesor_id'])){

        $sqlAssig = sprintf("select S.numero_estudiante, E.nombre_estudiante, E.apellido_estudiante, S.mes, S.anio, S.practica from Supervisado S, Estudiante E where S.profesor_id = %s and S.numero_estudiante = E.numero_estudiante", $pid);  
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){

          print "<tr>" ;

          print "<td><a href=estudiantes_viewinfo.php?numero_estudiante=" ;
          print $rowAssig['numero_estudiante'].">";
          print $rowAssig['numero_estudiante']."</a></td>" ;
          print "<td>".$rowAssig['nombre_estudiante']."</td>" ;
          print "<td>".$rowAssig['apellido_estudiante']."</td>";
          print "<td>".$rowAssig['mes']."</td>";
          print "<td>".$rowAssig['anio']."</td>";
          print "<td>".$rowAssig['practica']."</td>";

          print "</tr>";
        }

        print "</table>";
      }

        else if(isset($_POST['nombre_profesor']) and isset($_POST['apellido_profesor'])){

       //   $nameprof = mysqli_real_escape_string($dbconnection, $_POST['nombre_profesor']) ;
       //   $apellidoprof = mysqli_real_escape_string($dbconnection, $_POST['apellido_profesor']) ;

          $sqlAssig2 = sprintf("select P.profesor_id from Profesor P where P.nombre_profesor = '$nameprof' and P.apellido_profesor = '$apellidoprof'");

          $resAssig = mysqli_query($dbconnection, $sqlAssig2);

          while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
            $profid = $rowAssig['profesor_id'] ;
          }

        $sqlAssig = sprintf("select S.numero_estudiante, E.nombre_estudiante, E.apellido_estudiante, S.mes, S.anio, S.practica from Supervisado S, Estudiante E where S.profesor_id = %s and S.numero_estudiante = E.numero_estudiante", $profid);

        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){

          print "<tr>" ;

          print "<td><a href=estudiantes_viewinfo.php?numero_estudiante=" ;
          print $rowAssig['numero_estudiante'].">";
          print $rowAssig['numero_estudiante']."</a></td>" ;
          print "<td>".$rowAssig['nombre_estudiante']."</td>" ;
          print "<td>".$rowAssig['apellido_estudiante']."</td>";
          print "<td>".$rowAssig['mes']."</td>";
          print "<td>".$rowAssig['anio']."</td>";
          print "<td>".$rowAssig['practica']."</td>";

          print "</tr>";
          }

          print "</table>" ;
        }

        ?>

        <h1>Pacientes Atendidos por Estudiantes Supervisados</h1>
        <table>
          <tr>
            <th>Numero Expediente</th>
            <th>Nombre Paciente</th>
            <th>Apellido Paciente</th>
            <th>Tipo de Intervencion</th>
            <th>Horas de Sesiones</th>
            <th>Mes</th>
            <th>Year</th>
            <th>Nombre Estudiante</th>
            <th>Apellido Estudiante</th>
            <th>Practica</th>
          </tr>

        <?php

        if(isset($_GET['profesor_id'])){

        $sqlAssig = sprintf("select A.numero_expediente, A.tipo_intervencion, A.horas_de_sesion, S.practica, S.mes, S.anio, PA.nombre, PA.apellido, E.nombre_estudiante, E.apellido_estudiante from Atendido_Estudiante A, Paciente PA, Supervisado S, Estudiante E where A.supervisado_id = S.supervisado_id and S.profesor_id = %s and A.numero_expediente = PA.numero_expediente and E.numero_estudiante = S.numero_estudiante", $pid); 

        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
          
          print "<tr>" ;
          print "<td><a href=pacientes_viewinfo.php?numero_expediente=";
          print $rowAssig['numero_expediente'].">" ;
          print $rowAssig['numero_expediente']."</a></td>" ;
          print "<td>".$rowAssig['nombre']."</td>" ;
          print "<td>".$rowAssig['apellido']."</td>";
          print "<td>".$rowAssig['tipo_intervencion']."</td>";
          print "<td>".$rowAssig['horas_de_sesion']."</td>" ;
          print "<td>".$rowAssig['mes']."</td>" ;
          print "<td>".$rowAssig['anio']."</td>" ;       
          print "<td>".$rowAssig['nombre_estudiante']."</td>" ;
          print "<td>".$rowAssig['apellido_estudiante']."</td>" ;
          print "<td>".$rowAssig['practica']."</td>";   

          print "</tr>";
        }

        print "</table>";
      }

       else if(isset($_POST['nombre_profesor']) and isset($_POST['apellido_profesor'])){

       //   $nameprof = mysqli_real_escape_string($dbconnection, $_POST['nombre_profesor']) ;
       //   $apellidoprof = mysqli_real_escape_string($dbconnection, $_POST['apellido_profesor']) ;

          $sqlAssig2 = sprintf("select P.profesor_id from Profesor P where P.nombre_profesor = '$nameprof' and P.apellido_profesor = '$apellidoprof'");

          $resAssig = mysqli_query($dbconnection, $sqlAssig2);

          while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
            $profid = $rowAssig['profesor_id'] ;
          }

        $sqlAssig = sprintf("select A.numero_expediente, A.tipo_intervencion, A.horas_de_sesion, S.practica, S.mes, S.anio, PA.nombre, PA.apellido, E.nombre_estudiante, E.apellido_estudiante from Atendido_Estudiante A, Paciente PA, Supervisado S, Estudiante E where A.supervisado_id = S.supervisado_id and S.profesor_id = %s and A.numero_expediente = PA.numero_expediente and E.numero_estudiante = S.numero_estudiante", $profid); 

        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){

          print "<tr>" ;
          print "<td><a href=pacientes_viewinfo.php?numero_expediente=";
          print $rowAssig['numero_expediente'].">" ;
          print $rowAssig['numero_expediente']."</a></td>" ;
          print "<td>".$rowAssig['nombre']."</td>" ;
          print "<td>".$rowAssig['apellido']."</td>";
          print "<td>".$rowAssig['tipo_intervencion']."</td>";
          print "<td>".$rowAssig['horas_de_sesion']."</td>" ;
          print "<td>".$rowAssig['mes']."</td>" ;
          print "<td>".$rowAssig['anio']."</td>" ;       
          print "<td>".$rowAssig['nombre_estudiante']."</td>" ;
          print "<td>".$rowAssig['apellido_estudiante']."</td>" ;
          print "<td>".$rowAssig['practica']."</td>";   

          print "</tr>" ;

          }

          print "</table>" ;
        }

        mysqli_close($dbconnection);
        ?>
      </div>
    </div>
  </div>
</body>
</html>