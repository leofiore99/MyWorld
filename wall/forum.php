<?php
error_reporting(0);
include_once 'includes/db.php';
include_once 'includes/functions.php';
include_once 'includes/tolink.php';
include_once 'includes/time_stamp.php';
include_once 'session.php';

//include '../conexao.php';
date_default_timezone_set('America/Sao_Paulo');
// A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();
      
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: ../index.html"); exit;
}

$foto = $_SESSION['UsuarioFoto'];
$Wall = new Wall_Updates();
$updatesarray=$Wall->Updates($uid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=devidev-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>My World - Juntos somos fortes</title>
		<!-- [ FONT-AWESOME ICON ]
	        =========================================================================================================================-->
		<link rel="stylesheet" type="text/css" href="../library/font-awesome-4.3.0/css/font-awesome.min.css">

		<!-- [ PLUGIN STYLESHEET ]
	        =========================================================================================================================-->
		<link rel="shortcut icon" type="image/x-icon" href="../images/icon.png">
		<link rel="stylesheet" type="text/css" href="../css/animate.css">
		<link rel="stylesheet" type="text/css" href="../css/owl.carousel.css">
	        <link rel="stylesheet" type="text/css" href="../css/owl.theme.css">
		<link rel="stylesheet" type="text/css" href="../css/magnific-popup.css">
		<!-- [ Boot STYLESHEET ]
	        =========================================================================================================================-->
		<link rel="stylesheet" type="text/css" href="../library/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="../library/bootstrap/css/bootstrap.css">
	        <!-- [ DEFAULT STYLESHEET ]
	        =========================================================================================================================-->
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	    <link rel="stylesheet" type="text/css" href="../css/responsive.css">
		<link rel="stylesheet" type="text/css" href="../css/color/yellow.css">
		
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/wall.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
 <script type="text/javascript" src="js/jquery.oembed.js"></script>
 <script type="text/javascript" src="js/wall.js"></script>
</head>
<body>

<nav  class=" ramsh-menu navbar navbar-default navbar-fixed-top">
<div class="container">
	        <!-- Brand and toggle get grouped for better mobile display -->
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
				<a class="navbar-brand" href="../perfil.php"><?php echo "<img style='width:auto; height:260%; margin-top:-15px' src='../fotos/$foto' /><br />";?></a>
				<a href="../perfil.php" class="navbar-brand2"><u><?php echo $_SESSION['UsuarioNome']; ?></u></a>


	        </div>
			<a class="navbar-brand" href="../index.html" style="margin-left:180px"> Convide um amigo</a>
	        <!-- Collect the nav links, forms, and other content for toggling -->
	        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	          <ul class="nav navbar-nav navbar-right">

	            <li><a href="#portfolio" class="page-scroll">Portfolio</a></li>
	            <li><a href="#testimonial-s" class="page-scroll">Testimonials</a></li>
	            <li><a href="#contact" class="page-scroll">Contact</a></li>
	          </ul>
	        </div><!-- /.navbar-collapse -->
	      </div><!-- /.container-fluid -->
 </nav>
<section class="main-heading-cadastro text-center"" id="home">  
	<div id="wall_container">
		<div id="updateboxarea">
			<h4 style="color:black">What's up?</h4>
			<form method="post" action="">
				<textarea style="color:black" cols="30" rows="4" name="update" id="update" maxlength="200" ></textarea>
				<br />
				<input type="submit" value="Postar"  id="update_button" class="update_button btn btn-primary black-background"/>
			</form>
		</div>
		<div id='flashmessage'>
			<div id="flash" align="left"  ></div>
		</div>
		<div id="content">

			<?php include('load_messages.php'); ?>

		</div>
	</div>
</section>

<!-- [FOOTER]
	 ============================================================================================================================-->
	 <footer class="footer">
	        <div class="container">
	            <div class="pull-left fnav">
	                <p>ALL RIGHTS RESERVED. COPYRIGHT © 2014. Designed by <a href="http://www.your-plugin.com" class="themecolor">YOUR PLUGIN</a></p>
	            </div>
	            <div class="pull-right fnav">
	                <ul class="footer-social">
	                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
	                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
	                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
	                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
	                </ul>
	            </div>
	        </div>
	    </footer>


	 <!-- [/FOOTER]
	 ============================================================================================================================-->
</body>
</html>
