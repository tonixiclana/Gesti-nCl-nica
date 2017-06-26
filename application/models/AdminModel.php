<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class AdminModel extends CI_Model 
	{
		function __construct()
		{
			parent::__construct();
		}
		
		function getEspecialista($dni) {
		
			if($dni != NULL)
			{
				$this->load->database();
				$ssql = "SELECT *, Especialista.Nombre FROM Especialista, TipoEspecialidad WHERE Dni LIKE '$dni'
						AND Especialista.Especialidad = TipoEspecialidad.Id";
				return $this->db->query($ssql)->result();
				
			}else {
				$this->load->database();
				$ssql = "SELECT * FROM Especialista ORDER BY Apellido1 ";
				return $this->db->query($ssql)->result();
			}
		}
		
		function crearEspecialista($form_data) {
			$this->load->database();
			$this->db->insert('Especialista', $form_data);
		
			if ($this->db->affected_rows() == '1') {
				echo '<div class="alert alert-success">
		            <strong>Especialista creado correctamente</strong>.
		            </div>';
			}
			else{
				echo '<div class="alert alert-success">
		            <strong>Error al crear el especialista</strong>.
		            </div>';
			}
		}
		
		function modificarEspecialista($form_data,$dni) {
			$this->load->database();
			$this->db->where('Dni', $dni);
			$this->db->update('Especialista', $form_data);
			
			if ($this->db->affected_rows() == '1') {
				echo '<div class="alert alert-success">
		            <strong>Especialista modificado correctamente</strong>.
		            </div>';
			}
			else{
				echo '<div class="alert alert-success">
		            <strong>Error al modificar al especialista</strong>.
		            </div>';
			}
		}
		
		function borrarEspecialista($dni){
			$this->load->database();
			$this->db->where('Dni',$dni);
			$this->db->delete('Especialista');
			echo '<div class="alert alert-success">
	            <strong>El '.$dni. ' ha sido borrado</strong>.
	            </div>';
		}
	}
?>