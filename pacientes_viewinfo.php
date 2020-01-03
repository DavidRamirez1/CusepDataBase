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
  <title>Cusep - Paciente View Info</title>
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

        <h1>Manejo de Datos - Paciente</h1>
        <ul>
          <li><a href="pacientes_view.php">Ver Pacientes</a></li>
          <li><a href="pacientes_update.php">Actualizar informacion de Paciente</a></li>
          <li><a href="pacientes_insert.php">Insertar Paciente nuevo</a></li>
          <li><a href="pacientes_delete.php">Borrar Paciente</a></li>
        </ul>

        <h1>Informacion de Paciente</h1>
        <table>
          <tr>
            <th>Numero de Expediente</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Genero</th>
            <th>Status</th>
            <th>Horas de Sesiones</th>
            <th>Diagnostico</th>
            <th>Fecha de Solicitud</th>
            <th>Fecha de Asignacion</th>
            <th>Victima de Crimen</th>
            <th>Programa</th>
            <th>Discapacidad</th>
          </tr>
        <?php 

        if(empty($_GET['numero_expediente'])){
          header("Location: pacientes_view.php");
        }

        $pid = mysqli_real_escape_string($dbconnection, $_GET['numero_expediente']);

        $sqlAssig = sprintf("select * from Paciente P where P.numero_expediente = %s", $pid);
  
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
          print "<tr>" ;
          print "<td>".$rowAssig['numero_expediente']."</td>" ;
          print "<td>".$rowAssig['nombre']."</td>";
          print "<td>".$rowAssig['apellido']."</td>";
          print "<td>".$rowAssig['edad']."</td>" ;
          print "<td>".$rowAssig['genero']."</td>" ;
          print "<td>".$rowAssig['estatus']."</td>" ;
          print "<td>".$rowAssig['horas_sesiones']."</td>" ;
          print "<td>".$rowAssig['diagnostico']."</td>" ;
          print "<td>".$rowAssig['fecha_solicitud']."</td>";
          print "<td>".$rowAssig['fecha_asignacion']."</td>" ;
          print "<td>".$rowAssig['victima_crimen']."</td>" ;
          print "<td>".$rowAssig['programa']."</td>" ;
          print "<td>".$rowAssig['disability']."</td>" ;

          print "</tr>";
        }

        print "</table>" ;
        ?>

        <h1>Servicios por Estudiante Supervisado</h1>
        <table>
          <tr>
            <th>Tipo de Intervencion</th>
            <th>Horas de Sesion</th>
            <th>Mes</th>
            <th>Year</th>
            <th>Nombre de Estudiante</th>
            <th>Apellido de Estudiante</th>
            <th>Numero Estudiante</th>
            <th>Profesor Id</th>
            <th>Nombre de Profesor</th>
            <th>Apellido de Profesor</th>
            <th>Practica</th>
          </tr>

        <?php

        $sqlAssig = sprintf("select E.nombre_estudiante, E.apellido_estudiante, E.numero_estudiante, P.nombre_profesor, P.apellido_profesor, P.profesor_id, S.practica, A.tipo_intervencion, A.horas_de_sesion, S.anio, S.mes from Atendido_Estudiante A, Supervisado S, Estudiante E, Profesor P where A.numero_expediente = %s and A.supervisado_id = S.supervisado_id and E.numero_estudiante = S.numero_estudiante and P.profesor_id = S.profesor_id", $pid);

         // $sqlAssig = sprintf("select A.tipo_intervencion, A.horas_de_sesion, S.mes, S.anio, E.nombre_estudiante, E.apellido, P.nombre_profesor, P.apellido_profesor,  S.practica from Estudiante E, Supervisado S, Profesor P, Paciente PA, Atendido_Estudiante A where A.numero_expediente = %s and A.supervisado_id = S.supervisado_id and P.profesor_id = S.profesor_id and E.numero_estudiante = S.numero_estudiante", $pid);  
        
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){

          print "<tr>" ;

          
          print "<td>".$rowAssig['tipo_intervencion']."</td>" ;
          print "<td>".$rowAssig['horas_de_sesion']."</td>" ;
          print "<td>".$rowAssig['mes']."</td>";
          print "<td>".$rowAssig['anio']."</td>";
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
          print "<td>".$rowAssig['practica']."</td>" ;


          /*print "<td>".$rowAssig['nombre_estudiante']."</td>" ;
          print "<td>".$rowAssig['apellido']."</td>" ;
          print "<td>".$rowAssig['nombre_profesor']."</td>" ;
          print "<td>".$rowAssig['apellido_profesor']."</td>" ;
          print "<td>".$rowAssig['practica']."</td>" ;
          print "<td>".$rowAssig['tipo_intervencion']."</td>";
          print "<td>".$rowAssig['horas_de_sesion']."</td>" ;
          print "<td>".$rowAssig['mes']."</td>";
          print "<td>".$rowAssig['anio']."</td>";*/

          print "</tr>";
        }

        print "</table>";
        ?>

        <h1>Pacientes Atendido por Estudiante</h1>
        <table>
          <tr>
            <th>Numero Expediente</th>
            <th>Nombre Paciente</th>
            <th>Apellido Paciente</th>
            <th>Tipo de Intervencion</th>
            <th>Horas de Sesiones</th>
            <th>Semestre</th>
            <th>Numero de Practica</th>
            <th>Nombre Profesor</th>
            <th>Apellido Profesor</th>
          </tr>

        <?php
/*
        $sqlAssig = sprintf("select A.numero_expediente, PA.nombre, PA.apellido, A.tipo_de_intervencion, A.horas_de_sesion, A.semestre, P.nombre_profesor, P.apellido from Atendido_Estudiante A, Profesor P, Paciente PA, Supervisado S where A.numero_estudiante = %s and S.profesor_id = A.profesor_id and S.profesor_id = P.profesor_id and PA.numero_expediente = A.numero_expediente", $nid);  
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){

          print "<tr>" ;
          print "<td>".$rowAssig['numero_expediente']."</td>" ;
          print "<td>".$rowAssig['nombre']."</td>" ;
          print "<td>".$rowAssig['apellido']."</td>";
          print "<td>".$rowAssig['tipo_de_intervencion']."</td>";
          print "<td>".$rowAssig['horas_de_sesion']."</td>" ;
          print "<td>".$rowAssig['semestre']."</td>" ;
          print "<td>".$rowAssig['numero_practica']."</td>";          
          print "<td>".$rowAssig['nombre_profesor']."</td>" ;
          print "<td>".$rowAssig['apellido']."</td>" ;

          
          print "</tr>";*/
        //}

        print "</table>";

        mysqli_close( $dbconnection);
        ?>
      </div>
    </div>
  </div>
</body>
</html>