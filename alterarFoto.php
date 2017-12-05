<?php
	
	// Conexão com o Banco de Dados
	mysql_connect("localhost", "root", "") or die (mysql_error ());

	// Seleciona o Banco de Dados
	mysql_select_db("db_myworld") or die(mysql_error());
	
	// A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();
      
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: index.php"); exit;
    }
	// Comando SQL

	$foto = $_FILES["foto"];
	$id = $_SESSION['UsuarioID'];
	$fotoAntiga = $_SESSION['UsuarioFoto'];
	// Se a foto estiver sido selecionada
	
		// Largura máxima em pixels
		$largura = 150;
		// Altura máxima em pixels
		$altura = 180;
		// Tamanho máximo do arquivo em bytes
		$tamanho = 1000;
 
    	// Verifica se o arquivo é uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
     	   $error[1] = "Isso não é uma imagem.";
   	 	} 
	
		// Pega as dimensões da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);
	
		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[0] > $largura) {
			$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
		}
 
		// Verifica se a altura da imagem é maior que a altura permitida
		if($dimensoes[1] > $altura) {
			$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
		}
		
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > $tamanho) {
   		 	$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
		}
 
		// Se não houver nenhum erro
		
		
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
 
        	// Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
        	// Caminho de onde ficará a imagem
        	$caminho_imagem = "fotos/" . $nome_imagem;
			
			// Removendo imagem antiga da pasta fotos/
			$sql = mysql_query("SELECT foto FROM usuario WHERE id_usuario = '".$id."'");
			$usuario = mysql_fetch_object($sql);	
			
			unlink("fotos/".$usuario->foto."");
 
			// Faz o upload da imagem para seu respectivo caminho
			if(move_uploaded_file($foto["tmp_name"], $caminho_imagem)){
				echo"<script language='javascript' type='text/javascript'>alert('Foto de perfil atualizada! SEJA BEM VINDO!');window.location.href='index.php';</script>";
			}else{
				
			}
	
	
		// Se houver mensagens de erro, exibe-as
		if (count($error) != 0) {
			foreach ($error as $erro) {
				echo $erro . "<br />";
			}
		}
	
	$strSQL = "UPDATE usuario SET foto = '$nome_imagem' WHERE id_usuario = '$id'";
	
	$_SESSION['UsuarioFoto'] = $nome_imagem;
	// Comando SQL executado 
	mysql_query($strSQL) or die (mysql_error());

	// Encerra conexão
	header ("Location: wall/forum.php");
	mysql_close();
?>