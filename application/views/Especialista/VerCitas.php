 <?php
echo '<div class="alert alert-success">
    <strong>Pinche en la consulta para atenderla</strong>
    </div>';

$ContadorDeCitas = 0;
foreach ($citas as $row) {
    if($row->Informe == NULL)
    {
        echo '<ul class="list-group">';
        echo '<li class="list-group-item">
        <a onclick="pincharCrearInforme('.$row->Id.')">
        '.$row->NombreEspecialidad.' '.$row->FechaIni.'
        '.$row->FechaFin.' '.$row->Dni.' '.$row->Nombre.' '.$row->Apellido1.' 
        '.$row->Apellido2.'
        </a></li>';
        echo '</ul>';
        $ContadorDeCitas++;
    }
} 


if($ContadorDeCitas == 0)
    echo '<div class="alert alert-success">
        <strong>Todas las citas están atendidas.</strong>
        </div>';
    
    $barra = $ContadorDeCitas*5;
echo '<div class="progress">
            Citas Restantes
          <div class="progress-bar" role="progressbar" aria-valuenow="30"
          aria-valuemin="0" aria-valuemax="10" style="width:'.$barra.'%">
          '.$ContadorDeCitas.'
          </div>
    </div>';
?>



    
