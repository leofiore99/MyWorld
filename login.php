<?php
include 'conexao.php';

$email = $_POST['email'];
$senha = md5($_POST['senha']);

  if($email == "" || $email == null){
    echo"<script language='javascript' type='text/javascript'>alert('Por favor, informe o email.');window.location.href='index.php';</script>";

    }else{
		if($senha == "" || $senha == null){
			echo"<script language='javascript' type='text/javascript'>alert('Por favor, informe a senha.');window.location.href='index.php';</script>";
		}else{
			
		$verifica = mysql_query("SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'") or die("erro ao selecionar");
        if (mysql_num_rows($verifica)<=0){
          echo"<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='index.php';</script>";
          die();
        }else{

		  // Salva os dados encontados na vari?vel $resultado
		  $resultado = mysql_fetch_assoc($verifica);
		  // Se a sess?o n?o existir, inicia uma
          if (!isset($_SESSION)) session_start();
      
          // Salva os dados encontrados na sess?o
          $_SESSION['UsuarioID'] = $resultado['id_usuario'];
          $_SESSION['UsuarioNome'] = $resultado['nome'];
          $_SESSION['UsuarioEmail'] = $resultado['email'];
		  $_SESSION['PatrocinadorID'] = $resultado['id_patrocinador'];
		  $_SESSION['UsuarioFoto'] = $resultado['foto'];
		  $_SESSION['UsuarioMembro'] = $resultado['membro'];
		  
		  $primeiroAcesso = $resultado['primeiroAcesso'];
		  //die(var_dump($primeiroAcesso));
		  if($primeiroAcesso == 'S'){
			  header("Location:primeiroAcesso.php"); exit;
		  }else{
			  header("Location:home.php"); exit;
		  }
        }
    
	  
	  }
	}
?>