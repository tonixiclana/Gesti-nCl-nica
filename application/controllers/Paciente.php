<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class Paciente extends CI_Controller 
	{
		public function __construct()
        {
            parent::__construct();
    		$this->load->library(array('session','form_validation'));
    		$this->load->helper(array('url','form'));
    		$this->load->model('PacienteModel');
    		
    		$this->load->database('default');
    		//si no tengo el rol de paciente
    		if($this->session->userdata('rol') != 'paciente') redirect(base_url());
        }
        
		function index()
		{

			$this->load->view('Paciente/HomePaciente');
		}
		
		//funciones para crear citas
		function nuevaCita()
		{
			$prefs['template'] = '
			{table_open}<table style="margin: 0 auto;" cellpadding="1" cellspacing="2">{/table_open}

			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th class="prev_sign"><a onclick="cargar(\'{previous_url}\')">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th class="next_sign"><a onclick="cargar(\'{next_url}\')">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			//Deciding where to week row start
			{week_row_start}<tr class="week_name" >{/week_row_start}
			//Deciding  week day cell and  week days
			{week_day_cell}<td >{week_day}</td>{/week_day_cell}
			//week row end
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr>{/cal_row_start}
			{cal_cell_start}<td>{/cal_cell_start}
			
			{cal_cell_content}<a onclick="cargarCitasDisponibles(\'{content}\')">{day}</a>{/cal_cell_content}
			{cal_cell_content_today}<div class="highlight"><a onclick="cargarCitasDisponibles(\'{content}\')">{day}</a></div>{/cal_cell_content_today}
			
			{cal_cell_no_content}{day}{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}
			';
			
			$prefs['day_type'] = 'short';
			$prefs['start_day'] = 'monday';
			$prefs['show_next_prev'] = true;
			
			// Loading calendar library and configuring table template
			$this->load->library('calendar', $prefs);
			
			$year = $this->uri->segment(3) == "" ? date("Y"): $this->uri->segment(3) ;
			$mes =  $this->uri->segment(4) == "" ? date("m"): $this->uri->segment(4);
			
			$data['especialidad'] = $this->PacienteModel->getTipoEspecialidad();
			
			//obtendo el primer dia del mes y el ultimo
			$fecha = date('Y-m-j',mktime(0, 0, 0, $mes, 1, $year));
			$fechaFin = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
			$fechaFin = date ( 'Y-m-j' , $fechaFin );
			
			$diasSemana = $this->PacienteModel->getCalendario();
			$cont = 0;
			foreach ($diasSemana as $value) {
				$diasSemanaArray[$cont] = $value->Dia;
				$cont++;
			}
			
			$cont = 1;
			for($i=strtotime($fecha); $i<strtotime($fechaFin); $i+=86400){
				if (in_array(date("N", $i), $diasSemanaArray) && time()<$i+86400) //comprobamos si el dia de la semana a comprobar esta en el horario
			    	$data['dias'][$cont] = "Paciente/listarCitasDisponibles/".date("d", $i)."/".date("m", $i)."/".date("Y", $i);
			    $cont++;
			}
			$cont = 1;

			$this->load->view('Paciente/nuevaCita', $data);
		}

		function listarCitasDisponibles()
		{
			//Sacamos la hora de la url y calculamos el dia de la semana
			$dia = $this->uri->segment(3);
			$mes = $this->uri->segment(4);
			$year = $this->uri->segment(5);
			$diaDeLaSemana = date('N',mktime(0, 0, 0, $mes, $dia, $year));
			
			//Obetenemos los arrays de horarios del dia de la semana concreto
			$diasSemana = $this->PacienteModel->getCalendario();
			foreach ($diasSemana as $value) {
				if($diaDeLaSemana == $value->Dia)
				{
					$horaInicio = explode(':', $value->HoraInicio);
					$horaFin = explode(':', $value->HoraFin);
					$duracionCita[] = $value->DuracionCita;
					$unixInicio[] = mktime($horaInicio[0], $horaInicio[1], 0, $mes, $dia, $year);
					$unixFin[] = mktime($horaFin[0], $horaFin[1], 0, $mes, $dia, $year);
				}
			}
			
			//Comprobamos las citas planificadas para el dia concreto
			$data = $this->PacienteModel->getCitasDisponibles($dia, $mes, $year);
			foreach ($data as $value) {
				$aux =  explode(" ", $value->FechaIni);
				$aux = $aux[1];
				$aux = explode(":", $aux);
				$hora[] = $aux[0];
				$min[] = $aux[1];
			}
			
			//Si no hay ninguna cita se ponen los arrays fuera de rango
			if(!isset($hora) && !isset($min))
			{
				$hora[0] = -1;
				$min[0] = -1;
			}

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
							<a style="color: black;" onclick="crearCita(\''.$this->session->userdata('id').'\',
							\''.date('Y-m-d H:i:s',$i).'\',
							\''.date('Y-m-d H:i:s',$i + 60 * $duracionCita[$j]).'\'
							)">'.date('H:i',$i).'</a></li>';
				}
			echo '</ul>';
		}
		
		function crearCita()
		{
			 $especialidad = $this->input->post('especialidad');
			 $paciente = $this->input->post('paciente');
			 $fechaInicio = $this->input->post('fechaInicio');
			 $fechaFin =  $this->input->post('fechaFin');
			 
			 $dataForm = array('Paciente'=>$paciente, 'Especialidad'=>$especialidad,
    							'FechaIni'=>$fechaInicio, 'FechaFin'=>$fechaFin);
    							
    		 $this->PacienteModel->guardarCita($dataForm);
		}
		
		//fin funciones para crear citas
				
		function consultarCita()
		{
			$data['cita'] = $this->PacienteModel->getCitaPaciente($this->session->userdata('id'));
			$this->load->view('Paciente/consultarCita', $data);
		}
		
		function verInforme()
		{
			$data['informe'] = $this->PacienteModel->getInforme($this->session->userdata('id'));
			$this->load->view('Paciente/verInforme', $data);
		}
		
	}
?>