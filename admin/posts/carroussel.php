<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
    header('Location: index2.php');
  }else
  {
    $postid = $_GET['postid'];
    $readCat = read('cat', "WHERE id = '$postid'");
    if (!$readCat) 
    {
      header('Location: index2.php?exe=posts/posts');
    }else
    {
    foreach ($readCat as $cat);
?>

<section class="span8">
<a href="index2.php?exe=posts/carroussel&postid=<?php echo $cat['id'];?>&delall=<?php echo $postid; ?>" title="Deletar imagens" class="pull-right btn btn-danger">Deletar todas Imgens</a>   
     <a href="index2.php?exe=posts/posts" title="Listar Produtos" class="pull-right btn btn-primary" >Listar Produtos</a>
    <form action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
     <fieldset>
  	<legend>Cadastrar imagens em :<strong class="alert alert-error"> <?php  echo $cat['nome']; ?></strong></legend>
  		
    </label>
     	<input type="text" style="display:none" name="postid" value="<?php echo $postid; ?>" />
        <input id="file_upload_carroussel" name="file_upload_carroussel" type="file" class="file" />      
         
   
   
    <a href="javascript:$('#file_upload_carroussel').uploadifyUpload();" class="btn btn-large btn-primary">clique aqui para enviar!</a>
     
  
        </fieldset>    
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
    delete('carroussel', "id = '$imgId'");
  }
  if (!empty($_GET['delall'])) 
  {
    $imgId = $_GET['delall'];
	$imagens = read('carroussel',"WHERE cat_id = '$postid'");
	foreach($imagens as $img):
    $imgIm = $img['img'];
    $pasta = '../uploads/';
    if (file_exists($pasta.$imgIm) && !is_dir($pasta.$imgIm)) 
    {
      unlink($pasta.$imgIm);
    }	
	endforeach;
	delete('carroussel', "cat_id = '$postid'");
    header('Location: index2.php?exe=posts/carroussel&postid='.$cat['id']);
  }
  $readGb = read('carroussel', "WHERE cat_id = '$cat[id]'");
  if (!$readGb) 
  {
    
  }else
  {
    echo ' <ul class="gblist">';
    foreach ($readGb as $gb):
    $i++;  
?>
    	<li<?php if($i%6==0){echo ' class="last"';}?>>
        	<img src="thumb.php?src=<?php echo BASE; ?>/uploads/<?php echo $gb['img']; ?>&w85&h=65&q=100&zc=1" />
            <div class="action">
            	<a href="../uploads/<?php echo $gb['img']; ?>" rel="shadowbox" title="Imagem da galeria de: <?php echo $cat['nome']; ?>"><img src="ico/view.png" title="Imagem da galeria de: <?php echo $cat['nome']; ?>" alt="Imagem da galeria de: <?php echo $cat['nome']; ?>" /></a>
                <a href="index2.php?exe=posts/carroussel&postid=<?php echo $cat['id'];?>&delid=<?php echo $gb['id']; ?>&img=<?php echo $gb['img']; ?>" title="Exluir imagem <?php echo $i;?>"><img src="ico/no.png" title="Exluir imagem <?php echo $i;?>" alt="Exluir imagem <?php echo $i;?>" /></a>
            </div><!-- /action -->
        </li>
   
<?php 
  endforeach;
  echo '</ul>';
  }
?>


</section><!-- /bloco span8 -->

<?php }}}else{ header('Location: ../index2.php');}?>