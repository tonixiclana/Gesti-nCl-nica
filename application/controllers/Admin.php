<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class Admin extends CI_Controller 
	{
		public function __construct()
        {
            parent::__construct();
    		$this->load->library(array('session','form_validation'));
    		$this->load->helper(array('url','form'));
    		$this->load->database('default');
			$this->load->model('AdminModel');
			$this->load->model('FuncionesComunesModel');
    		//si no tengo el rol de Admin
    		if($this->session->userdata('rol') != 'admin') redirect(base_url().'loginAdmin');
        }
        
		function index()
		{
			$this->load->view('Admin/HomeAdmin');
		}
		
		function crearEspecialista()
		{
			if($this->input->post('dni') != NULL) {
				 $dni = $this->input->post('dni');
    			 $nombre = $this->input->post('nombre');
    			 $apellido1 = $this->input->post('apellido1');
    			 $apellido2 = $this->input->post('apellido2');
    			 $password = sha1($this->input->post('password'));
    			 $direccion = $this->input->post('direccion');
    			 $especialidad = $this->input->post('especialidad');
    			 $dataForm = array('Dni'=>$dni,'Nombre'=>$nombre,
    							'Apellido1'=>$apellido1, 'Apellido2'=>$apellido2,
    							'Password' =>$password, 'Especialidad'=>$especialidad);
    							
    			 $this->AdminModel->crearEspecialista($dataForm);
			}else{
				$data['especialidad'] = $this->FuncionesComunesModel->getTipoEspecialidad();
				$this->load->view('Admin/CrearEspecialista', $data);
			}
	
		}
		
		function verEspecialista() {
			if($this->input->post('dni') !=NULL) {
				$dni = $this->input->post('dni');
    			$data['especialista'] = $this->AdminModel->getEspecialista($dni);
    			$this->load->view('Admin/VerEspecialista', $data);
    			
			}else{
				$this->load->view('Admin/VerEspecialista');
			}
		}
		
		function modificarEspecialista() {
			$dni = $this->input->post('dni');
    		$nombre = $this->input->post('nombre');
    		$apellido1 = $this->input->post('apellido1');
    		$apellido2 = $this->input->post('apellido2');
    		$password = sha1($this->input->post('password'));
    		$dataForm = array('Nombre'=>$nombre,
    							'Apellido1'=>$apellido1, 'Apellido2'=>$apellido2,
    							'Password' =>$password);
				$this->AdminModel->modificarEspecialista($dataForm,$dni);
		}
		
		function borrarEspecialista() {
			$this->load->model('AdminModel');
			$dni = $this->input->post('dni');
			$this->AdminModel->borrarEspecialista($dni);
		}
	}
?>