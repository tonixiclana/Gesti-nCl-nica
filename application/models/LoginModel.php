<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
	class LoginModel extends CI_Model 
	{
		function __construct()
		{
			parent::__construct();
		}
		
        public function LoginPaciente($dni)
    	{
    		$this->db->where('Dni',$dni);
    		$query = $this->db->get('Paciente');
    		if($query->num_rows() == 1)
    		{
    			return $query->row();
    		}else{
    			$this->session->set_flashdata('paciente_incorrecto','Los datos introducidos son incorrectos');
    			redirect(base_url(),'refresh');
    		}
    	}
    	
    	public function LoginEspecialista($dni, $password)
    	{
    		$this->db->where('Dni',$dni);
    		$this->db->where('Password',$password);
    		$query = $this->db->get('Especialista');
    		if($query->num_rows() == 1)
    		{
    			return $query->row();
    		}else{
    			$this->session->set_flashdata('especialista_incorrecto','Los datos introducidos son incorrectos');
    			redirect(base_url().'login','refresh');
    		}
    	}
    	
    	public function LoginAdmin($nombre, $password)
    	{
    		$this->db->where('Nombre',$nombre);
    		$this->db->where('Password',$password);
    		$query = $this->db->get('Admin');
    		if($query->num_rows() == 1)
    		{
    			return $query->row();
    		}else{
    			$this->session->set_flashdata('admin_incorrecto','Los datos introducidos son incorrectos');
    			redirect(base_url().'loginAdmin','refresh');
    		}
    	}
    }
?>