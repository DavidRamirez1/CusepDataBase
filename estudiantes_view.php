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
  <title>Estudiante - View</title>
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

        <h1>Buscar por Numero de Estudiante</h1>

        <div class="search-container">
        <form action= "estudiantes_viewinfo.php" method="GET">
        <input type="text" placeholder="Escriba Numero de Estudiante Aqui" name="numero_estudiante">
        <button type="submit">Submit</button>
        </form>
        </div>

        <h1>Buscar por Nombre y Apellido</h1>
        <h1>Lista de Estudiantes</h1>
        <table>
          <tr>
            <th>Numero de Estudiante</th>
            <th>Nombre</th>
          </tr>
        <?php 

        $sqlAssig = sprintf("select E.numero_estudiante, E.nombre_estudiante, E.apellido_estudiante from Estudiante E");
  
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
          print "<tr>" ;
          print "<td><a href=estudiantes_viewinfo.php?numero_estudiante=";
          print $rowAssig['numero_estudiante'].">" ;
          print $rowAssig['numero_estudiante']."</a></td>" ;
          print "<td>".$rowAssig['nombre_estudiante']." ".$rowAssig['apellido_estudiante']."</td>";
          print "</tr>";
        }

        print "</table>" ;

        mysqli_close( $dbconnection);
        ?>
      </div>
    </div>
  </div>
</body>
</html>