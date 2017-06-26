<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class FuncionesComunesModel extends CI_Model 
	{
		function __construct()
		{
			parent::__construct();
		}

		//funciones para crear citas
        function getTipoEspecialidad()
		{
			$this->load->database();
			$ssql = "SELECT * FROM TipoEspecialidad";
			return $this->db->query($ssql)->result();
		}		
		
		function getCalendario()
		{
			$this->load->database();
			$ssql = "SELECT DISTINCT Dia, HoraInicio, HoraFin, DuracionCita FROM Calendario";
			return $this->db->query($ssql)->result();
			
		}
		
		function getCitasDisponibles($dia, $mes, $year)
		{
			$fecha = date('Ymd',mktime(0, 0, 0, $mes, $dia, $year));
			$unixFin = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
			$fechaFin = date ('Ymd', $unixFin );
			$this->load->database();
			$ssql = "SELECT FechaIni, FechaFin FROM Cita 
				WHERE FechaIni BETWEEN '$fecha' AND '$fechaFin'";
			return $this->db->query($ssql)->result();
		}
		
		function guardarCita($formData) {
			$this->load->database();
			$this->db->insert('Cita', $formData);
		
			if ($this->db->affected_rows() == '1') {
				echo '<div class="alert alert-success">
		            <strong>Cita creada correctamente</strong>.
		            </div>';
			}
			else{
				echo '<div class="alert alert-success">
		            <strong>Error al crear cita</strong>.
		            </div>';
			}
		}
		
		//fin funciones para crear citas
	}
?>