<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class FuncionesComunes extends CI_Controller 
	{
		public function __construct()
        {
            parent::__construct();
    		$this->load->library(array('session','form_validation'));
    		$this->load->helper(array('url','form'));
    		$this->load->model('FuncionesComunesModel');
    		
    		$this->load->database('default');
    		//si no tengo el rol de paciente
    		if(!$this->session->userdata("isLoguedIn")) redirect(base_url());
        }
        
		function index()
		{
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
			
			$data['especialidad'] = $this->FuncionesComunesModel->getTipoEspecialidad();
			
			//obtendo el primer dia del mes y el ultimo
			$fecha = date('Y-m-j',mktime(0, 0, 0, $mes, 1, $year));
			$fechaFin = strtotime ( '+1 month' , strtotime ( $fecha ) ) ;
			$fechaFin = date ( 'Y-m-j' , $fechaFin );
			
			$diasSemana = $this->FuncionesComunesModel->getCalendario();
			$cont = 0;
			foreach ($diasSemana as $value) {
				$diasSemanaArray[$cont] = $value->Dia;
				$cont++;
			}
			
			$cont = 1;
			for($i=strtotime($fecha); $i<strtotime($fechaFin); $i+=86400){
				if (in_array(date("N", $i), $diasSemanaArray) && time()<$i+86400) //comprobamos si el dia de la semana a comprobar esta en el horario
			    	$data['dias'][$cont] = "FuncionesComunes/listarCitasDisponibles/".date("d", $i)."/".date("m", $i)."/".date("Y", $i);
			    $cont++;
			}
			$cont = 1;
            
			    $this->load->view('FuncionesComunes/nuevaCita', $data);
		}

		function listarCitasDisponibles()
		{
			//Sacamos la hora de la url y calculamos el dia de la semana
			$datosVista['dia'] = $this->uri->segment(3);
			$datosVista['mes'] = $this->uri->segment(4);
			$datosVista['year'] = $this->uri->segment(5);
			$diaDeLaSemana = date('N',mktime(0, 0, 0, $datosVista['mes'], 
			    $datosVista['dia'], $datosVista['year']));
			
			//Obetenemos los arrays de horarios del dia de la semana concreto
			$diasSemana = $this->FuncionesComunesModel->getCalendario();
			foreach ($diasSemana as $value) {
				if($diaDeLaSemana == $value->Dia)
				{
					$horaInicio = explode(':', $value->HoraInicio);
					$horaFin = explode(':', $value->HoraFin);
					$datosVista['duracionCita'][] = $value->DuracionCita;
				    $datosVista['unixInicio'][] = mktime($horaInicio[0], 
				        $horaInicio[1], 0, $datosVista['mes'], $datosVista['dia'], 
				        $datosVista['year']);
					$datosVista['unixFin'][] = mktime($horaFin[0],
					    $horaFin[1], 0, $datosVista['mes'], $datosVista['dia'], 
					    $datosVista['year']);
				}
			}
			
			//Comprobamos las citas planificadas para el dia concreto
			$data = $this->FuncionesComunesModel->getCitasDisponibles($datosVista['dia'], 
			    $datosVista['mes'], $datosVista['year']);
			foreach ($data as $value) {
				$aux =  explode(" ", $value->FechaIni);
				$aux = $aux[1];
				$aux = explode(":", $aux);
		        $datosVista['hora'][] = $aux[0];
				$datosVista['min'][] = $aux[1];
			}
			
			//Si no hay ninguna cita se ponen los arrays fuera de rango
			if(!isset($hora) && !isset($min))
			{
				$datosVista['hora'][0] = -1;
				$datosVista['min'][0] = -1;
			}
            
            if($this->session->userdata['rol'] == 'paciente' )
			    $this->load->view('Paciente/ListarCitasDisponibles', $datosVista);
		    elseif($this->session->userdata['rol'] == 'especialista' )
		    {
		    	$this->load->view('Especialista/ListarCitasDisponibles', $datosVista);	
		    }

		}
		
		function crearCita()
		{
			 $especialidad = $this->input->post('especialidad');
			 $paciente = $this->input->post('paciente');
			 $fechaInicio = $this->input->post('fechaInicio');
			 $fechaFin =  $this->input->post('fechaFin');
			 
			 $dataForm = array('Paciente'=>$paciente, 'Especialidad'=>$especialidad,
    							'FechaIni'=>$fechaInicio, 'FechaFin'=>$fechaFin);
    							
    		 $this->FuncionesComunesModel->guardarCita($dataForm);
		}
		
		//fin funciones para crear citas
				
	}
?>