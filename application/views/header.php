<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" context="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Aplikasi Inventarisasi Perangkat TIK</title>
    <meta name="description" content="">
	<link href="<?=base_url()?>public/bootstrap/plugins/bootstrap/bootstrap.css" rel="stylesheet">
	<link href="<?=base_url()?>public/bootstrap/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
	<link href="<?=base_url()?>public/bootstrap/css/font-awesome.min.css" rel="stylesheet">
	<!-- <link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'> -->
	<link href="<?=base_url()?>public/bootstrap/plugins/fancybox/jquery.fancybox.css" rel="stylesheet">
	<link href="<?=base_url()?>public/bootstrap/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
	<link href="<?=base_url()?>public/bootstrap/plugins/xcharts/xcharts.min.css" rel="stylesheet">
	<link href="<?=base_url()?>public/bootstrap/plugins/select2/select2.css" rel="stylesheet">
	<link href="<?=base_url()?>public/bootstrap/plugins/justified-gallery/justifiedGallery.css" rel="stylesheet">
	<link href="<?=base_url()?>public/bootstrap/css/style_v1.css" rel="stylesheet">
	<link href="<?=base_url()?>public/bootstrap/plugins/chartist/chartist.min.css" rel="stylesheet">

</head>
<body>
	<header class="navbar">
		<div class="container-fluid expanded-panel">
			<div class="row">
				<div id="logo" class="col-xs-12 col-sm-2">
					<a >SIMONTIK</a>
				</div>
				<div id="top-panel" class="col-xs-12 col-sm-10">
					<div class="row">
						<div class="col-xs-4 col-sm-8 top-panel-right pull-right">
							<ul class="nav navbar-nav pull-right panel-menu">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
										<span class="glyphicon glyphicon-angle-down pull-right"></span>
										<div class="user-mini pull-right">
											<span class="welcome">Selamat Datang,</span>
											<span><?php if(isset($kantor)){ echo $kantor;}  ?></span>
											<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
										</div>
									</a>
									<ul class="dropdown-menu">
										<!-- <li>
											<a href="#">
												<i class="fa fa-user"></i>
												<span>Profil</span>
											</a>
										</li> -->
										<li>
											<a href="<?php echo site_url('login/logout'); ?>">
												<span class="glyphicon glyphicon-off"></span>
												<span>Logout</span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php
		$ses=$this->session->userdata['logged_in'];
		$admine=$ses['admin'];
	?>
	<div id="main" class="container-fluid">
		<div class="row">
			<div id="sidebar-left" class="col-xs-2 col-sm-2">
				<ul class="nav main-menu">
					<li>
						<a href="<?php echo site_url('monitoring'); ?>" >
							<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
							<span class="hidden-xs">Home</span>
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">
							<span class="glyphicon glyphicon-hdd" aria-hidden="true"></span>
							<span class="hidden-xs">Hardware </span>
						</a>
						<ul class="dropdown-menu">
							<li><a  href="<?php echo site_url('bmn/show/1'); ?>">BMN</a></li>
							<li><a  href="<?php echo site_url('server/show/1'); ?>">Server</a></li>
							<li><a  href="<?php echo site_url('server/show/2'); ?>">PC</a></li>
							<li><a  href="<?php echo site_url('server/show/3'); ?>">Notebook</a></li>
							<li><a  href="<?php echo site_url('server/show/6'); ?>">Printer</a></li>
							<li><a  href="<?php echo site_url('server/show/7'); ?>">Proyektor</a></li>
							<li><a  href="<?php echo site_url('server/show/8'); ?>">Scanner</a></li>
							<li><a  href="<?php echo site_url('server/show/10'); ?>">Lainnya</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">
							<span class="glyphicon glyphicon-cloud" aria-hidden="true"></span>
							 <span class="hidden-xs">Jaringan</span>
						</a>
						<ul class="dropdown-menu">
							<li><a  href="<?php echo site_url('jaringan/show/4'); ?>">Router</a></li>
							<li><a  href="<?php echo site_url('jaringan/show/5'); ?>">Switch</a></li>
							<li><a  href="<?php echo site_url('jaringan/show/9'); ?>">Modem</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">
							<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
							 <span class="hidden-xs">Laporan</span>
						</a>
						<ul class="dropdown-menu">
							<li><a  href="<?php echo site_url('laporan/show/1'); ?>">Per Jenis</a></li>
							<li><a  href="<?php echo site_url('laporan/show/2'); ?>">Per Tahun</a></li>
							<?php
							if($admine==1){
							?>
							<li><a  href="<?php echo site_url('laporan/show/3'); ?>">Per KPPN</a></li>
							<li><a  href="<?php echo site_url('laporan/show/4'); ?>">Per Kanwil</a></li>
							<?php
							}
							?>
							<li><a  href="<?php echo site_url('laporan/show/5'); ?>">Per Kondisi</a></li>
							<?php
							if($admine==1){
							?>
							
							<li><a  href="<?php echo site_url('laporan/show/6'); ?>">Summary</a></li>
							<?php
							}
							?>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">
							<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
							 <span class="hidden-xs">Helpdesk</span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo site_url('tiket/show'); ?>">Ticket</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
							 <span class="hidden-xs">Pengaturan</span>
						</a>
						<ul class="dropdown-menu">
							<?php
							if($admine==1){
							?>
							<li><a href="<?php echo site_url('pengaturan'); ?>">Rekam User</a></li>
							<?php
							}
							?>
							<li><a href="<?php echo site_url('pengaturan/ubahPass'); ?>">Ubah Password</a></li>
							<li><a href="<?php echo site_url('pengaturan/ttd'); ?>">Rekam Penandatangan</a></li>
							<li><a href="<?php echo site_url('pengaturan/ubahttd'); ?>">Ubah Penandatangan</a></li>
							<?php
							if($admine==1){
							?>
							<li><a href="<?php echo site_url('berita/show/1'); ?>">Pengumuman</a></li>
							<li><a href="<?php echo site_url('merk/show/1'); ?>">Merk</a></li>
							<?php
							}
							?>
						</ul>
					</li>
					
					<!--  <liclass="dropdown">
						<a href="#" class="dropdown-toggle">
							<i class="fa fa-picture-o"></i>
							 <span class="hidden-xs">Multilevel menu</span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#">First level menu</a></li>
							<li><a href="#">First level menu</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle">
									<i class="fa fa-plus-square"></i>
									<span class="hidden-xs">Second level menu group</span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Second level menu</a></li>
									<li><a href="#">Second level menu</a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle">
											<i class="fa fa-plus-square"></i>
											<span class="hidden-xs">Three level menu group</span>
										</a>
										<ul class="dropdown-menu">
											<li><a href="#">Three level menu</a></li>
											<li><a href="#">Three level menu</a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle">
													<i class="fa fa-plus-square"></i>
													<span class="hidden-xs">Four level menu group</span>
												</a>
												<ul class="dropdown-menu">
													<li><a href="#">Four level menu</a></li>
													<li><a href="#">Four level menu</a></li>
													<li class="dropdown">
														<a href="#" class="dropdown-toggle">
															<i class="fa fa-plus-square"></i>
															<span class="hidden-xs">Five level menu group</span>
														</a>
														<ul class="dropdown-menu">
															<li><a href="#">Five level menu</a></li>
															<li><a href="#">Five level menu</a></li>
															<li class="dropdown">
																<a href="#" class="dropdown-toggle">
																	<i class="fa fa-plus-square"></i>
																	<span class="hidden-xs">Six level menu group</span>
																</a>
																<ul class="dropdown-menu">
																	<li><a href="#">Six level menu</a></li>
																	<li><a href="#">Six level menu</a></li>
																</ul>
															</li>
														</ul>
													</li>
												</ul>
											</li>
											<li><a href="#">Three level menu</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li> -->
				</ul>
			</div>
			<!--Start Content-->
<div id="content" class="col-xs-12 col-sm-10">
			
