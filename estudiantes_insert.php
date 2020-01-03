<!DOCTYPE HTML>
<html>

<head>
  <title>Estudiante - Insert</title>
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

        <h1>Informacion de Estudiante Nuevo</h1>
        <form action="estudiantes_insertconf.php" method="post">
          Numero Estudiante: <input type="text" name="numero_estudiante"/><br></br>
          Nombre: <input type="text" name="nombre_estudiante"/><br></br>
          Apellido: <input type="text" name="apellido_estudiante"/><br></br>
          Practica: <input type="text" name="numero_practica"/><br></br>
          Discapacidad: <input type="text" name="disability"/><br></br>
          Horas Face-To-Face: <input type="text" name="horas_facetoface"/><br></br>
          A~o de Ingreso: <input type="text" name="anio_ingreso"/><br></br>
          Cantidad de Pacientes: <input type="text" name="cantidad_pacientes"/><br></br>
          Area: <input type="text" name="area"/><br></br>
          <input type="submit"/>
        </form>

      </div>
    </div>
  </div>
</body>
</html>