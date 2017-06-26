<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class Especialista extends CI_Controller 
	{
		public function __construct()
        {
            parent::__construct();
    		$this->load->library(array('session','form_validation'));
    		$this->load->helper(array('url','form'));
    		$this->load->database('default');
    		$this->load->model('EspecialistaModel');

    		//Si no se esta logueado como especialista redireccionamos al login de especialista
    		if($this->session->userdata('rol') != 'especialista') redirect(base_url().'login');
    		
        }
        
		function index()
		{
			//cargo el helper de url, con funciones para trabajo con URL del sitio
			$this->load->helper('url');

			$this->load->model('EspecialistaModel');

			//pido los ultimos artículos al modelo
			$ultimosArticulos = $this->EspecialistaModel->getEspecialista();

			//creo el array con datos de configuración para la vista
			$datos_vista = array('rs_Paciente' => $ultimosArticulos);

			//cargo la vista pasando los datos de configuacion
			$this->load->view('Especialista/HomeEspecialista', $datos_vista);
		}
		
		function crearInforme() {
			if($this->input->post('idCita') != NULL && 
				$this->input->post('informe') != NULL)
			{
				$idCita = $this->input->post('idCita');
				$informe = $this->input->post('informe');
				$dataForm = array('Descripcion'=>$informe);
				$this->EspecialistaModel->guardarFormularioInforme($idCita, $dataForm);
				$dataForm = array('Informe'=>$this->db->insert_id());
				$this->EspecialistaModel->actualizarCitaEspecialista($idCita, $dataForm);
			}elseif($this->input->post('idCita') != NULL){
				$data['idCita'] = $this->input->post('idCita');
				$this->load->view('Especialista/CrearInforme', $data);
			}
		}
		
		function verInforme() {
			$this->load->view('Especialista/VerInforme');	
		}
		
		function mostrarInformePaciente() {
				if($this->input->post('dni') !=NULL) {
					$dni = $this->input->post('dni');
	    			$data['informe'] = $this->EspecialistaModel->getInforme($dni);
	    			$this->load->view('Especialista/MostrarInformePaciente', $data);
				} else {
					$this->load->view('Especialista/VerInforme');
				}
		}
	
		
		function crearPaciente() {
		
			if($this->input->post('dni') != NULL) {
				 $dni = $this->input->post('dni');
    			 $nombre = $this->input->post('nombre');
    			 $apellido1 = $this->input->post('apellido1');
    			 $apellido2 = $this->input->post('apellido2');
    			 $telefono = $this->input->post('telefono');
    			 $direccion = $this->input->post('direccion');
    			 $dataForm = array('Dni'=>$dni,'Nombre'=>$nombre,
    							'Apellido1'=>$apellido1, 'Apellido2'=>$apellido2,
    							'Telefono' =>$telefono, 'Direccion'=>$direccion);
    							
    			 $this->EspecialistaModel->guardarFormularioPaciente($dataForm);
			}else{
				$this->load->view('Especialista/CrearPaciente');
			}
		
		}
		
		function verPaciente() {
			if($this->input->post('dni') !=NULL) {
				$dni = $this->input->post('dni');
    			$data['paciente'] = $this->EspecialistaModel->getPaciente($dni);
    			$this->load->view('Especialista/VerPaciente', $data);
			}else{
				$this->load->view('Especialista/VerPaciente');
			}	
		}
		
		function listarPaciente() {
			$paciente = $this->EspecialistaModel->getPaciente(NULL);
    		echo '<select class="form-control" id="paciente">';
	        foreach($paciente as $row)
	        { 
	          echo '<option id="paciente" value="'.$row->Id.'">'.$row->Dni.', 
	        	'.$row->Nombre.', '.$row->Apellido1.'</option>';
	        }
			echo '</select>';
		}

		function borrarPaciente() {
			$this->load->model('EspecialistaModel');
			$id = $this->input->post('id');
			$this->EspecialistaModel->borrarPaciente($id);
		}
		
		function modificarPaciente() {
				$id = $this->input->post('id');
				$dni = $this->input->post('dni');
	    		$nombre = $this->input->post('nombre');
	    		$apellido1 = $this->input->post('apellido1');
	    		$apellido2 = $this->input->post('apellido2');
	    		$telefono = $this->input->post('telefono');
	    		$direccion = $this->input->post('direccion');
	    		$dataForm = array('Dni'=>$dni,'Nombre'=>$nombre,
	    							'Apellido1'=>$apellido1, 'Apellido2'=>$apellido2,
	    							'Telefono' =>$telefono, 'Direccion'=>$direccion);
	    							
	    		$this->EspecialistaModel->modificarPaciente($dataForm, $id);
		}
		
		function asignarEspecialista() {
			if($this->input->post('id') !=NULL) {
				$id = $this->input->post('id');
				$especialistas = $this->EspecialistaModel->getEspecialista();
				
				echo '<select class="form-control">';
				foreach ($especialistas as $e) {
					 echo '<option id="especialista" value="'.$e['Id'].'">'.$e['Nombre'].'</option>';
				}
				echo '</select>';
				echo'<input title="Enviar" type="submit" class="btn btn-default" 
				onclick="actualizarCitaEspecialista('.$id.')">';
				
			}else{
				$data['citas'] = $this->EspecialistaModel->listarCitas();
				$this->load->view('Especialista/AsignarEspecialista', $data);
			}

		}
		
		function actualizarCitaEspecialista() {
			$idCita = $this->input->post('idCita');
			$idEspecialista = $this->input->post('idEspecialista');
			$dataForm = array('Especialista'=>$idEspecialista);
			$this->EspecialistaModel->actualizarCitaEspecialista($idCita, $dataForm);
		}
		
		function consultarCitas() {
			$idEspecialista=$this->session->userdata('id');
			$data['citas']=$this->EspecialistaModel->consultarCitas($idEspecialista);
			$this->load->view('Especialista/VerCitas',$data);
			
		}
		
		
	}
	
?>