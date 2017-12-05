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

  $novaSenha = md5($_POST['novaSenha']);
  $confirmaSenha = md5($_POST['confirmaSenha']);
  $email = $_SESSION['UsuarioEmail'];
  $idPatrocinador = $_SESSION['PatrocinadorID'];
  $idUsuario = $_SESSION['UsuarioID'];

  //die(var_dump($email));

    if($novaSenha == "" || $novaSenha == null){
      echo"<script language='javascript' type='text/javascript'>alert('Por favor, informe a nova senha.');window.location.href='primeiroAcesso.php';</script>";
  	die();
    }

    if($confirmaSenha == "" || $confirmaSenha == null){
      echo"<script language='javascript' type='text/javascript'>alert('Por favor, informe a confirmação de senha.');window.location.href='primeiroAcesso.php';</script>";
  	die();
    }

    if($novaSenha != $confirmaSenha){
      echo"<script language='javascript' type='text/javascript'>alert('A nova senha deve ser igual à confirmação de senha.');window.location.href='primeiroAcesso.php';</script>";
  	die();
    }

    $query = "UPDATE `usuario` SET `senha` = '".$novaSenha."', primeiroAcesso = 'N' WHERE `email` = '".$email."'";
    $update = mysql_query($query,$connect);

    //die(var_dump($teste));
    //Fazer insert na tabela de níveis
    $queryInsert = "INSERT INTO nivel (id_usuario, id_usuario_rel, nivel) VALUES ('$idPatrocinador', '$idUsuario' ,'1')";
    $insert = mysql_query($queryInsert,$connect);

    //Fazer insert com os outros níveis do patrocinador
    $queryMax = mysql_query("SELECT MAX(nivel) FROM nivel WHERE (id_usuario = '$idPatrocinador') || (id_usuario_rel = '$idPatrocinador')") or die("Erro ao selecionar maior nível");
    //die(var_dump($queryMax));
    $resultadoMax = mysql_fetch_assoc($queryMax);
    $ultimoNivel = $resultadoMax['MAX(nivel)'];

    for($i = 1; $i<=$ultimoNivel; $i++){
  	  $selectNiveis = mysql_query("SELECT * FROM nivel WHERE ((id_usuario = '$idPatrocinador') || (id_usuario_rel = '$idPatrocinador')) && nivel = $i");
  	  $nivel = $i+1;
  	  while($linha = mysql_fetch_array($selectNiveis)){
  		if($linha['id_usuario'] != $idUsuario && $linha['id_usuario_rel'] != $idUsuario){
			if($linha['id_usuario'] == $idPatrocinador){
				$usuarioRel = $linha['id_usuario_rel'];
			}else{
				$usuarioRel = $linha['id_usuario'];
			}
  		$queryNiveis = "INSERT INTO nivel (id_usuario, id_usuario_rel, nivel) VALUES ('$idUsuario', '$usuarioRel' ,'$nivel')";
  		$insertNiveis = mysql_query($queryNiveis, $connect);
			}	
  	  }
    }

    if($update){
  	   echo"<script language='javascript' type='text/javascript'>alert('Senha atualizada. Estamos quase lá!');window.location.href='atualizarFoto.php'</script>";
    }else{
         echo"<script language='javascript' type='text/javascript'>alert('Não foi possível atualizar a senha. Contate um superior');window.location.href='primeiroAcesso.php'</script>";
    }


  ?>
