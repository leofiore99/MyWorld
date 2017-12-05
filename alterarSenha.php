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
        header("Location: index.php"); exit;
}

$id = $_SESSION['UsuarioID'];

$senhaAtual = $_POST['senhaAtual'];
$novaSenha = $_POST['novaSenha'];;
$confirmarSenha = $_POST['confirmarSenha'];;

if($senhaAtual == "" || $novaSenha == "" || $confirmarSenha == ""){
	echo"<script language='javascript' type='text/javascript'>alert('Por favor, preencha todos os campos para alterar a senha.');window.location.href='perfil.php';</script>";
}else {
//Select na senha
$query_select = mysql_query("SELECT senha FROM usuario WHERE id_usuario = '$id'") or die("erro ao selecionar");
$resultado = mysql_fetch_assoc($query_select);
$senha = $resultado['senha'];

if(md5($senhaAtual) != $senha){
	echo"<script language='javascript' type='text/javascript'>alert('Senha atual não confere.');window.location.href='perfil.php';</script>";
}else{
	if($novaSenha != $confirmarSenha){
		echo"<script language='javascript' type='text/javascript'>alert('Nova senha e confirmação não conferem.');window.location.href='perfil.php';</script>";
	}else{
		$novaSenha = md5($novaSenha);
		$query = "UPDATE usuario SET senha = '$novaSenha' WHERE id_usuario = '$id'";
		$update = mysql_query($query,$connect);
        
        if($update){
			echo"<script language='javascript' type='text/javascript'>alert('Senha alterada com sucesso!');window.location.href='perfil.php';</script>";
		}else{
			echo"<script language='javascript' type='text/javascript'>alert('Erro ao alterar senha, tente novamente mais tarde.');window.location.href='perfil.php';</script>";
		}
	}
}
}
	
	
?>