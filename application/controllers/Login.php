<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class Login extends CI_Controller 
	{
    	public function __construct()
        {
            parent::__construct();
    		$this->load->model('LoginModel');
    		$this->load->library(array('session','form_validation'));
    		$this->load->helper(array('url','form'));
    		$this->load->database('default');
        }

		function index()
		{   
			//Si está logueado se manda al home correspondiente
			if($this->session->has_userdata('isLoguedIn'))
			{
			    if($this->session->userdata('rol') == 'paciente')
			        redirect(base_url().'paciente');
			    else
			    if($this->session->userdata('rol') == 'admin')
			    	redirect(base_url().'admin');
			    else
			        redirect(base_url().'especialista');
			}
			//Si no esta logueado se manda al formulario correspondiente
			else
			if($this->uri->segment(1) == 'login')
    		{
    		    $data['token'] = $this->token();
    			$this->load->view('Especialista/LoginEspecialista', $data);
    		}
    		else
    		if($this->uri->segment(1) == 'loginAdmin')
    		{
    		    $data['token'] = $this->token();
    			$this->load->view('Admin/LoginAdmin', $data);
    		}
    		else
			if($this->uri->segment(1) == null)
			{
			    $data['token'] = $this->token();
    			$this->load->view('Paciente/LoginPaciente', $data);
			}
		}
		
		function LoginPaciente()
		{
		    if($this->session->has_userdata('isLoguedIn'))
		    {
		        redirect(base_url());
    			//}
        	}else{
                if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
    		    {
                //$this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
                //$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[150]|xss_clean');
     
                //lanzamos mensajes de error si es que los hay
                
    			//if($this->form_validation->run() == FALSE)
    			//{
    				//$this->index();
    			//}else{
    				$dni = $this->input->post('dni');
    				$password = sha1($this->input->post('password'));
    				$check_user = $this->LoginModel->LoginPaciente($dni);
    				if($check_user == TRUE)
    				{
    					$data = array(
        	                'isLoguedIn' 	=> 		TRUE,
        	                'nombre' 		=> 		$check_user->Nombre,
        	                'id' 		=> 		$check_user->Id,
        	                'rol'           =>      'paciente'
                		);		
    					$this->session->set_userdata($data);
    					redirect(base_url().'paciente');
    				}else
            			redirect(base_url());
        		}
		    }
		}
		
		function LoginEspecialista()
		{
		    if($this->session->has_userdata('isLoguedIn'))
		    {
		        redirect(base_url().'login');
    			//}
        	}else{
        		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
    		    {
                //$this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
                //$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[150]|xss_clean');
     
                //lanzamos mensajes de error si es que los hay
                
    			//if($this->form_validation->run() == FALSE)
    			//{
    				//$this->index();
    			//}else{
    				$dni = $this->input->post('dni');
    				$password = sha1($this->input->post('password'));
    				$check_user = $this->LoginModel->LoginEspecialista($dni, $password);
    				if($check_user == TRUE)
    				{
    					$data = array(
        	                'isLoguedIn' 	=> 		TRUE,
        	                'nombre' 		=> 		$check_user->Nombre,
        	                'id' 			=> 		$check_user->Id,
        	                'rol'           =>      'especialista'
                		);		
    					$this->session->set_userdata($data);
    					redirect(base_url().'especialista');
    				}else
            			redirect(base_url());
        		}
		    }
		}
		
		public function LoginAdmin()
		{
			if($this->session->has_userdata('isLoguedIn'))
		    {
		        redirect(base_url().'admin');
    			//}
        	}else{
                if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
    		    {
    				$usuario = $this->input->post('usuario');
    				$password = sha1($this->input->post('password'));
    				$check_user = $this->LoginModel->LoginAdmin($usuario, $password);
    				if($check_user == TRUE)
    				{
    					$data = array(
        	                'isLoguedIn' 	=> 		TRUE,
        	                'nombre' 		=> 		$check_user->Nombre,
        	                'rol'           =>      'admin'
                		);		
    					$this->session->set_userdata($data);
    					redirect(base_url().'admin');
    				}else
            			redirect(base_url().'loginAdmin');
        		}
		    }
		}
		
    	public function token()
    	{
    		$token = md5(uniqid(rand(),true));
    		$this->session->set_userdata('token',$token);
    		return $token;
    	}
    	
    	public function Logout()
    	{
    		$this->session->sess_destroy();
    		redirect(base_url());
    	}
	}
?>