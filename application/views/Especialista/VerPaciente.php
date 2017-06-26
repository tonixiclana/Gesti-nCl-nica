<div class="container">
    <div class="form-group">
      <label for="dni">Introduzca el DNI a buscar</label><input type="text" class="form-control campos" id="dni" required>
    </div>    
    <button class="btn btn-default" onclick="verPaciente()">Buscar Paciente</button>
    <br></br>

  <?php
	if (isset($paciente)) {
		foreach($paciente as $p)
		{
		  $Id=$p->Id;
		
?>

  <div class="form-group">
 	<input id="id" type="hidden" value="<?=$p->Id?>">
    <label for="dni">DNI</label>
    <input type="text" class="form-control campos" id="dniPaciente"value="<?=$p->Dni?>" required>
  </div>   
  
 <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control campos" id="nombre" value="<?=$p->Nombre?>" required>
 </<div>
 	
 <div class="form-group">
    <label for="apellido1">Primer Apellido</label>
    <input type="text" class="form-control campos" value="<?=$p->Apellido1?>"id="apellido1" required>
 </div>  
 
 
<div class="form-group">
    <label for="apellido2">Segundo Apellido</label>
    <input type="text" class="form-control campos" id="apellido2" value="<?=$p->Apellido2?>"required>
 </div>
 <div class="form-group">
    <label for="telefono">Teléfono</label>
    <input type="tel" class="form-control campos" id="telefono"value="<?=$p->Telefono?>" required>
 </div>  
 
 <div class="form-group">
    <label for="direccion">Dirección</label>
    <input type="text" class="form-control campos" id="direccion" value="<?=$p->Direccion?>" required>
 </div>
 
	<button class="btn btn-default" onclick="confirmaEliminarPaciente(<?php echo $Id ?>)">Eliminar</button>
	<button class="btn btn-default" onclick="modificarPaciente()">Modificar</button>

</div>
	
<?php
	}
}

?>