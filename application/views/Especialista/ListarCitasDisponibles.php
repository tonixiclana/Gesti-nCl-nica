<?php 
	echo '<button onclick="listarPaciente();">Seleccionar un paciente</button>';
	echo '<div id="listadoPaciente"></div>';
//Visualizamos las citas disponibles
			echo '<ul class="list-group">';
			echo '<li class="list-group-item">'.date('d-m-Y',mktime(0, 0, 0, $mes, $dia, $year)).'</li>';
			for($j = 0; $j < sizeof($unixInicio); $j++)
				for($i = $unixInicio[$j]; $i < $unixFin[$j]; $i += 60*$duracionCita[$j] )
				{
					if ( (in_array(date('H',$i), $hora) && in_array(date('i',$i), $min) )
						|| time()>$i )
						echo '<li class="list-group-item">'.date('H:i',$i).'</li>';
					else 
						echo '<li class="list-group-item active">
							<a style="color: black;" onclick="crearCita(
							\''.date('Y-m-d H:i:s',$i).'\',
							\''.date('Y-m-d H:i:s',$i + 60 * $duracionCita[$j]).'\'
							)">'.date('H:i',$i).'</a></li>';
				}
			echo '</ul>';
?>