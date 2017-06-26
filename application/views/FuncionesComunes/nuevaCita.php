<div id="desplegable">
  <select class="form-control" id="especialidad">
      <?php 
        foreach($especialidad as $row)
        { 
          echo '<option id="especialidad" value="'.$row->Id.'">'.$row->Nombre.'</option>';
        }
      ?>
  </select>
  </br>
  </br>
</div>
<input type="hidden" id="idPaciente"value=""/>
<div>
  <?php
    echo "<p>".$this->calendar->generate($this->uri->segment(3), $this->uri->segment(4), isset($dias)?$dias:NULL)."</p>";
  ?>
  
<div class="row text-center">
  <div id="citasDisponibles" class="col-md-12"></div>
</div>
	
</div>