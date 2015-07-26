<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
    header('Location: index2.php');
  }else
  {
    $urledit = $_GET['editid'];
      $readEdit = read('posts', "WHERE id = '$urledit'");
     if (!$readEdit) 
      {
        header('Location: index2.php?exe=posts/posts');
      }else
      { 
	   $readMeasures = read('post_colors',"WHERE post_id = '$urledit'"); 
	   if($readMeasures)
	   { $message = "true";
	   	 header('Location: index2.php?exe=posts/posts-edit&editid='.$urledit.'&message='.$message);
		}    
        foreach ($readEdit as $postedit);
echo '<section class="span8">';
echo '<a href="index2.php?exe=posts/posts" title="Listar Produtos" class="pull-right btn btn-primary">Listar Produtos</a>';
echo '<a href="index2.php?exe=posts/posts-edit&editid='.$postedit['id'].'" title="Voltar" class="pull-right btn btn-danger">Voltar</a>';
    if (isset($_POST['sendForm'])) 
    {
	   $values = "'".implode("', '", array_values($_POST['cores']))."'";
       $f['color_post']  = htmlspecialchars(mysql_real_escape_string($values));	            
			if (in_array('', $f)) 
			{
			   echo '<span class="alert alert-info">Informe todos os Campos!</span>';
			}else
			{						
				$f['post_id'] = $urledit;
				if(!$readMeasures){		
				echo '<pre>'.print_r($f).'</pre>';	
				create('post_colors',$f);
				$_SESSION['return'] = '<span class="alert alert-success">Cores cadastradas com sucesso!</span>';
				header('Location: index2.php?exe=posts/posts-edit&editid='.$urledit);
				}
			}     
			}elseif (!empty( $_SESSION['return'])) 
			{
			echo  $_SESSION['return'];
			unset( $_SESSION['return']);
			}
?>
    <form name="formulario" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
  	<legend>Cadastrar Medidas em :<strong class="alert alert-error"> <?php  echo $postedit['titulo']; ?></strong></legend> 
          <div class="control-group">
  <label class="control-label" for="checkboxes">Cores Dispon&iacute;veis:</label>
  <div class="controls">
  <?php $readColor = read('colors'); foreach($readColor as $color):
   echo '<label class="checkbox inline span2" for="'.$color['color_name'].'">';
   echo '<input type="checkbox" name="cores[]" id="'.$color['color_name'].'" value="'.$color['color_hexadecimal'].'">';
  echo   '<span style="background-color:'.$color['color_hexadecimal'].'">&nbsp;&nbsp;&nbsp;&nbsp;</span> '.$color['color_name']; 
  echo '</label>'; 
  	endforeach;	
    ?>    
  </div>
</div> 
    <div class="control-group">
    <label class="control-label" for="sendForm"></label>
    <div class="controls">
    <input type="submit" value="Cadastrar" id="sendForm" name="sendForm" class="btn btn-success" />
    </div>
    </div>  
</fieldset>       
    </form>	
</section><!-- /bloco span8 -->
<?php }}}else{header('Location: ../index2.php');}?>