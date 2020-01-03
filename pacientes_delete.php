<!DOCTYPE HTML>
<html>

<head>
  <title>CUSEP - Pacientes Delete</title>
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

        <h1>Manejo de Datos - Pacientes</h1>
        <ul>
          <li><a href="pacientes_view.php">Ver Pacientes</a></li>
          <li><a href="pacientes_update.php">Actualizar informacion de Paciente</a></li>
          <li><a href="pacientes_insert.php">Insertar Paciente nuevo</a></li>
          <li><a href="pacientes_delete.php">Borrar Paciente</a></li>
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
              
            $numexp = mysqli_real_escape_string($dbconnection, $_POST['numero_expediente']);

            $sql = "delete from Paciente where numero_expediente = $numexp" ;

           if(mysqli_query($dbconnection, $sql)){
            echo "Nueva informacion borrada exitosamente" ;
           }
           else{
            echo "Error: ".$sql."<br>".mysqli_error($dbconnection);
           }
            
          mysqli_close($dbconnection);
         } 
         else {
            ?>

        <h1>Borrar Paciente</h1>
        <form action="pacientes_delete.php" method="post">
          Numero Expediente: <input type="text" name="numero_expediente"/><br></br>
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