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
  <title>CUSEP - Profesores Update</title>
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
         if(isset($_POST['update'])) {
            
            
            if(!empty($_POST['profesor_id']) && !empty($_POST['nombre_profesor']) && !empty($_POST['apellido_profesor']) && !empty($_POST['creditos'])){

            $profid = mysqli_real_escape_string($dbconnection, $_POST['profesor_id']);
            $nombprof = mysqli_real_escape_string($dbconnection, $_POST['nombre_profesor']);
            $appprof = mysqli_real_escape_string($dbconnection, $_POST['apellido_profesor']);
            $cred = mysqli_real_escape_string($dbconnection, $_POST['creditos']);

            $sql = "update Profesor set nombre_profesor = '$nombprof', apellido_profesor = '$appprof', creditos = $cred where profesor_id = $profid" ;

           if(mysqli_query($dbconnection, $sql)){
            echo "Nueva informacion actualizada exitosamente" ;
           }
           else{
            echo "Error: ".$sql."<br>".mysqli_error($dbconnection);
           }
          }

         else{
            echo "Asegurese que se entre toda la informacion!" ;
         }
          mysqli_close($dbconnection);
         } 

        ?>

        <?php
         if(isset($_POST['update1'])) {

          $profid = mysqli_real_escape_string($dbconnection, $_POST['profesor_id']);

          $sqlAssig = sprintf("select * from Profesor P where P.profesor_id = '$profid'");

          $resAssig = mysqli_query($dbconnection, $sqlAssig);

          $rowAssig = mysqli_fetch_array($resAssig, MYSQL_ASSOC) ;

          echo $rowAssig['profesor_id'] ;
          echo 'hi';
          print "<h1>Informacion Actualizada de Profesor</h1>";
          print "<form action=profesores_update.php method=post>";
          
          print "Profesor ID: <input type=text name=profesor_id value=".$profid." ><br></br>" ;
          print "Nombre Profesor: <input type=text name=nombre_profesor value=";
          echo $rowAssig['nombre_profesor'] ; print " /><br></br>" ;
          print "Apellido Profesor: <input type=text name=apellido_profesor value=" ; 
          echo $rowAssig['apellido_profesor'];
          print " ><br></br>" ;
          print "Creditos: <input type=text name=creditos value=" ;
          echo $rowAssig['creditos']; 
          print " ><br></br>" ;
          print "<input name=update type=submit id = update value = Update />";
          print "</form>";
            
          mysqli_close($dbconnection);
         } 
         else {
            ?>

        <h1>Actualizacion de Profesor</h1>
        <form action="profesores_update.php" method="post">
          <h5>Profesor que quiere actualizar</h5>
          Profesor ID: <input type="text" name="profesor_id"/><br></br>
          <input name= "update1" type="submit" id = "update1" value = "Update"/>
        </form>
        <?php
         } ;
      ?>

      </div>
    </div>
  </div>
</body>
</html>