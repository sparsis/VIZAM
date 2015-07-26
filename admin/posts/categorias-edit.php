<?php
if (function_exists('getUser')) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
    echo '<span class="alert alert-error">Desculpe, Voc&ecirc; n&atilde;o tem permiss&atilde;o para gerenciar as categorias!</span>';
  }else
  {
      $urledit = $_GET['edit'];
      $readEdit = read('cat', "WHERE id = '$urledit'");
      if (!$readEdit) 
      {
        header('Location: index2.php?exe=posts/categorias');
      }else
      {
        foreach ($readEdit as $catedit);

?>
<section class="span8">        
<a href="index2.php?exe=posts/categorias" title="Voltar" class="pull-right btn-primary">Voltar</a>        
<?php  
 if (isset($_POST['sendForm'])) 
 {
     $f['nome']    = htmlspecialchars(mysql_real_escape_string($_POST['nome']));   
     $f['date']    = htmlspecialchars(mysql_real_escape_string($_POST['data']));

     if (in_array('', $f)) 
     {
         echo '<span class="alert alert-info">Preencha todos os Campos!</span>';
     }else
     {
        $f['data'] = formDate($f['date']); unset($f['date'] );
        if ($catedit['nome'] != $f['nome']) 
        {
            $prefix = $_GET['uri'];
            if ($prefix) 
            {
                $f['url'] = $prefix.'-'.setUri($f['nome']);
                 $readCatUri = read('cat', "WHERE url LIKE  '%$f[url]%' AND id_pai IS NOT NULL AND id != '$urledit'");
                 if ($readCatUri) 
                 {
                 $f['url'] = $f['url'].'-'.count($readCatUri);
                 $readCatUri = read('cat', "WHERE url = '$f[url]' AND id_pai IS NOT NULL AND id != '$urledit'");
                  if ($readCatUri) 
                  {
                    $f['url'] = $f['url'].'_'.time();
                  }
                 } 
            }else
            {
               $f['url'] = setUri($f['nome']);
               $readCatUri = read('cat', "WHERE url LIKE  '%$f[url]%' AND id_pai IS NULL AND id != '$urledit'");
               if ($readCatUri) 
               {
                 $f['url'] = $f['url'].'-'.count($readCatUri);
                 $readCatUri = read('cat', "WHERE url = '$f[url]' AND id_pai IS NULL AND id != '$urledit'");
                 if ($readCatUri) 
                 {
                    $f['url'] = $f['url'].'_'.time();
                 }
               } 
            }           
        
        }else
        {
          $f['url'] = $catedit['url'];
        }
        update('cat',$f,"id = '$urledit'");
        $_SESSION['return'] = '<span class="alert alert-success">Categoria atualizada com sucesso!</span>';
        if($prefix)
        {
          header('Location: index2.php?exe=posts/categorias-edit&edit='.$urledit.'&uri='.$prefix);
        }else
        {
          header('Location: index2.php?exe=posts/categorias-edit&edit='.$urledit);
        }
     }     
 }elseif (!empty( $_SESSION['return'])) 
 {
   echo  $_SESSION['return'];
   unset( $_SESSION['return']);
 }
?>
        <form name="formulario" action="" method="post">
         <fieldset>
			<legend>Editar categoria : <strong> <?php  echo $catedit['nome']; ?></strong></legend>
            <div class="control-group">
            	<label class="control-label" for="nome"><span>Nome:</span></label>
             	<div class="controls">
                <input type="text" id="nome" name="nome" class="span4" value="<?php echo $catedit['nome']; ?>" />
                </div>
            </div>           
            <div class="control-group">
            	<label class="control-label" for="data"><span>Data:</span></label>
            	<div class="controls">
                <input type="text" id="data" name="data" rows="3" class="span4" value="<?php echo date('d/m/Y H:i:s',strtotime($catedit['data'])); }?>" />
                </div>
            </div>
            <div class="control-group">	  
                 <label class="control-label" for="sendForm"></label>
                 <div class="controls" id="sendForm">
                <input type="submit" value="Atualizar Categoria" name="sendForm" class="btn btn-success" />
                </div>
            </div>           
         </fieldset>      
        </form> 
</section><!-- /bloco span8 -->
<?php }}else{header('Location: ../index2.php');}?>