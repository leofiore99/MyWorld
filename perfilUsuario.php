<?php
date_default_timezone_set('America/Sao_Paulo');
// A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();
      
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: index.html"); exit;
}
error_reporting(0);
include_once 'wall/includes/db.php';
include_once 'wall/includes/functions.php';
include_once 'wall/includes/tolink.php';
include_once 'wall/includes/time_stamp.php';
include_once 'wall/session.php';

$id = $_GET['id'];

$query_select = mysql_query("SELECT nome FROM usuario WHERE id_usuario = '$id'") or die("erro ao selecionar");
$resultado = mysql_fetch_assoc($query_select);
$nomeUsuario = $resultado['nome'];

$Wall = new Wall_Updates();
$updatesarray=$Wall->UpdatesPerfil($id);
?>
<!DOCTYPE>
<!--
++++++++++++++++++++++++++++++++++++++++++++++++++++++
AUTHOR : Vijayan PP
PROJECT :RAMSH
VERSION : 1.1
++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->

<html>
<head>
 
	<meta charset="utf-8">
	<meta name="viewport" content="width=devidev-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="wall/css/wall.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
 <script type="text/javascript" src="wall/js/jquery.oembed.js"></script>
 <script type="text/javascript" src="wall/js/wall.js"></script>
	<title>My World - Juntos somos fortes</title>
	
	<!-- [ FONT-AWESOME ICON ] 
        =========================================================================================================================-->
	<link rel="stylesheet" type="text/css" href="library/font-awesome-4.3.0/css/font-awesome.min.css">

	<!-- [ PLUGIN STYLESHEET ]
        =========================================================================================================================-->
	<link rel="shortcut icon" type="image/x-icon" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="css/owl.theme.css">
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
	<!-- [ Boot STYLESHEET ]
        =========================================================================================================================-->
	<link rel="stylesheet" type="text/css" href="library/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="library/bootstrap/css/bootstrap.css">
        <!-- [ DEFAULT STYLESHEET ] 
        =========================================================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/color/yellow.css">
        
</head>
<body >
<!-- [ LOADERs ]
================================================================================================================================-->	
 
<!-- [ /PRELOADER ]
=============================================================================================================================-->
<!-- [WRAPPER ]
=============================================================================================================================-->
<div>
  <!-- [NAV]
 ============================================================================================================================-->    
   <!-- Navigation
    ==========================================-->
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
			<a href="index.html"><img style="width:80px; height:50px; margin-left:-80px" src="images/teste2.jpg"/></a>
			<a href="#portfolio" class="page-scroll">Meu Perfil</a>
            
			
        </div>
		<a class="navbar-brand" href="index.html" style="margin-left:370px"> Convide um amigo</a>
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


   <!-- [/NAV]
 ============================================================================================================================--> 
    
   <!-- [/MAIN-HEADING]
 ============================================================================================================================--> 
    <section class="main-heading-cadastro text-center"" id="home">
       <div class="overlay">
	   
        <div class="container ">
		<h2>Usuário: <?php echo $nomeUsuario?> </h2>
            <div class="row">
                <div class="col-md-12 col-sm-12">
				<!-- Criando a listagem -->
					<div class="tabs-container">
    
						<!-- ABA 1 -->
						<input type="radio" name="tabs" class="tabs" id="tab1" checked>
						<label for="tab1">Tópicos</label>
						<div style="height:auto;">
							  <section class="" id="home">  
								<div id="wall_container_perfil">
									<div id='flashmessage'>
										<div id="flash" align="left"  ></div>
									</div>
									<div id="content">

										<?php include('wall/load_messages_perfil.php'); ?>

									</div>
								</div>
							</section>
						</div>
						
						<!-- ABA 2 -->
						<input type="radio" name="tabs" class="tabs" id="tab2">
						<label for="tab2">Níveis</label>
						<div>
						  Aba 2
						</div>
						
						<!-- ABA 3 -->
						<input type="radio" name="tabs" class="tabs" id="tab3">
						<label for="tab3">Informações</label>
						<div>
						<br /><br /><br />
						   <input type="button" class="btn btn-primary black-background" value="Tornar meu primeiro nível" onclick="javascript: location.href='patrocinar.php?id=<?php echo $id ?>';" />
						<br /><br /><br /><br /><br />
						
						<h7 style = "color: black">*Primeiros níveis são pessoas que você conhece pessoalmente. Só torne primeiros níveis pessoas que você realmente conhece!</h7>
						</div>
				</div>
</div>
</div>          
</div>
</div>
    </section>
 <!-- [/MAIN-HEADING]
 ============================================================================================================================-->
 
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
</div>
 

<!-- [ /WRAPPER ]
=============================================================================================================================-->

	<!-- [ DEFAULT SCRIPT ] -->
	<script src="library/modernizr.custom.97074.js"></script>
	<script src="library/jquery-1.11.3.min.js"></script>
        <script src="library/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>	
	<!-- [ PLUGIN SCRIPT ] -->
	<script src="js/plugins.js"></script>
	<!-- [ SLIDER SCRIPT ] -->  
        
        
        <!-- [ PORTFOLIO SCRIPT ] -->
        <script type="text/javascript" src="js/jquery.isotope.js"></script>
	<script src="js/slider.js"></script>
        <!-- [ COMMON SCRIPT ] -->
	<script src="js/common.js"></script>
  
</body>


</html>