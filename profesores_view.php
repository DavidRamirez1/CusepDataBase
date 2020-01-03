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
  <title>CUSEP - Profesores View</title>
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
          <li class="selected"><a href="profesores.html">Profesores</a></li>
          <li><a href="supervisiones.html">Supervisiones y Casos</a></li>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div id="content">
        <!-- insert the page content here -->
        
        <h1>Manejo de Datos - Profesores</h1>
        <ul>
          <li><a href="profesores_view.php">Ver Profesores</a></li>
          <li><a href="profesores_update.php">Actualizar informacion de Profesor</a></li>
          <li><a href="profesores_insert.php">Insertar Profesor nuevo</a></li>
          <li><a href="profesores_delete.php">Borrar Profesor</a></li>
        </ul>

        <h1>Buscar por Nombre y Apellido</h1>
        <div class="search-container">
        <form action= "profesores_viewinfo.php" method="post">
        <p>Nombre:
        <input type="text" placeholder="Escriba nombre aqui" name="nombre_profesor"></p>
        <p>Apellido:
        <input type="text" placeholder="Escriba apellido aqui" name="apellido_profesor"></p>
        <button type="submit">Submit</button>
        </form>
        </div>
        <h1>Lista de Profesores</h1>
        <table>
          <tr>
            <th>Numero de Expediente</th>
            <th>Nombre</th>
          </tr>

        <?php 

        $sqlAssig = sprintf("select P.nombre_profesor, P.apellido_profesor, P.profesor_id from Profesor P");
  
        $resAssig = mysqli_query($dbconnection, $sqlAssig);

        while($rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC)){
 
          print "<tr>" ;
          print "<td><a href=profesores_viewinfo.php?profesor_id=";
          print $rowAssig['profesor_id'].">" ;
          print $rowAssig['profesor_id']."</a></td>" ;
          print "<td>".$rowAssig['nombre_profesor']." ".$rowAssig['apellido_profesor']."</td>";
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