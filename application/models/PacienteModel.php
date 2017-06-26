<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class PacienteModel extends CI_Model 
	{
		function __construct()
		{
			parent::__construct();
		}
		function getPaciente()
		{
			$this->load->database();
			$ssql = "select * from Paciente";
			return $this->db->query($ssql)->result_array();
		}

		function getCitaPaciente($id_paciente)
		{
			$this->load->database();
			$hoy = date('Y-m-d');
			$ssql = "SELECT FechaIni, FechaFin, TipoEspecialidad.Nombre 
				FROM Cita, TipoEspecialidad
				WHERE Cita.Especialidad = TipoEspecialidad.Id AND $id_paciente = Cita.Paciente
				AND Cita.FechaIni > '{$hoy}'";
			return $this->db->query($ssql)->result();
		}
		
		
		function getInforme($id_paciente)
		{
			$this->load->database();
			$ssql = "SELECT Informe.Descripcion, Cita.FechaIni, TipoEspecialidad.Nombre 
				FROM Informe, Cita, TipoEspecialidad
				WHERE Cita.Especialidad = TipoEspecialidad.Id AND Informe.Id = Cita.Informe AND Cita.Paciente = $id_paciente";
			return $this->db->query($ssql)->result();
		}
	}
?>