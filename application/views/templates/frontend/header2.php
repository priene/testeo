<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>
<html lang="es-ES">
<head>
<title>Ranas Rojas - <?php echo $titulo; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Ranas Rojas">
<meta name="keywords" content="Ranas Rojas">
<link href="<?php echo base_url("assets/img/favicon.ico") ?>" rel="icon" type="image/x-icon" />
<link href="<?php echo base_url("assets/css/bootstrap.min.css") ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url("assets/css/animate.css") ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url("assets/css/normalize.css") ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url("assets/css/jquery-ui.css") ?>" rel="stylesheet" media="screen">
<link href='http://fonts.googleapis.com/css?family=Montserrat+Alternates:400,700' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url("assets/css/animsition.min.css") ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url("assets/css/standalone.css") ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url("assets/css/jquery-clockpicker.min.css") ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url("assets/css/estilos.css") ?>" rel="stylesheet" media="screen">
<link href="<?php echo base_url("assets/css/fancybox.css") ?>" rel="stylesheet" media="screen">
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
<body class="animsition">

	<div class="contenedor users menulogin">

	<div class="navuser col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<p>Admin Ranas Rojas</p>
		<p>Cerrar sesión</p>
	</div>

	<div class="row">
		<div class="menuprincipal col-lg-2 col-md-2 col-sm-2 col-xs-2" role="navigation">
			<ul>
				<li>
					<a href="<?= site_url('menulogin') ?>">
					<div>
						<span>Inicio</span>
					</div>
					</a>
				</li>
				<li>
					<a href="<?= site_url('ingresar_fecha') ?>">
					<div>
						<span>Fecha</span>
					</div>
					</a>
				</li>
				<li>
					<a href="<?= site_url('ingresar_banda') ?>">
					<div>
						
						<span>Banda</span>
					</div>
					</a>
				</li>
				<li>
					<a href="<?= site_url('ingresar_lugar') ?>">
					<div>
						
						<span>Lugar</span>
					</div>
					</a>
				</li>
				<li>
					<a href="<?= site_url('ingresar_genero') ?>">
					<div>
						
						<span>Genero</span>
					</div>
					</a>
				</li>
			</ul>
		</div>
