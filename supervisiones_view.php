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
  <title>Supervisiones y Casos - View Info</title>
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

        <h1>Lista de Supervisiones</h1>
        <table>
          <tr>
            <th>Supervisado ID</th>
            <th>Nombre Estudiante</th>
            <th>Apellido Estudiante</th>
            <th>Numero de Estudiante</th>
            <th>Nombre Profesor</th>
            <th>Apellido Profesor</th>
            <th>Profesor ID</th>
            <th>Mes</th>
            <th>Year</th>
            <th>Practica</th>
            
          </tr>

        <?php 

        $sqlAssig = sprintf("select S.supervisado_id, E.nombre_estudiante, E.apellido_estudiante, E.numero_estudiante, P.nombre_profesor, P.apellido_profesor, P.profesor_id, S.mes, S.anio, S.practica from Supervisado S, Profesor P, Estudiante E where S.numero_estudiante = E.numero_estudiante and S.profesor_id = P.profesor_id"); 

        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
          print "<tr>" ;
          print "<td>".$rowAssig['supervisado_id']."</td>" ;
          print "<td>".$rowAssig['nombre_estudiante']."</td>";
          print "<td>".$rowAssig['apellido_estudiante']."</td>";
          print "<td><a href=estudiantes_viewinfo.php?numero_estudiante=" ;
          print $rowAssig['numero_estudiante'].">";
          print $rowAssig['numero_estudiante']."</a></td>" ;
          print "<td>".$rowAssig['nombre_profesor']."</td>" ;
          print "<td>".$rowAssig['apellido_profesor']."</td>" ;
          print "<td><a href=profesores_viewinfo.php?profesor_id=" ;
          print $rowAssig['profesor_id'].">" ;
          print $rowAssig['profesor_id']."</a></td>" ;
          print "<td>".$rowAssig['mes']."</td>" ;
          print "<td>".$rowAssig['anio']."</td>";
          print "<td>".$rowAssig['practica']."</td>" ;
          print "</tr>";
        }

        print "</table>" ;
        ?>

        <h1>Lista de Casos Supervisados</h1>
        <table>
          <tr>
            <th>Nombre de Paciente</th>
            <th>Apellido de Pacienter</th>
            <th>Numero Expediente</th>
            <th>Tipo de Intervencion</th>
            <th>Horas de Sesion</th>
            <th>Nombre Estudiante</th>
            <th>Apellido Estudiante</th>
            <th>Numero Estudiante</th>
            <th>Nombre Profesor</th>
            <th>Apellido Profesor</th>
            <th>Profesor ID</th>
            <th>Mes</th>
            <th>Year</th>
            <th>Practica</th>
          </tr>

        <?php

        $sqlAssig = sprintf("select PA.nombre, PA.apellido, PA.numero_expediente, A.tipo_intervencion, A.horas_de_sesion, E.nombre_estudiante, E.apellido_estudiante, E.numero_estudiante, P.nombre_profesor, P.apellido_profesor, P.profesor_id, S.mes, S.anio, S.practica from Paciente PA, Atendido_Estudiante A, Estudiante E, Profesor P, Supervisado S where A.supervisado_id = S.supervisado_id and S.numero_estudiante = E.numero_estudiante and S.profesor_id = P.profesor_id and PA.numero_expediente = A.numero_expediente");  
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){

          print "<tr>" ;
          print "<td>".$rowAssig['nombre']."</td>" ;
          print "<td>".$rowAssig['apellido']."</td>";
          print "<td><a href=pacientes_viewinfo.php?numero_expediente=";
          print $rowAssig['numero_expediente'].">" ;
          print $rowAssig['numero_expediente']."</a></td>" ;
          print "<td>".$rowAssig['tipo_intervencion']."</td>" ;
          print "<td>".$rowAssig['horas_de_sesion']."</td>" ;
          print "<td>".$rowAssig['nombre_estudiante']."</td>" ;
          print "<td>".$rowAssig['apellido_estudiante']."</td>" ;
          print "<td><a href=estudiantes_viewinfo.php?numero_estudiante=" ;
          print $rowAssig['numero_estudiante'].">";
          print $rowAssig['numero_estudiante']."</a></td>" ;
          print "<td>".$rowAssig['nombre_profesor']."</td>" ;
          print "<td>".$rowAssig['apellido_profesor']."</td>" ;
          print "<td><a href=profesores_viewinfo.php?profesor_id=" ;
          print $rowAssig['profesor_id'].">" ;
          print $rowAssig['profesor_id']."</a></td>" ;
          print "<td>".$rowAssig['mes']."</td>";
          print "<td>".$rowAssig['anio']."</td>" ;
          print "<td>".$rowAssig['practica']."</td>" ;

          print "</tr>";
          
        }

        print "</table>";
        mysqli_close( $dbconnection);
        ?>


      </div>
    </div>
  </div>
</body>
</html>