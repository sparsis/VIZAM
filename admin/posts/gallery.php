<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
    header('Location: index2.php');
  }else
  {
    $postid = $_GET['postid'];
    $readPost = read('posts', "WHERE id = '$postid'");
    if (!$readPost) 
    {
      header('Location: index2.php?exe=posts/posts');
    }else
    {
    foreach ($readPost as $post);
?>
<section class="span8">
<a href="index2.php?exe=posts/gallery&postid=<?php echo $post['id'];?>&delall=<?php echo $postid; ?>" title="Deletar todas imagens" class="pull-right btn btn-danger">Deletar todas Imgens</a>
    <div class="titulo">Postar fotos em <strong style="color:#900"><?php echo $post['titulo']; ?></strong>
<a href="index2.php?exe=posts/posts" title="Listar Produtos"  class="pull-right btn btn-primary">Listar Produtos</a>

    <form action="" method="post">
        <label>
            <input id="file_upload" name="file_upload" type="file" class="file" />
        </label>
        	<a href="javascript:$('#file_upload').uploadifyUpload();" class="btn btn-large btn-primary">clique aqui para enviar!</a>
    </form>   
<?php 
  if (!empty($_GET['delid'])) 
  {
    $imgId = $_GET['delid'];
    $imgIm = $_GET['img'];
    $pasta = '../uploads/';
    if (file_exists($pasta.$imgIm) && !is_dir($pasta.$imgIm)) 
    {
      unlink($pasta.$imgIm);
    }
    delete('posts_gb', "id = '$imgId'");
  }
   if (!empty($_GET['delall'])) 
  {
    $imgId = $_GET['delall'];
	$imagens = read('posts_gb',"WHERE post_id = '$postid'");
	foreach($imagens as $img):
    $imgIm = $img['img'];
    $pasta = '../uploads/';
    if (file_exists($pasta.$imgIm) && !is_dir($pasta.$imgIm)) 
    {
      unlink($pasta.$imgIm);
    }	
	endforeach;
	delete('posts_gb', "post_id = '$postid'");
    header('Location: index2.php?exe=posts/gallery&postid='.$post['id']);
  }
  $readGb = read('posts_gb', "WHERE post_id = '$postid'");
  if (!$readGb) 
  {
    
  }else
  {
    echo ' <ul class="gblist">';
    foreach ($readGb as $gb):
    $i++;  
?>
    	<li<?php if($i%6==0){echo ' class="last"';}?>>
        	<img src="thumb.php?src=<?php echo BASE; ?>/uploads/<?php echo $gb['img']; ?>&w85&h=65&q=100&zc=1" width="85" height="65" />
            <div class="action">
            	<a href="../uploads/<?php echo $gb['img']; ?>" rel="shadowbox" title="Imagem da galeria de: <?php echo $post['titulo']; ?>"><img src="ico/view.png" title="Imagem da galeria de: <?php echo $post['titulo']; ?>" alt="Imagem da galeria de: <?php echo $post['titulo']; ?>" /></a>
                <a href="index2.php?exe=posts/gallery&postid=<?php echo $post['id'];?>&delid=<?php echo $gb['id']; ?>&img=<?php echo $gb['img']; ?>" title="Exluir imagem <?php echo $i;?>"><img src="ico/no.png" title="Exluir imagem <?php echo $i;?>" alt="Exluir imagem <?php echo $i;?>" /></a>
            </div><!-- /action -->
        </li>
   
<?php 
  endforeach;
  echo '</ul>';
  }
?>


</section><!-- /bloco span8 -->
<?php }}}else{ header('Location: ../index2.php');}?>