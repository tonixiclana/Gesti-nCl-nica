<!doctype html>
<html>
<head>
<meta charset="utf-8"/>   
<title>Apartado de especialista</title>
 <link rel="stylesheet" type="text/css" href="css/general.css">
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <script src="js/jquery-3.1.1.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/Funciones.js"></script>

</head>
<body>
<div class="container-fluid">
  	 <div class="row">
  		<div class="col-md-12">
  			<div id="logout">
  			  <button onclick="location.href='/Login/Logout'">Logout</button>
  			</div>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-12">
  			<h3 class="text-center">Panel de control de especialista</h3>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-md-12">
  			<p class="text-left">
  				<em><?php echo 'Bienvenid@ '.$this->session->userdata('nombre');?></em>
  			</p>
  			</div>
  	</div>
  	<div class="row">
  		<div class = "col-md-12">
  		  <div class="btn-group btn-group-justified">
          <div class="btn-group">
            <a type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              Pacientes <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a onclick="cargar('Especialista/crearPaciente')">Crear paciente</a></li>
              <li><a onclick="cargar('/Especialista/verPaciente')">Consultar paciente</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <a type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              Informes <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a onclick="cargar('Especialista/verInforme')">Ver informes</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <a type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
              Citas <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a onclick="cargar('FuncionesComunes/nuevaCita')">Crear citas</a></li>
              <li><a onclick="cargar('Especialista/consultarCitas')">Consultar citas</a></li>
              <li><a onclick="cargar('Especialista/asignarEspecialista')">Asignar especilista</a></li>
            </ul>
          </div>
        </div>
      </div>
  		  
  		</div>
  		<div class="row"><div class = "col-md-12"><br><br><br></div></div>
    
    		
    				<div class="row text-center">
		          <div id="contenido" class="col-md-12"></div>
	          </div>
    		
</div>
</body>

</html>