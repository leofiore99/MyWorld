<?php
//Srinivas Tamada http://9lessons.info
//Loading Comments link with load_updates.php 
foreach($commentsarray as $cdata)
 {
 $com_id=$cdata['com_id'];
 $comment=tolink(htmlentities($cdata['comment'] ));
  $time=$cdata['created'];
   $username=$cdata['nome'];
  $uid=$cdata['uid_fk'];
   $cface=$Wall->Gravatar($uid);
   $foto = $cdata['foto'];
 ?>
<div class="stcommentbody" id="stcommentbody<?php echo $com_id; ?>">
<div class="stcommentimg">
<img src="<?php echo "fotos/".$foto."";?>" class='small_face'/>
</div> 
<div class="stcommenttext">
<a class="stcommentdelete" href="#" id='<?php echo $com_id; ?>' title='Delete Comment'>X</a>
<b><a href="redirecionarUsuario.php?id=<?php echo $uid ?>"><?php echo $username; ?></a></b> <?php echo $comment; ?>
<div class="stcommenttime"><?php time_stamp($time); ?></div> 
</div>
</div>
<?php 
}
?>