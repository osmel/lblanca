<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es_MX">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LBlanca</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<?php echo link_tag('css/sistema.css'); ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div id="foo"></div>
		<header class="row sc">
			
				
				<div class="container header-content">

					<div class="col-md-3 col-sm-6 col-xs-6 logo">
						<a href="<?php echo base_url(); ?>">
							<!-- <img src="img/logo.png" class="image-responsive">  -->
						</a>
					</div>

					<div class="col-md-3 col-md-offset-6 col-sm-6 col-xs-6">
						<div class="header-titulo text-right">Servicio Especializado en Línea Blanca</div>
						<div class="text-right usuario"> Bienvenid@: <a href="<?php echo base_url(); ?>actualizar_perfil"><?php echo $this->session->userdata( 'nombre_completo' ); ?></a></div>
					</div>

				</div>

				<?php $this->load->view( 'navbar' ); ?>
			
			<div class="barra-verde"></div>
		</header>
	</div>
	<div class="container">
		<div class="row-fluid" id="wrapper">
			<div class="alert" id="messages"></div>