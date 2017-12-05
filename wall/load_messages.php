 <?php
//Srinivas Tamada http://9lessons.info
//Loading Comments link with load_updates.php 
foreach($updatesarray as $data)
 {
 $msg_id=$data['msg_id'];
 $orimessage=$data['message'];
 $message=tolink(htmlentities($data['message']));
 $time=$data['created'];
 $uid=$data['uid_fk'];
 $face=$Wall->Gravatar($uid);
 $commentsarray=$Wall->Comments($msg_id);

$nomeUsuario = $data['nome'];
$foto = $data['foto'];

// A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();
      
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        // Destrói a sessão por segurança
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: ../index.html"); exit;
}
?>

<script type="text/javascript"> 
$(document).ready(function(){$("#stexpand<?php echo $msg_id;?>").oembed("<?php echo  $orimessage; ?>",{maxWidth: 400, maxHeight: 300});});
</script>
<div class="stbody" id="stbody<?php echo $msg_id;?>">

<div class="stimg">
<img src="<?php echo "../fotos/".$foto."";?>" class='big_face'/>
</div> 
<div class="sttext">
<a class="stdelete" href="#" id="<?php echo $msg_id;?>" title="Delete update">X</a>
<b><a href="../redirecionarUsuario.php?id=<?php echo $uid ?>"><?php echo $nomeUsuario;?></a></b> <?php echo $message;?>
<div class="sttime"><?php time_stamp($time);?> | <a href='#' class='commentopen' id='<?php echo $msg_id;?>' title='Comment'>Comment </a></div> 

<div id="stexpandbox">
<div id="stexpand<?php echo $msg_id;?>"></div>
</div>

<div class="commentcontainer" id="commentload<?php echo $msg_id;?>">


<?php include('load_comments.php') ?>

</div>
	<div class="commentupdate" style='display:none' id='commentbox<?php echo $msg_id;?>'>
		<div class="stcommentimg">
			<img src="<?php echo "../fotos/".$foto."";?>" class='small_face'/>
		</div> 
		<div class="stcommenttext" >
			<form method="post" action="">

				<textarea name="comment" class="comment" maxlength="200"  id="ctextarea<?php echo $msg_id;?>"></textarea>
				<br />
				<input type="submit"  value=" Comment "  id="<?php echo $msg_id;?>" class="comment_button"/>
			</form>
		</div>
	</div>
</div> 
</div>

<?php

  }
?>



 


