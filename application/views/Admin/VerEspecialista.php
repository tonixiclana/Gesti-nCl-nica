
    <div class="container">
      <label for="dni">Introduzca el DNI a buscar</label><input type="text" class="form-control campos" id="dni" required>
    </div>  
    <div>
    <button class="btn btn-default" onclick="verEspecialista()">Buscar Especialista</button>
    </div>
    <br></br>
    
  <?php
	if (isset($especialista)) {
		foreach($especialista as $e)
		{
		  $Id=$e->Id;
?>
 <div class="container">
 	<input id="id" type="hidden" value="<?=$e->Id?>">
    <label for="dni">DNI</label>
    <input type="text" class="form-control campos" id="dniEspecialista" value="<?=$e->Dni?>" required>
  </div>   
  
 <div class="container">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control campos" id="nombre" value="<?=$e->Nombre?>" required>
 </<div>
 	
 <div class="container">
    <label for="apellido1">Primer Apellido</label>
    <input type="text" class="form-control campos" id="apellido1" value="<?=$e->Apellido1?>" required>
 </div>  
 
 <div class="container">
    <label for="apellido2">Segundo Apellido</label>
    <input type="text" class="form-control campos" id="apellido2" value="<?=$e->Apellido2?>"required>
 </div>
 
 <div class="container">
    <label for="password">Password</label>
    <input type="password" class="form-control campos" id="password" value="<?=$e->Password?>"required>
 </div>
 
<br></br>
 
	<button class="btn btn-default" onclick="confirmaEliminarEspecialista()">Eliminar</button>
	<button class="btn btn-default" onclick="modificarEspecialista()">Modificar</button>
<?php
	}
}

?>