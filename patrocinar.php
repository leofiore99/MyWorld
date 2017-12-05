<?php
include 'conexao.php';
// A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();
      
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: index.php"); exit;
}

$id_solicitante = $_SESSION['UsuarioID'];

$id_solicitado = $_GET['id'];

$querySolicitado = mysql_query("SELECT membro FROM usuario WHERE id_usuario = '$id_solicitado'") or die("Erro ao selecionar maior nível");
//die(var_dump($querySolicitado));
$resultadoSolicitado = mysql_fetch_assoc($querySolicitado);
$membroSolicitado = $resultadoSolicitado['membro'];

if($membroSolicitado == 'M'){
	echo"<script language='javascript' type='text/javascript'>alert('O seu amigo ainda não é um usuário do site!');window.location.href='perfilUsuario.php?id=$id_solicitado'</script>";
}

if($id_solicitante == $id_solicitado){
	echo"<script language='javascript' type='text/javascript'>alert('Você não pode mandar solicitação para si próprio!');window.location.href='perfilUsuario.php?id=$id_solicitado'</script>";
}

$queryNivelUm = mysql_query("SELECT nivel FROM nivel WHERE nivel = 1 AND ((id_usuario = '$id_solicitado' AND id_usuario_rel = $id_solicitante) OR (id_usuario = '$id_solicitante' AND id_usuario_rel = $id_solicitado))") or die("Erro ao selecionar maior nível");
$total = mysql_num_rows($queryNivelUm);

if($total > 0){
	echo"<script language='javascript' type='text/javascript'>alert('Vocês já são primeiros níveis!');window.location.href='perfilUsuario.php?id=$id_solicitado'</script>";
}

$queryNotificacao = mysql_query("SELECT * FROM notificacao WHERE (id_solicitante = '$id_solicitado' AND id_solicitado = $id_solicitante) OR (id_solicitante = '$id_solicitante' AND id_solicitado = $id_solicitado)") or die("Erro ao selecionar maior nível");
$totalNotificacao = mysql_num_rows($queryNotificacao);

if($totalNotificacao > 0){
	echo"<script language='javascript' type='text/javascript'>alert('Vocês já possuem alguma solicitação pendente, consulte seu amigo!');window.location.href='perfilUsuario.php?id=$id_solicitado'</script>";
}

$query = "INSERT INTO notificacao (id_solicitante, id_solicitado) VALUES ('$id_solicitante' ,'$id_solicitado')";
			  $insert = mysql_query($query,$connect);
			  
		if($insert){
				echo"<script language='javascript' type='text/javascript'>alert('Solicitação enviada! Aguarde até que seu amigo confirme.');window.location.href='perfilUsuario.php?id=$id_solicitado'</script>";
        }else{
			echo"<script language='javascript' type='text/javascript'>alert('Erro ao inserir, contate um administrador!');window.location.href='perfilUsuario.php?id=$id_solicitado'</script>";
		}
?>