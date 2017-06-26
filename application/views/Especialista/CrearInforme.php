<div class="form-group">
        <label for="informe">Redacta el informe</label>
        <textarea class="form-control" id="informe" value="30" rows="3"></textarea>
        <input type="hidden" id="test" value="test"/>
</div>
<?php
  echo '<input title="Enviar" type="submit" class="btn btn-default" 
    onclick="crearInforme('.$idCita.')">';
?>
