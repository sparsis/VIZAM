<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
   echo '<span class="alert alert-error" style="float:left;">Desculpe, Você não tem permissão para gerenciar as páginas!</span>';
  }else
  {
    $postid = $_GET['postid'];
    $readPost = read('posts', "WHERE id = '$postid'");
    if (!$readPost) 
    {
      header('Location: index2.php?exe=paginas/paginas');
    }else
    {
    foreach ($readPost as $post);
?>
    <div class="bloco form" style="display:block">
    <div class="titulo">Postar fotos em <strong style="color:#900"><?php echo $post['titulo']; ?></strong>
     <a href="index2.php?exe=paginas/paginas" title="Voltar" class="btnalt" style="float:right;">Voltar</a></div>
    <form action="" method="post">
        <label>
            <input id="file_upload" name="file_upload" type="file" class="file" />
        </label>
        	<a href="javascript:$('#file_upload').uploadifyUpload();" class="btn upload">clique aqui para enviar!</a>
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
        	<img src="tim.php?src=<?php echo BASE; ?>/uploads/<?php echo $gb['img']; ?>&w85&h=65&q=100&zc=1" width="85" height="65" />
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


</div><!-- /bloco form -->
<?php
  } 
}
}else
{
  header('Location: ../index2.php');
}
?>