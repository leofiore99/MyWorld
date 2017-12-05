<?php
// A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();
      
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: index.php"); exit;
}

$id = $_GET['id'];

$id_sessao = $_SESSION['UsuarioID'];

  if($id == $id_sessao){
    header ("Location: perfil.php?id=$id");
  }else {
	header ("Location: perfilUsuario.php?id=$id");
  }
?>