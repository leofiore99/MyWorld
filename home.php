<?php
include 'conexao.php';
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
?>
<!DOCTYPE html>
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
			<a class="navbar-brand" href="perfil.php"><?php echo "<img style='width:auto; height:260%; margin-top:-15px' src='fotos/$foto' /><br />";?></a>
			<a href="perfil.php" class="navbar-brand2"><u><?php echo $_SESSION['UsuarioNome']; ?></u></a>
            
        </div>
		<a class="navbar-brand" href="cadastro.php" style="margin-left:110px"> Convide um amigo</a>
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
            <div class="row">
                <div class="col-md-12 col-sm-12">
                   <h1 class="text-capitalize"><strong>CÓDIGO <span class="themecolor">AQUI!!!!!</span></strong></h1>
               <p class="lead"><strong> Insira aqui os dados </strong></p>
                <br />
				<form method="POST" action="cadastrar.php">
                        <div class="row" style="margin-left: 395px">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-size:20px" for="nome">Nome Completo</label>
                                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome">
                                </div>
								<div class="form-group">
                                    <label style="font-size:20px" for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Digite o email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                        </div>
                        
                        <!--<button type="submit" class="btn btn-primary black-background" id="cadastrar">Enviar</button>-->
						<input type="submit" class="btn btn-primary black-background" value="Enviar" id="cadastrar" name="cadastrar">
                    </form>
               
                </div>
                 
            </div>
            
		</div>
        </div>
    </section>
 <!-- [/MAIN-HEADING]
 ============================================================================================================================-->
 
 

 
 <!-- [/ABOUTUS]
 ============================================================================================================================-->
 
 
 
 
 
 
 
 
 
 <!-- [CONTACT]
 ============================================================================================================================-->

 <!-- [/CONTACT]
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