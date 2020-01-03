<!DOCTYPE HTML>
<html>

<head>
  <title>CUSEP - Estudiante Delete</title>
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
         if(isset($_POST['delete'])) {
            
           $db_username = "admin_cusep";
           $db_password = "d@v1d";
           $db_hostname = "localhost";
           $db_database = "CUSEP";

            mysqli_report(MYSQLI_REPORT_STRICT);

           try{

            $dbconnection = mysqli_connect($db_hostname, $db_username, $db_password, $db_database) or $error=1;
             }

            catch(Exception $ex){
            die("FAIL".$ex->getMessage());
           }
              
            $numest = mysqli_real_escape_string($dbconnection, $_POST['numero_estudiante']);
           
            $sql = "delete from Estudiante where numero_estudiante = '$numest'" ;

           if(mysqli_query($dbconnection, $sql)){
            echo "Informacion eliminada exitosamente" ;
           }
           else{
            echo "Error: ".$sql."<br>".mysqli_error($dbconnection);
           }
            
          mysqli_close($dbconnection);
         } 
         else {
            ?>
          
        <h1>Borrar Estudiante</h1>

        <form action="estudiantes_delete.php" method="post">
          Numero Estudiante: <input type="text" name="numero_estudiante"/><br></br>
          <input name= "delete" type="submit" id = "delete" value = "Borrar"/>
        </form>

        <?php
         }
      ?>

      </div>
    </div>
  </div>
</body>
</html>