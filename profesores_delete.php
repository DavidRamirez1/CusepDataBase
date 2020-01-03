<!DOCTYPE HTML>
<html>

<head>
  <title>CUSEP - Profesores Delete</title>
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
              
            $profid = mysqli_real_escape_string($dbconnection, $_POST['profid']);
           
            $sql = "delete from Profesor where profesor_id = '$profid'" ;

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
          
        <h1>Borrar Profesor</h1>

        <form action="profesores_delete.php" method="post">
          Profesor ID: <input type="text" name="profid"/><br></br>
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