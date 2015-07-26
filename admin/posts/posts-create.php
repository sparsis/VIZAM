<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
    header('Location: index2.php');
  }else
  {
    $urledit = $_GET['editid'];
      $readEdit = read('cat', "WHERE id = '$urledit'");
      if (!$readEdit) 
      {
        header('Location: index2.php?exe=posts/posts');
      }else
      {      
        foreach ($readEdit as $postedit);
?>
<section class="span8">
<a href="index2.php?exe=posts/posts" title="Listar" class="pull-right btn btn-primary">Listar Produtos</a>
<?php
    if (isset($_POST['sendForm'])) 
    {
        $f['titulo']    = htmlspecialchars(mysql_real_escape_string($_POST['titulo']));        
        $f['content']   = mysql_real_escape_string($_POST['content']);
		$f['cat_id']   = mysql_real_escape_string($urledit);
		$f['cat_pai']   = getCat($f['cat_id'], 'id_pai');		
		$f['preco']   = mysql_real_escape_string($_POST['preco']);
        $f['date']      = htmlspecialchars(mysql_real_escape_string($_POST['data']));      
        $f['nivel']     = htmlspecialchars(mysql_real_escape_string($_POST['nivel']));
        $f['status']    = ($_POST['sendForm']== 'Cadastrar' ? '0' : '1');
        $f['autor']     = $_SESSION['autUser']['id'];
        $f['tipo']      = 'post';                    
			if (in_array('', $f)) 
			{
			   echo '<span class="alert alert-info">Informe todos os Campos!</span>';
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
					
				if(!empty($_FILES['thumb']['tmp_name']))
            {
                $pasta = '../uploads/';
                $ano  =  date('Y');
                $mes  =  date('m');
                if (file_exists($pasta.$postedit['thumb']) && !is_dir($pasta.$postedit['thumb'])) 
                {
                 unlink($pasta.$postedit['thumb']);
                }
                if (!file_exists($pasta.$ano)) 
                {
                    mkdir($pasta.$ano,0755);
                }if(!file_exists($pasta.$ano.'/'.$mes)) 
                {
                    mkdir($pasta.$ano.'/'.$mes,0755);
                }
                $img = $_FILES['thumb'];
                $ext = substr($img['name'],-3);
                $f['thumb'] = $ano.'/'.$mes.'/'.$f['url'].'.'.$ext;
                uploadImage($img['tmp_name'], $f['url'].'.'.$ext, '960', $pasta.$ano.'/'.$mes.'/');
				}				
				create('posts', $f);				 
				if ($f['status'] == '1') 
				{
					echo '<span class="alert alert-success"> '.$f['titulo'].' cadastrado com sucesso, você pode visualiza-lo ';
					echo '<a href="'.BASE.'/produtos/'.$f['url'].'" target="_blanck" title="'.$f['titulo'].'">aqui</a></span>';
				}else
				{
					echo '<span class="alert alert-info">'.$f['titulo'].' registrado com sucesso. Para ativar é preciso ir em <a href="index2.php?exe=posts/posts" title="Editar Cadastros">Editar cadastros</a> e clicar em ativar!</span>';
				
				
				}
			}} 
?>
    <form name="formulario" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
    <fieldset>
  	<legend>Criar conte&uacute;do em :<strong class="alert alert-error"> <?php  echo $postedit['nome']; ?></strong></legend>    
    <div class="control-group">
     	<label class="control-label" for="thumb"><span>Foto de Exibi&ccedil;&atilde;o:</span></label>
     	<div class="controls">
        <input type="file" id="thumb" class="span4" name="thumb" />
        </div>
  	</div>
    <div class="control-group">
    	<label class="control-label" for="titulo"><span>Nome do Produto:</span></label>
    	<div class="controls">
        <input type="text" id="titulo" name="titulo" class="span4" value="<?php if ($f['titulo']) {echo $f['titulo'];} ?>" />
        </div>
    </div> <!-- 
      <div class="control-group">    
    	<label class="control-label" for="medidas"><span>Medidas:</span></label>
    	<div class="controls">
        <textarea id="medidas" name="medidas" class="span4" rows="5"><?php if ($f['medidas']) {echo $f['medidas'];} ?></textarea>
        </div>
    </div>   -->
    <div class="control-group">    
    	<label class="control-label" for="content"><span>Descri&ccedil;&atilde;o:</span></label>
    	<div class="controls">
        <textarea id="content" name="content" class="span4" rows="8"><?php if ($f['content']) {echo $f['content'];} ?></textarea>
        </div>
    </div>  <!-- 
    <div class="control-group">    
    	<label class="control-label" for="paginas"><span>P&aacute;ginas:</span></label>
    	<div class="controls">
        <textarea id="paginas" name="paginas" class="span4" placeholder="DEIXE NULO CASO N&Atilde;O TENHA ESSA INFORMA&Ccedil;&Atilde;O" rows="5"><?php// if ($f['paginas']) {echo $f['paginas'];} ?></textarea>
        </div>
    </div>         
     <div class="control-group">
    	 <label class="control-label" for="papel_tipo"><span>Tipo de Papel:</span></label>
     	<div class="controls">
        <input type="text" id="papel_tipo" name="papel_tipo" class="span4" value="<?php// if ($f['papel_tipo']) {echo $f['papel_tipo'];} ?>"/>
        </div>
    </div> 
  <!--  
    <div class="control-group">
  <label class="control-label" for="checkboxes">Cores Dispon&iacute;veis:</label>
  <div class="controls">
  <?php $readColor = read('colors'); foreach($readColor as $color):
   echo '<label class="checkbox inline span2" for="'.$color['color_name'].'">';
   echo '<input type="checkbox" name="'.$color['color_name'].'" id="'.$color['color_name'].'" value="'.$color['color_id'].'">';
  echo   '<span style="background-color:'.$color['color_hexadecimal'].'">&nbsp;&nbsp;&nbsp;&nbsp;</span> '.$color['color_name']; 
  echo '</label>';
  	endforeach;
    ?>    
  </div>
</div>   -->
    <div class="control-group">
    	 <label class="control-label" for="preco"><span>Pre&ccedil;o:</span></label>
     	<div class="controls">
        <input type="text" id="preco" name="preco" class="span4" value="<?php if ($f['preco']) {echo $f['preco'];} ?>" />
        </div>
    </div>       
    <div class="control-group">    
    	<label class="control-label" for="data"><span>Data:</span></label>
    	<div class="controls">
        <input type="text" id="data" name="data" class="span4" value="<?php  echo date('d/m/Y H:i:s',strtotime($postedit['data'])); ?>" />
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
    <div class="controls">
    <input type="submit" value="Cadastrar" id="sendForm" name="sendForm" class="btn btn-success" />
    <input type="submit" value="Cadastrar e Publicar" id="sendForm" name="sendForm" class="btn btn-info" />
    </div>
    </div>  
</fieldset>       
    </form>	
</section><!-- /bloco span8 -->
<?php }}}else{header('Location: ../index2.php');}?>