<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
   echo '<span class="alert alert-error" style="float:left;">Desculpe, Você não tem permissão para gerenciar as páginas!</span>';
  }else
  {
?>
<section class="span8">
<a href="index2.php?exe=paginas/paginas" title="Paginas" class="pull-right label label-info">Listar Páginas</a>
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
            $f['url'] = setUri($f['titulo']);
            $readPostUri = read('posts', "WHERE url LIKE  '%$f[url]%'");
            if ($readPostUri) 
            {
                $f['url'] = $f['url'].'-'.count($readPostUri);
                $readPostUri = read('posts', "WHERE url = '$f[url]'");
                if ($readPostUri) 
                {
                $f['url'] = $f['url'].'_'.time();
                }
            }           
            create('posts', $f);           
                echo '<span class="alert alert-success" style="float:left;"> P&aacute;gina cadastrada com sucesso, voc&ecirc; pode visualiz&aacute;-la ';
                echo '<a href="'.BASE.'/sessao/'.$f['url'].'" target="_blanck" title="Ver p&aacute;gina">aqui</a></span>';           
        }     
    }
?>
<form name="formulario" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
 <fieldset>
	<legend>Publicar Nova P&aacute;gina:</legend>
	<div class="control-group">
    	<label class="control-label" for="titulo"><span>Nome da página:</span></label>
    	<div class="controls">
        <input type="text" class="span4" id="titulo" name="titulo" value="<?php if($f['titulo']) echo $f['titulo']; ?>" />
   		</div>
    </div>    
    <div class="control-group">
     	<label class="control-label" for="tags"><span>Tags:</span></label>
     	<div class="controls">
        <input type="text" id="tags" name="tags" class="span4" value="<?php if($f['tags']) echo $f['tags']; ?>" />
    	</div>
    </div>    
    <div class="control-group">   
    	<label class="control-label" for="content"><span class="data">Conteúdo:</span></label>
    	<div class="controls">
        <textarea id="content" name="content" class="span4" rows="15"><?php if($f['content']) echo htmlspecialchars(stripcslashes($f['content'])); ?></textarea>
   		</div>
    </div>    
    <div class="control-group">   
    	<label class="control-label" for="data"><span>Data:</span></label>
    	<div class="controls">
        <input type="text" id="data" name="data" class="span4" value="<?php if($f['date']) echo $f['date']; else echo date('d/m/Y H:i:s'); ?>" />
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
    <div class="control-group"> 
        <label class="control-label" for="sendForm"></label>
        <div class="controls" id="sendForm">  
        <input type="submit" value="Publicar Página" name="sendForm" class="btn btn-success" />
        </div>
    </div>    
 </fieldset>    
</form>	
</section><!-- /bloco span8 -->
<?php }}else{header('Location: ../index2.php');}?>