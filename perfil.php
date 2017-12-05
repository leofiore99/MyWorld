<?php
include 'conexao.php';
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

$Wall = new Wall_Updates();
$updatesarray=$Wall->UpdatesPerfil($uid);

$foto = $_SESSION['UsuarioFoto'];
$id = $_SESSION['UsuarioID'];

//Notificações
$query = sprintf("SELECT * FROM notificacao WHERE id_solicitado = '$id'");
	$dados = mysql_query($query, $connect) or die(mysql_error());
	$linha = mysql_fetch_assoc($dados);
	$total = mysql_num_rows($dados);
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
		  
			<a class="navbar-brand" href="perfil.php"><?php echo "<img style='width:auto; height:260%; margin-top:-15px' src='fotos/$foto' /><br />";?></a>
			<a href="perfil.php"  class="navbar-brand2" style><u><?php echo $_SESSION['UsuarioNome']; ?></u></a>
        </div>
		
		<a class="navbar-brand" href="cadastro.php" style="margin-left:180px"> Convide um amigo</a>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            
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
				<!-- Criando a listagem -->
	<div class="tabs-container">
    
    <!-- ABA 1 -->
    <input type="radio" name="tabs" class="tabs" id="tab1" checked>
    <label for="tab1">Meus Tópicos</label>
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
    <label for="tab2">Meus níveis</label>
    <div>
      Aba 2
    </div>
    
    <!-- ABA 3 -->
    <input type="radio" name="tabs" class="tabs" id="tab3">
    <label for="tab3">Configurações</label>
    <div class="container" style="height:auto">
         <div class="row">
             <div class="col-md-6 col-sm-6">
               <div class="aboutText">
                        <div class="sectionTitle">
                            <h2>Alterar senha</h2>
                            <hr>
                            <br />
                        </div>
						<form method="POST" action="alterarSenha.php">
                        <ul class="aboutList">
                            <li>
                                <label style="font-size:20px; color:black" for="senhaAtual">Senha</label>
                                <input type="password" class="form-control" id="senhaAtual" name="senhaAtual" placeholder="Digite sua senha atual">
                            </li>
							<br />
                            <li>
                                <label style="font-size:20px; color:black" for="novaSenha">Nova Senha</label>
                                <input type="password" class="form-control" id="novaSenha" name="novaSenha" placeholder="Digite a nova senha">
                            </li>
							<br />
                            <li>
                                <label style="font-size:20px; color:black" for="confirmarSenha">Confirmar Senha</label>
                                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" placeholder="Digite novamente a confirmação de senha">
                            </li>
							
							<br /><br />
							<button type="submit" class="btn btn-primary black-background" id="contactbtn">Alterar</button>
							</form>
                        </ul>
                    </div>  
                 
                
             </div>
             <div class="col-md-6 col-sm-6">
				<div class="sectionTitle">
                            <h2>Foto de Perfil</h2>
                            <hr>
                            
                </div>
                 <img style="width:70%; height:90%" src="<?php echo "fotos/$foto"; ?>" class="img-responsive" alt="pc"/>
				 
				 <form method="POST" action="alterarFoto.php" enctype="multipart/form-data">
                                    <input style="background-color:transparent; border:none; color: black" name="foto" id="foto" type="file" required = "true"; class="form-control" >
						<br />
						<input type="submit" class="btn btn-primary black-background" value="Atualizar foto" id="avançar" name="avançar">
                </form>
             </div>              
         </div>        
     </div>
	 
	 <!-- ABA 4 -->
    <input type="radio" name="tabs" class="tabs" id="tab4">
    <label for="tab4">Notificações (<?php echo $total ?>)</label>
    <div class ="text-left">
	  <?php
	if($total > 0) {
		do {
			$nomeUsuario = $linha['id_solicitante'];
			$query_select = mysql_query("SELECT nome, foto FROM usuario WHERE id_usuario = '$nomeUsuario'") or die("erro ao selecionar");
			$resultado = mysql_fetch_assoc($query_select);
			$nomeSolicitante = $resultado['nome'];
?>
	
			<?php echo "<img class='big_face' src='fotos/".$resultado['foto']."' />";?> <?php echo " <u style='color:black'><b> $nomeSolicitante</b></u>"?> <n style='color:black'> quer tornar-lhe primeiro nível </n>
			
			<input type="button" class="btn btn-primary black-background" value="Aceitar" onclick="javascript: location.href='atualizarNiveis.php?id=<?php echo $linha['id_solicitante'] ?>';" />
			<input type="button" class="btn btn-primary black-background" value="Recusar" onclick="javascript: location.href='recusar.php?id=<?php echo $linha['id_solicitante'] ?>';" />
			<br /><br />
			<?php

			}while($linha = mysql_fetch_assoc($dados));
		}else{
			?>
			<br />
			<h2 style="color:black;" class="text-center"> Você não possui notificações!</h2>
			<?php
		}
?>

</body>
</html>
<?php
	mysql_free_result($dados);
?>	
	  
	  
	  
	  
    </div>
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
                <p>iNeed 2017. Designed by <a href="http://www.your-plugin.com" class="themecolor">iNeed</a></p>
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