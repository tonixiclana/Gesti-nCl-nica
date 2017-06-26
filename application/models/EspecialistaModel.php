<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class EspecialistaModel extends CI_Model 
	{
		function __construct()
		{
			parent::__construct();
		}
		function getEspecialista()
		{
			$this->load->database();
			$ssql = "select * from Especialista";
			return $this->db->query($ssql)->result_array();
		}
		
		function getPaciente($dni) {
			if($dni != NULL)
			{
				$this->load->database();
				$ssql = "SELECT * FROM Paciente WHERE Dni like '$dni' ";
				return $this->db->query($ssql)->result();
			}else {
				$this->load->database();
				$ssql = "SELECT * FROM Paciente ORDER BY Apellido1 ";
				return $this->db->query($ssql)->result();
			}

		}
		
		function guardarFormularioPaciente($form_data) {
			$this->load->database();
			$this->db->insert('Paciente', $form_data);
		
			if ($this->db->affected_rows() == '1') {
				echo '<div class="alert alert-success">
		            <strong>Paciente creado correctamente</strong>.
		            </div>';
			}
			else{
				echo '<div class="alert alert-success">
		            <strong>Error al crear el paciente</strong>.
		            </div>';
			}
		}
		function guardarFormularioInforme($idCita, $form_data) {
			$this->load->database();
			$this->db->insert('Informe', $form_data);
		
			if ($this->db->affected_rows() == '1') {
				echo '<div class="alert alert-success">
		            <strong>Informe creado correctamente</strong>.
		            </div>';
			}
			else{
				echo '<div class="alert alert-success">
		            <strong>Error al crear Informe</strong>.
		            </div>';
			}
		}
		
		function borrarPaciente($id){
			$this->load->database();
			$this->db->where('Id',$id);
			$this->db->delete('Paciente');
			echo '<div class="alert alert-success">
	            <strong>El paciente ha sido borrado</strong>.
	            </div>';
		}
		
		function modificarPaciente($form_data, $id) {
			$this->load->database();
			$this->db->where('Id', $id);
			$this->db->update('Paciente', $form_data);
			
			if ($this->db->affected_rows() == '1') {
				echo '<div class="alert alert-success">
		            <strong>Paciente modificado correctamente</strong>.
		            </div>';
			}
			else{
				echo '<div class="alert alert-success">
		            <strong>Error al modificar el paciente</strong>.
		            </div>';
			}
		}
		
		function listarCitas() {
			$this->load->database();
			$ssql = "SELECT Cita.Id, Paciente.Dni, Paciente.Nombre, Paciente.Apellido1,
			Paciente.Apellido2, Cita.FechaIni, Cita.FechaFin, TipoEspecialidad.Nombre as 
			'NombreEspecialidad' FROM Cita, Paciente, TipoEspecialidad WHERE Cita.Paciente=Paciente.Id AND
			Cita.Especialidad=TipoEspecialidad.Id AND Especialista IS NULL AND
			FechaIni >= now() ORDER BY FechaIni ";
			return $this->db->query($ssql)->result();
		}
		
		function actualizarCitaEspecialista($id, $form_data) {
			$this->load->database();
			$this->db->where('Id', $id);
			$this->db->update('Cita', $form_data);
		
			if ($this->db->affected_rows() == '1') {
					echo '<div class="alert alert-success">
	            <strong>Cita Asignada correctamente</strong>.
	            </div>';
			}
			else{
				  echo '<div class="alert alert-success">
	            <strong>Ha habido un error al asignar la cita.</strong>
	            </div>';
			}
		}
		
		function consultarCitas($idEspecialista) {
			$this->load->database();
			$ssql = "SELECT Cita.Id, Paciente.Dni, Paciente.Nombre, Paciente.Apellido1,
			Paciente.Apellido2, Cita.FechaIni, Cita.FechaFin, TipoEspecialidad.Nombre as 
			'NombreEspecialidad', Cita.Informe FROM Cita, Paciente, TipoEspecialidad WHERE Cita.Paciente=Paciente.Id AND
			Cita.Especialidad=TipoEspecialidad.Id AND Especialista = $idEspecialista AND
			FechaIni >= now() ORDER BY FechaIni ";
			return $this->db->query($ssql)->result();
		}
		
		function getInforme($dniPaciente)
		{
			$this->load->database();
			$ssql = "SELECT Informe.Descripcion, Cita.FechaIni, TipoEspecialidad.Nombre 
				FROM Informe, Cita, TipoEspecialidad, Paciente
				WHERE Cita.Especialidad = TipoEspecialidad.Id AND Informe.Id = Cita.Informe AND 
				Cita.Paciente = Paciente.Id AND Paciente.Dni LIKE $dniPaciente";
			return $this->db->query($ssql)->result();
		}
		
	}
?>


