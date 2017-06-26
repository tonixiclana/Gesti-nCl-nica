<html>
<head>
<title>Apartado de paciente</title>
 <link rel="stylesheet" type="text/css" href="css/general.css">
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <script src="js/jquery-3.1.1.min.js"></script>
 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>  
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
  			<h3 class="text-center">Panel de control de paciente</h3>
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
              Citas <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a onclick="cargar('FuncionesComunes/nuevaCita')">Nueva cita</a></li>
              <li><a onclick="cargar('Paciente/consultarCita')">Consultar citas</a></li>
            </ul>
          </div>
          <div class="btn-group">
            <a type="button" class="btn btn-primary" onclick="cargar('Paciente/verInforme')">
              Informes
            </a>
          </div>
        </div>
      </div>
  		  
  		</div>
  		<div class="row"><div class = "col-md-12"><br><br><br></div></div>
      
    	
    </div>
    
    <div class="row text-center">
		<div id="contenido" class="col-md-12"></div>
	  </div>
</div>
</body>

</html>