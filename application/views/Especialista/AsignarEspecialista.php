<?php
    if($citas != NULL){
        foreach ($citas as $row) {
            echo '<ul class="list-group">';
            echo '<li class="list-group-item">
            <a onclick="asignarEspecialista('.$row->Id.')">
            '.$row->NombreEspecialidad.' '.$row->FechaIni.'
            '.$row->FechaFin.' '.$row->Dni.' '.$row->Nombre.' '.$row->Apellido1.' 
            '.$row->Apellido2.'
            </a></li>';
            echo '</ul>';
        } 
    }
    else{
        echo '<div class="alert alert-success">
            <strong>No hay más citas para asignar especialista</strong>.
            </div>';
    }
?>






