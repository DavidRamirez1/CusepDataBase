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
  <title>Estudiante - View Info</title>
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

        <h1>Informacion de Estudiante</h1>
        <table>
          <tr>
            <th>Numero de Estudiante</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Practica</th>
            <th>Diversidad Funcional</th>
            <th>Horas Contacto</th>
            <th>Fecha de Ingreso</th>
            <th>Cantidad de Pacientes</th>
            <th>Area</th>
          </tr>
        <?php 

        if(empty($_GET['numero_estudiante'])){
        	header("Location: estudiantes_view.php");
        }

     	$nid = mysqli_real_escape_string($dbconnection, $_GET['numero_estudiante']);
        $sqlAssig = sprintf("select * from Estudiante E where E.numero_estudiante = %s", $nid);
  
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
          print "<tr>" ;
          print "<td>".$rowAssig['numero_estudiante']."</td>" ;
          print "<td>".$rowAssig['nombre_estudiante']."</td>";
          print "<td>".$rowAssig['apellido_estudiante']."</td>";
          print "<td>".$rowAssig['numero_practica']."</td>" ;
          print "<td>".$rowAssig['disability']."</td>" ;
          print "<td>".$rowAssig['horas_facetoface']."</td>" ;
          print "<td>".$rowAssig['anio_ingreso']."</td>" ;
          print "<td>".$rowAssig['cantidad_pacientes']."</td>";
          print "<td>".$rowAssig['area']."</td>" ;
          print "</tr>";
        }

        print "</table>" ;
        ?>

        <h1>Supervision de Profesores</h1>
        <table>
          <tr>
            <th>Nombre de Profesor</th>
            <th>Apellido de Profesor</th>
            <th>Mes</th>
            <th>Year</th>
            <th>Practica</th>
          </tr>

        <?php

        $sqlAssig = sprintf("select P.nombre_profesor, P.apellido_profesor, P.profesor_id, S.mes, S.anio, S.practica from Supervisado S, Profesor P where S.numero_estudiante = %s and P.profesor_id = S.profesor_id ", $nid);  
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){

          print "<tr>" ;

          print "<td><a href=profesores_viewinfo.php?profesor_id=" ;
          print $rowAssig['profesor_id'].">" ;
          print $rowAssig['nombre_profesor']."</td>" ;
          print "<td>".$rowAssig['apellido_profesor']."</td>" ;
          print "<td>".$rowAssig['mes']."</td>" ;
          print "<td>".$rowAssig['anio']."</td>" ;
          print "<td>".$rowAssig['practica']."</td>";

          print "</tr>";
        }

        print "</table>";
        ?>

        <h1>Pacientes Atendidos por Estudiante</h1>
        <table>
          <tr>
            <th>Numero Expediente</th>
            <th>Nombre Paciente</th>
            <th>Apellido Paciente</th>
            <th>Tipo de Intervencion</th>
            <th>Horas de Sesiones</th>
            <th>Mes</th>
            <th>Year</th>
            <th>Practica</th>
            <th>Nombre Profesor</th>
            <th>Apellido Profesor</th>
          </tr>

        <?php

        $sqlAssig = sprintf("select A.numero_expediente, A.tipo_intervencion, A.horas_de_sesion, S.practica, S.mes, S.anio, PA.nombre, PA.apellido, PO.nombre_profesor, PO.apellido_profesor from Atendido_Estudiante A, Paciente PA, Supervisado S, Profesor PO where A.supervisado_id = S.supervisado_id and S.numero_estudiante = %s and A.numero_expediente = PA.numero_expediente and PO.profesor_id = S.profesor_id", $nid);  
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
          print "<td>".$rowAssig['practica']."</td>";          
          print "<td>".$rowAssig['nombre_profesor']."</td>" ; 
          print "<td>".$rowAssig['apellido_profesor']."</td>" ;
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