<!DOCTYPE HTML>
<html>

<head>
  <title>CUSEP - Pacientes Insert</title>
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

        <h1>Informacion de Paciente Nuevo</h1>
        <form action="pacientes_insertconf.php" method="post">
          Numero Expediente: <input type="text" name="numero_expediente"/><br></br>
          Nombre: <input type="text" name="nombre"/><br></br>
          Apellido: <input type="text" name="apellido"/><br></br>
          Edad: <input type="text" name="edad"/><br></br>
          Genero: <select name="genero">    
                    <option value="No informado">No informado</option>
                    <option value="Femenino">Femenina</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Non-binary">Non-binary</option>     
                  </select><br></br>
          Estatus: <input type="text" name="estatus"/><br></br>
          Horas de Sesiones Totales: <input type="text" name="horas_sesiones"/><br></br>
          Diagnostico: <input type="text" name="diagnostico"/><br></br>
          Fecha de Solicitud: <input type="text" name="fecha_solicitud"/><br></br>
          Fecha de Asignacion: <input type="text" name="fecha_asignacion"/><br></br>
          Victima de Crimen: <input type="text" name="victima_crimen"/><br></br>
          Programa: <input type="text" name="programa"/><br></br>
          Discapacidad: <input type="text" name="disability"/><br></br>
          <input type="submit"/>
        </form>

      </div>
    </div>
  </div>
</body>
</html>