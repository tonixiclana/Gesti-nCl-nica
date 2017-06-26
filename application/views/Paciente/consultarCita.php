<?php

if($cita != NULL)
{

echo '<div class="table-responsive">';
  echo '<table class="table-responsive table-condensed cita">';
    echo '<thead>';
      echo '<tr>';
        echo '<th> Consulta </th>';
        echo '<th> Fecha Inicio </th>';
        echo '<th> Fecha Fin </th>';
      echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach($cita as $row)
    {
      if($row->FechaIni > date("Y-m-d"))
      {
      echo '<tr>';
        echo '<td class="cita1">' .$row->Nombre. '</td>';
        echo '<td class="cita">' .date_format(date_create($row->FechaIni), 'd-m-Y H:i'). '</td>';
        echo '<td class="cita">' .date_format(date_create($row->FechaFin), 'd-m-Y H:i'). '</td>';
      echo '</tr>';
      }
    }
    echo '</tbody>';
  echo '</table>';
echo '</div>';

}
else {
				echo '<div class="alert alert-success">
            <strong>No tiene asignadas citas</strong>.
            </div>';
}

?>


