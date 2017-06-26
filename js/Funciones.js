 function cargar(direccion)
 {
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 $.ajax({
		 type: 'POST',
		 url: direccion, //Realizaremos la petición al metodo list_dropdown del controlador match
		 data: 'tnmnt=uno', //Pasaremos por parámetro POST el id del torneo
		 success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
			 //Activar y Rellenar el select de partidos
			 $('#contenido').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
		 }
	 });
 }

  function crearPaciente()
 {
 	//$('#submit').click(function(){
	   // if($("form")[0].checkValidity()) {
	    	
		 	var dni = document.getElementById("dni").value;
		 	var nombre = document.getElementById("nombre").value;
		 	var apellido1 = document.getElementById("apellido1").value;
		 	var apellido2 = document.getElementById("apellido2").value;
		 	var telefono = document.getElementById("telefono").value;
		 	var direccion = document.getElementById("direccion").value;
		 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
			 
			 $.ajax({
				 type: 'POST',
				 url: '/Especialista/crearPaciente', 
				 data: 'dni='+dni+"&nombre="+nombre+"&apellido1="+apellido1+"&apellido2="+apellido2+"&telefono="+telefono+"&direccion="+direccion, //Pasaremos por parámetro POST el id del torneo
				 success: function(resp) { 
					 $('#contenido').html(resp);
				 }
			 });
			 
	    // }else console.log("invalid form");
  // });
 }
 
 function crearInforme(IdCita)
 {
 	var contenidoInforme = document.getElementById("informe").value;
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 $.ajax({
		 type: 'POST',
		 url: '/Especialista/crearInforme', 
		 data: 'idCita='+IdCita+'&informe='+contenidoInforme,
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
 }
  function verInforme() {
  	var contenidoDni = document.getElementById("dni").value;
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 $.ajax({
		 type: 'POST',
		 url: '/Especialista/mostrarInformePaciente', 
		 data: 'dni='+contenidoDni,
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
 }
 
function verPaciente() {
 	var dni= document.getElementById("dni").value;
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 
	 $.ajax({
		 type: 'POST',
		 url: '/Especialista/verPaciente', 
		 data: 'dni='+dni,
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
}

function listarPaciente() {
 	$('#listadoPaciente').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 $.ajax({
		 type: 'POST',
		 url: '/Especialista/listarPaciente', 
		 success: function(resp) { 
			 $('#listadoPaciente').html(resp);
		 }
	 });
}

function confirmaEliminarPaciente(Id){
	if (confirm("¿Realmente desea eliminarlo?"))
	{ 
		alert("El registro ha sido eliminado.")
 		
 		$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
		
		$.ajax({
			 type: 'POST',
			 url: '/Especialista/borrarPaciente', 
			 data: 'id='+Id,
			 success: function(resp) { 
				 $('#contenido').html(resp);
			 }
		});
	}
}
function confirmaModificarPaciente(Id){
	if (confirm("¿Estás seguro de modificarlo con estos datos?"))
	{ 
		alert("El registro ha sido modificado.")
 		
 		$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
		
		$.ajax({
			 type: 'POST',
			 url: '/Especialista/modificarPaciente', 
			 data: 'id='+Id,
			 success: function(resp) { 
				 $('#contenido').html(resp);
			 }
		});
	}
}
/*  FUNCIONES PARA ADMIN */
function verEspecialista() {
 	var dni= document.getElementById("dni").value;
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 
	 $.ajax({
		 type: 'POST',
		 url: '/Admin/verEspecialista', 
		 data: 'dni='+dni,
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
}


function confirmaEliminarEspecialista(){
	var dni= document.getElementById("dniEspecialista").value;
	if (confirm("¿Realmente desea eliminarlo?"))
	{ 
		alert("El registro ha sido eliminado.")
 		
 		$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
		
		$.ajax({
			 type: 'POST',
			 url: '/Admin/borrarEspecialista', 
			 data: 'dni='+dni,
			 success: function(resp) { 
				 $('#contenido').html(resp);
			 }
		});
	}
}

function modificarEspecialista()
 {
 	var dni = document.getElementById("dniEspecialista").value;
 	var nombre = document.getElementById("nombre").value;
 	var apellido1 = document.getElementById("apellido1").value;
 	var apellido2 = document.getElementById("apellido2").value;
 	var password = document.getElementById("password").value;
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 
	 $.ajax({
		 type: 'POST',
		 url: '/Admin/modificarEspecialista', 
		 data:'dni='+dni+'&nombre='+nombre+'&apellido1='+apellido1+'&apellido2='+apellido2+'&password='+password,
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
 }
/* FIN FUNCIONES PARA ADMIN */

// Funciones calendario
function crearCita(fechaInicio, fechaFin)
 {
 	var especialidad = document.getElementById("especialidad").value;
 	var paciente = document.getElementById("paciente").value;
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 
	 $.ajax({
		 type: 'POST',
		 url: '/FuncionesComunes/crearCita', 
		 data: 'especialidad='+especialidad+'&paciente='+paciente+'&fechaInicio='+fechaInicio+'&fechaFin='+fechaFin,
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
 }
 
function cargarCitasDisponibles(direccion)
 {
 	$('#citasDisponibles').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 $.ajax({
		 type: 'POST',
		 url: direccion, //Realizaremos la petición al metodo list_dropdown del controlador match
		 data: 'tnmnt=uno', //Pasaremos por parámetro POST el id del torneo
		 success: function(resp) { //Cuando se procese con éxito la petición se ejecutará esta función
			 //Activar y Rellenar el select de partidos
			 $('#citasDisponibles').html(resp); //Con el método ".html()" incluimos el código html devuelto por AJAX en la lista de partidos
		 }
	 });
 }
 //Fin funciones crear cita
 
 function modificarPaciente()
 {
 	var id = document.getElementById("id").value;
 	var dni = document.getElementById("dniPaciente").value;
 	var nombre = document.getElementById("nombre").value;
 	var apellido1 = document.getElementById("apellido1").value;
 	var apellido2 = document.getElementById("apellido2").value;
 	var direccion = document.getElementById("direccion").value;
 	var telefono = document.getElementById("telefono").value;
 	
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 
	 $.ajax({
		 type: 'POST',
		 url: '/Especialista/modificarPaciente', 
		 data: 'id='+id+'&dni='+dni+'&nombre='+nombre+'&apellido1='+apellido1+'&apellido2='+apellido2+'&direccion='+direccion+'&telefono='+telefono,
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
 }
 
 function asignarEspecialista(id)
 {
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 
	 $.ajax({
		 type: 'POST',
		 url: '/Especialista/asignarEspecialista', 
		 data: 'id='+id,
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
  }
  
 function actualizarCitaEspecialista(idCita)
 {
  	var idEspecialista = document.getElementById("especialista").value;
  	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 $.ajax({
		 type: 'POST',
		 url: '/Especialista/actualizarCitaEspecialista', 
		 data: 'idCita='+idCita+'&idEspecialista='+idEspecialista,
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
  }
  
 function pincharCrearInforme(idCita) {
	 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
		 $.ajax({
			 type: 'POST',
			 url: '/Especialista/crearInforme', 
			 data: 'idCita='+idCita,
			 success: function(resp) { 
				 $('#contenido').html(resp);
			 }
		 });
	 }
 
function crearEspecialista() {
 	var dni = document.getElementById("dni").value;
 	var nombre = document.getElementById("nombre").value;
 	var apellido1 = document.getElementById("apellido1").value;
 	var apellido2 = document.getElementById("apellido2").value;
 	var password = document.getElementById("password").value;
 	var especialidad = document.getElementById("especialidad").value;
 	
 	$('#contenido').html('<p align="center"><img src="images/logoCargando.gif"/></p>');
	 
	 $.ajax({
		 type: 'POST',
		 url: '/Admin/crearEspecialista', 
		 data: 'dni='+dni+"&nombre="+nombre+"&apellido1="+apellido1+"&apellido2="+apellido2+"&password="+password+"&especialidad="+especialidad, //Pasaremos por parámetro POST el id del torneo
		 success: function(resp) { 
			 $('#contenido').html(resp);
		 }
	 });
 }