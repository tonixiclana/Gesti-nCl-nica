<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/960.css" media="screen" />
		 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/text.css" media="screen" />
		 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/reset.css" media="screen" />
		 <style type="text/css">
		 	h1{
		 		font-size: 22px;
		 		text-align: center;
		 		margin: 20px 0px;
		 	}
		 	#login{
		 		background: #fefefe;
		 		min-height: 500px;
		 		text-align: center;
		 		margin-left: 30%;
		 		margin-right: 30%;
		 	}
		 	#formulario_login{
		 		font-size: 14px;
		 		border: 5px solid #191970;	
		 		text-align: center;
		 	}
		 	label{
		 		display: block;
		 		font-size: 16px;
		 		color: #333333;
		 		font-weight: bold;
		 		text-align: center;
		 	}
		 	input[type=text],input[type=password]{
		 		padding: 10px 6px;
		 		width: 400px;
		 		text-align: center;
		 	}
		 	input[type=submit]{
		 		padding: 5px 40px;
		 		background: #191970;
		 		color: #fff;
		 		border-radius: 10px;
		 		text-align: center;
		 	}
		 	#campos_login{
		 		margin: 50px 0px;
		 		text-align: center;
		 	}
		 	p{
		 		color: #f00;
		 		font-weight: bold;
		 		text-align: center;
		 	}
		 	#id{
		 		margin-left: 25%;
		 	}
		 </style>
	</head>
	<body>
	<?php
	$usuario = array('name' => 'usuario', 'placeholder' => 'Nombre de usuario');
	$password = array('name' => 'password',	'placeholder' => 'introduce tu password');
	$submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión');
	?>
	<div class="container_12">
		<h1>Formulario de login para Administrador</h1>
		<div class="grid_12" id="login">
			<div class="grid_8 push_2" id="formulario_login">
				<div class="grid_6 push_1" id="campos_login">
					<?=form_open(base_url().'Login/LoginAdmin')?>
					<label for="usuario">Usuario:</label>
					<?=form_input($usuario)?><p><?=form_error('usuario')?></p>
					<p>Usuario: admin</p>
					<label for="password">Introduce tu password:</label>
					<?=form_password($password)?><p><?=form_error('password')?></p> 
					<p>Pass: admin</p>
					<?=form_hidden('token',$token)?>
					<?=form_submit($submit)?>
					<?=form_close()?>
					<?php 
					if($this->session->flashdata('admin_incorrecto'))
					{
					?>
					<p><?=$this->session->flashdata('admin_incorrecto')?></p>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>