<?php

if($informe != NULL)
{

echo '<div class="table-responsive">';
  echo '<table class="table-responsive table-condensed informe">';
    echo '<thead>';
      echo '<tr>';
        echo '<th> Consulta </th>';
        echo '<th> Fecha Cita </th>';
        echo '<th> Informe </th>';
      echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach($informe as $row)
    {
      echo '<tr>';
        echo '<td>' .$row->Nombre. '</td>';
        echo '<td>' .date_format(date_create($row->FechaIni), 'd-m-Y H:i'). '</td>';
        echo '<td class="informe">' .$row->Descripcion. '</td>';
      echo '</tr>';
    }
    echo '</tbody>';
  echo '</table>';
echo '</div>';

}
else {
			echo '<div class="alert alert-success">
	            <strong>No tiene informes</strong>.
	            </div>';
}
?>