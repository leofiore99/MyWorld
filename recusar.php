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

	$idSessao = $_SESSION['UsuarioID'];
	$idSolicitante = $_GET['id'];

	$strSQL = "DELETE FROM notificacao WHERE id_solicitado = '$idSessao' and id_solicitante = $idSolicitante";
	mysql_query($strSQL) or die (mysql_error());
	echo"<script language='javascript' type='text/javascript'>alert('Muito bem! Só adicione quem você conhece!');window.location.href='perfil.php';</script>";
	?>