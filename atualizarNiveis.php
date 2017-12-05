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
		
		$queryMembro = mysql_query("SELECT membro FROM usuario WHERE id_usuario = '$idSolicitante'") or die("Erro ao selecionar id do solicitante.");
		//die(var_dump($queryMembro));
		$resultadoMembro = mysql_fetch_assoc($queryMembro);
		$membro = $resultadoMembro['membro'];
		
		if($membro == 'U'){
		$query_select = mysql_query("SELECT max(nivel) FROM nivel WHERE id_usuario = '$idSolicitante' or id_usuario_rel = '$idSolicitante'") or die("erro ao selecionar");
		$resultado = mysql_fetch_assoc($query_select);
		$maxNivel = $resultado['max(nivel)'];
		
		$query = "UPDATE nivel SET nivel = 1 WHERE (id_usuario = '$idSessao' and id_usuario_rel = $idSolicitante) OR (id_usuario = '$idSolicitante' and id_usuario_rel = $idSessao)";;
		$update = mysql_query($query,$connect);
		
		for ($i = 1; $i <= $maxNivel; $i++) {
			$nivelInserir = $i + 1;
			$query2 = sprintf("SELECT * FROM nivel WHERE nivel = '$i' AND (id_usuario = '$idSolicitante' OR id_usuario_rel = '$idSolicitante') ");
			$dados = mysql_query($query2, $connect) or die(mysql_error());
			
			while($linha = mysql_fetch_assoc($dados)){
				if($linha['id_usuario'] != $idSessao && $linha['id_usuario'] != $idSolicitante){
					$idRel = $linha['id_usuario'];
					$query_select2 = mysql_query("SELECT nivel FROM nivel WHERE (id_usuario = '$idRel' and id_usuario_rel = $idSessao) OR (id_usuario = '$idSessao' and id_usuario_rel = '$idRel')") or die("erro ao selecionar");
					$resultado2 = mysql_fetch_assoc($query_select2);
					$nivelRel = $resultado2['nivel'];
					
					if($nivelInserir < $nivelRel){
						$query3 = "UPDATE nivel SET nivel = '$nivelInserir' WHERE (id_usuario = '$idRel' and id_usuario_rel = $idSessao) OR (id_usuario = '$idSessao' and id_usuario_rel = $idRel)";
						$update = mysql_query($query3,$connect);
					}
				}else if($linha['id_usuario_rel'] != $idSessao && $linha['id_usuario_rel'] != $idSolicitante){
					$idRel = $linha['id_usuario_rel'];
					$query_select2 = mysql_query("SELECT nivel FROM nivel WHERE (id_usuario = '$idRel' and id_usuario_rel = '$idSessao') OR (id_usuario = '$idSessao' and id_usuario_rel = '$idRel')") or die("erro ao selecionar");
					$resultado2 = mysql_fetch_assoc($query_select2);
					$nivelRel = $resultado2['nivel'];
					
					if($nivelInserir < $nivelRel){
					
					$query = "UPDATE nivel SET nivel = '$nivelInserir' WHERE (id_usuario = '$idRel' and id_usuario_rel = $idSessao) OR (id_usuario = '$idSessao' and id_usuario_rel = $idRel)";
					$update = mysql_query($query,$connect);
					}
				}			
			}
		}
		
		}else{
			//Fazer insert na tabela de níveis
			$queryInsert = "INSERT INTO nivel (id_usuario, id_usuario_rel, nivel) VALUES ('$idSessao', '$idSolicitante' ,'1')";
			$insert = mysql_query($queryInsert,$connect);

			$query = "UPDATE usuario SET id_patrocinador = '$idSessao', membro = 'U' WHERE id_usuario = '$idSolicitante'";
			$update = mysql_query($query,$connect);
			
			//Fazer insert com os outros níveis do patrocinador
			$queryMax = mysql_query("SELECT MAX(nivel) FROM nivel WHERE (id_usuario = '$idSessao') || (id_usuario_rel = '$idSessao')") or die("Erro ao selecionar maior nível");
			//die(var_dump($queryMax));
			$resultadoMax = mysql_fetch_assoc($queryMax);
			$ultimoNivel = $resultadoMax['MAX(nivel)'];

			for($i = 1; $i<=$ultimoNivel; $i++){
			  $selectNiveis = mysql_query("SELECT * FROM nivel WHERE ((id_usuario = '$idSessao') || (id_usuario_rel = '$idSessao')) && nivel = $i");
			  $nivel = $i+1;
			  while($linha = mysql_fetch_array($selectNiveis)){
				if($linha['id_usuario'] != $idSolicitante && $linha['id_usuario_rel'] != $idSolicitante){
					if($linha['id_usuario'] == $idSessao){
						$usuarioRel = $linha['id_usuario_rel'];
					}else{
						$usuarioRel = $linha['id_usuario'];
					}
				$queryNiveis = "INSERT INTO nivel (id_usuario, id_usuario_rel, nivel) VALUES ('$idSolicitante', '$usuarioRel' ,'$nivel')";
				$insertNiveis = mysql_query($queryNiveis, $connect);
					}	
				}
			}
		}
		
	$strSQL = "DELETE FROM notificacao WHERE id_solicitado = '$idSessao' and id_solicitante = $idSolicitante";
	mysql_query($strSQL) or die (mysql_error());
	echo"<script language='javascript' type='text/javascript'>alert('Confirmação realizada com sucesso!');window.location.href='perfil.php';</script>";
		?>