<?php
include 'conexao.php';
date_default_timezone_set('America/Sao_Paulo');

$nome = $_POST['nome'];
//$email = MD5($_POST['email']);
$email = $_POST['email'];
$senha = geraSenha(8);
$senhaCript = md5($senha);

$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');
$emailenviar = $email;
$destino = $emailenviar;
$assunto = "MyWorld - Cadastro";

$arquivo = "
  <style type='text/css'>
  body {
  margin:0px;
  font-family:Verdane;
  font-size:12px;
  color: #666666;
  }
  a{
  color: #666666;
  text-decoration: none;
  }
  a:hover {
  color: #FF0000;
  text-decoration: none;
  }
  </style>
    <html>
        <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
            <tr>
              <td>
			  <tr>
                 <td width='500'>Voce foi cadastrado no MyWorld! <br />
				 Acesse o link abaixo e faca o login com a senha gerada.</td>
                </tr>
  <tr>
                 <td width='500'>Nome:$nome</td>
                </tr>
                <tr>
                  <td width='320'>E-mail:<b>$email</b></td>
     </tr>
     <tr>
                  <td width='320'>Senha:$senha</td>
                </tr>
                <tr>
                  <td width='320'>Link: <a href='http://www.myworld.com/'>http://www.myworld.com/</a></td>
                </tr>
            </td>
          </tr>  
          <tr>
            <td>Este e-mail foi enviado em <b>$data_envio</b> as <b>$hora_envio</b></td>
          </tr>
        </table>
    </html>
  ";

$query_select = "SELECT email FROM usuario WHERE email = '$email'";
$select = mysql_query($query_select,$connect);
$array = mysql_fetch_array($select);
$logarray = $array['email'];

  if($email == "" || $email == null){
    echo"<script language='javascript' type='text/javascript'>alert('O campo email deve ser preenchido');window.location.href='cadastroMembro.php';</script>";

    }else{
      if($logarray == $email){

        echo"<script language='javascript' type='text/javascript'>alert('Esse email já existe');window.location.href='cadastroMembro.php';</script>";
        die();

      }else{
			// enviar o email
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: MyWorld Developers <$email>';
			//$headers .= "Bcc: $EmailPadrao\r\n";
		  if(mail($destino, $assunto, $arquivo, $headers)){
			  $query = "INSERT INTO usuario (id_usuario, id_patrocinador, nome, email, senha, foto, primeiroAcesso, membro) VALUES ('', '' ,'$nome','$email', '$senhaCript', '', 'S', 'M')";
			  $insert = mysql_query($query,$connect);
			  
			 if($insert){
				echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso! Foi enviado um email contendo uma senha temporária.');window.location.href='index.php'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário. Contate um superior');window.location.href='cadastroMembro.php'</script>";
        }
		  }else{
			  echo"<script language='javascript' type='text/javascript'>alert('Erro ao enviar email. Tente novamente mais tarde.');window.location.href='cadastroMembro.php'</script>";
		  } 
      }
    }

	function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
	{
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';
		$retorno = '';
		$caracteres = '';
		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;
		$len = strlen($caracteres);
		for ($n = 1; $n <= $tamanho; $n++) {
		$rand = mt_rand(1, $len);
		$retorno .= $caracteres[$rand-1];
		}
		return $retorno;
	}
	
	mysql_close();
?>