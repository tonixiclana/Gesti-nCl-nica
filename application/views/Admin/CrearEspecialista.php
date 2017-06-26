<div class="container">       
        <div class="form-group">
                <label for="dni">DNI</label><input type="text" class="form-control campos" id="dni" required>
        </div>    
        <div class="form-group">
                <label for="nombre">Nombre</label><input type="text" class="form-control campos" id="nombre" required>
        </<div>
        <div class="form-group">
                <label for="apellido1">Primer Apellido</label><input type="text" class="form-control campos" id="apellido1" required>

        </div>  
        <div class="form-group">
                <label for="apellido2">Segundo Apellido</label><input type="text" class="form-control campos" id="apellido2" required>

        </div>
        <div class="form-group">
                <label for="password">Contraseña</label><input type="text" class="form-control campos" id="password" required>

        </div>  
        <select class="form-control" id="especialidad">
      <?php 
        foreach($especialidad as $row)
        { 
                echo '<option id="especialidad" value="'.$row->Id.'">'.$row->Nombre.'</option>';
        }
      ?>
        </select>
        <input title="Enviar" type="submit" class="btn btn-default" onclick="crearEspecialista()">
</div>