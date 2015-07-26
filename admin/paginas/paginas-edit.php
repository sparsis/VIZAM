<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
   echo '<span class="alert alert-error" style="float:left;">Desculpe, Voc&ecirc; n&atilde;o tem permiss&atilde;o para gerenciar as p&aacute;ginas!</span>';
  }else
  {
     $urledit = $_GET['editid'];
      $readEdit = read('posts', "WHERE id = '$urledit'");
      if (!$readEdit) 
      {
        header('Location: index2.php?exe=posts/posts');
      }else
      {
      
        foreach ($readEdit as $postedit);
?>
<section class="span8">
<a href="index2.php?exe=paginas/paginas" title="Paginas" class="pull-right label label-info">Listar P&aacute;ginas</a>
<?php
    if (isset($_POST['sendForm'])) 
    {
        $f['titulo']    = htmlspecialchars(mysql_real_escape_string($_POST['titulo']));
        $f['tags']      = htmlspecialchars(mysql_real_escape_string($_POST['tags']));
        $f['content']   = mysql_real_escape_string($_POST['content']);
        $f['date']      = htmlspecialchars(mysql_real_escape_string($_POST['data']));
        $f['categoria'] = '0';
        $f['nivel']     = htmlspecialchars(mysql_real_escape_string($_POST['nivel']));
        $f['status']    = '1';
        $f['autor']     = $_SESSION['autUser']['id'];
        $f['tipo']      = 'pagina';                    
        if (in_array('', $f)) 
        {
           echo '<span class="alert alert-info" style="float:left;">Informe todos os Campos!</span>';
        }else
        {
            $f['data'] = formDate($f['date']); unset($f['date'] );
            if ($postedit['titulo'] != $f['titulo']) 
            {
                $f['url'] = setUri($f['titulo']);
                $readPostUri = read('posts', "WHERE url LIKE  '%$f[url]%' AND id != '$urledit'");
                if ($readPostUri) 
                {
                  $f['url'] = $f['url'].'-'.count($readPostUri);
                  $readPostUri = read('posts', "WHERE url = '$f[url]' AND id != '$urledit'");
                  if ($readPostUri) 
                  {
                  $f['url'] = $f['url'].'_'.time();
                  }
                }
            }else
            {
               $f['url'] = $postedit['url'];
            }           
             update('posts', $f, "id = '$urledit'");           
            $_SESSION['return'] = '<span class="alert alert-success" style="float:left;">Sua P&aacute;gina foi atualizada com sucesso, voc&ecirc; pode visualiza-la <a href="'.BASE.'/sessao/'.$f['url'].'" target="_blanck" title="Ver p&aacute;gina">aqui</a></span>';
            header('Location: index2.php?exe=paginas/paginas-edit&editid='.$urledit);
            }
            }elseif(!empty($_SESSION['return']))
            {
                echo $_SESSION['return'];
                unset($_SESSION['return']);
            }
    }
?>
<form name="formulario" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
	<fieldset>
  	<legend>Editar P&aacute;gina: <strong> <?php  echo $postedit['titulo']; ?></strong></legend>
    <div class="control-group">
    <label class="control-label" for="titulo"><span>Nome da p&aacute;gina:</span></label>
    	<div class="controls">
        <input type="text" id="titulo" name="titulo" class="span4" value="<?php  echo $postedit['titulo']; ?>" />
    	</div>
     </div>
     <div class="control-group">   
     <label class="control-label" for="tags"><span>Tags:</span></label>
     	<div class="controls">
        <input type="text" id="tags" name="tags" class="span4" value="<?php echo $postedit['tags']; ?>" />
        </div>
    </div> 
    <div class="control-group">   
    <label class="control-label" for="content"><span>Conte&uacute;do:</span></label>
    	<div class="controls">
       <textarea id="content" name="content" class="span4" rows="15"><?php echo htmlspecialchars(stripcslashes($postedit['content'])); ?></textarea>
       </div>
    </div> 
    <div class="control-group">   
    <label class="control-label" for="data"><span>Data:</span></label>
    	<div class="controls">
        <input type="text" id="data" name="data" class="span4" value="<?php echo date('d/m/Y H:i:s',strtotime($postedit['data'])); ?>" />
   		</div>
    </div>      
    <div class="control-group">  
      <label class="control-label" for="nivel"><span>Permiss&atilde;o do artigo:</span></label>
      <div class="controls">                                                                      
            <label class="radio inline" for="radios-0"><input type="radio" value="0" id="radios-0" name="nivel" <?php if(!$f['nivel'] || $f['nivel'] == '0') echo ' checked="checked"'; ?>/> Livre</label>
            <label class="radio inline" for="radios-1"><input type="radio" value="4" id="radios-1" name="nivel" <?php if($f['nivel'] && $f['nivel'] == '4') echo ' checked="checked"'; ?> /> Leitor</label>
            <label class="radio inline" for="radios-2"><input type="radio" value="3" id="radios-2" name="nivel"<?php if($f['nivel'] && $f['nivel'] == '3') echo ' checked="checked"'; ?> /> Premium</label>
        </div>
    </div>  
    <label class="control-label" for="sendForm"></label>
    <div class="controls" id="sendForm">    
    <input type="submit" value="Atualizar P&aacute;gina" name="sendForm" class="btn btn-success" />
    </div>
    </div>      
</form>	
</section><!-- /bloco span8 -->
<?php }}else{header('Location: ../index2.php');}?>