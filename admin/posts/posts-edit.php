<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
    header('Location: index2.php');
  }else
  {
      $urledit = $_GET['editid'];
	  $message = $_GET['message'];	  
	  $delmeasure = $_GET['delmeasure'];
	  $delpager = $_GET['delpage'];
	  $delpaper= $_GET['delpaper'];
	  $delcor = $_GET['delcor'];		 
      $readEdit = read('posts', "WHERE id = '$urledit'");
      if (!$readEdit) 
     {
       header('Location: index2.php?exe=posts/posts');
     }else
      { 
	 
	  if(!empty($delmeasure))
			{
				delete('measures', "post_id = '$delmeasure'");
				echo '<span class="alert alert-success">Campo deletado com sucesso!</span>';
			}
	  if(!empty($delpager))
			{			
				delete('pagers', "post_id = '$delpager'");
				echo '<span class="alert alert-success">Campo deletado com sucesso!</span>';				
			}
	  if(!empty( $delpaper))
			{
				delete('papers', "post_id = '$delpaper'");
				echo '<span class="alert alert-success">Campo deletado com sucesso!</span>';
			}
	  if(!empty($delcor))
			{
				delete('post_colors', "post_id = '$delcor'");
				echo '<span class="alert alert-success">Campo deletado com sucesso!</span>';
			}	  
	       
        foreach ($readEdit as $postedit);
echo '<section class="span8">';
		if($message){echo '<span class="alert alert-error span8">Esse Produto j&aacute; possui este campo cadastrado! Edite abaixo se desejar ou delete! </span>';}
echo '<span class="alert alert-info span8">Clique nos Bot&otilde;es para adicionar mais campos :</span>';
echo '<a href="index2.php?exe=posts/posts-measures&editid='.$postedit['id'].'" title="Artigos" class="btn btn-danger">Medidas</a>';
echo '<a href="index2.php?exe=posts/posts-pagers&editid='.$postedit['id'].'" title="Artigos" class="btn btn-danger">P&aacute;ginas</a>';
echo '<a href="index2.php?exe=posts/posts-papers&editid='.$postedit['id'].'" title="Artigos" class="btn btn-danger">Tipo de Papel</a>';
echo '<a href="index2.php?exe=posts/posts-colors&editid='.$postedit['id'].'" title="Artigos" class="btn btn-danger">Cores</a>';
echo '<a href="index2.php?exe=posts/posts" title="Listar Produtos" class="pull-right btn btn-primary">Listar Produtos</a>';
    if (isset($_POST['sendForm'])) 
    {
        $f['titulo']    = htmlspecialchars(mysql_real_escape_string($_POST['titulo']));      
        $f['content']   = mysql_real_escape_string($_POST['content']);
        $f['date']      = htmlspecialchars(mysql_real_escape_string($_POST['data']));
        $f['cat_id'] = htmlspecialchars(mysql_real_escape_string($_POST['categoria'])); 
		$f['cat_pai']   = getCat($f['cat_id'], 'id_pai');     
        $f['nivel']     = htmlspecialchars(mysql_real_escape_string($_POST['nivel']));
        $f['status']    = ($_POST['sendForm']== 'Salvar' ? '0' : '1');
        $f['autor']     = $_SESSION['autUser']['id'];
        $f['tipo']      = 'post';                    
        if (in_array('', $f)) 
        {
           echo '<span class="alert alert-info">Informe todos os Campos!</span>';
        }else
        {	if(!empty($_POST['paginas']))
			{
				$g['post_id'] = $postedit['id'] ;
				$g['paginas'] =	htmlspecialchars(mysql_real_escape_string($_POST['paginas']));;
				update('pagers',$g ,"post_id = '$urledit' ");
			}
			if(!empty($_POST['medidas']))
			{
				$h['post_id'] = $postedit['id'] ;
				$h['measure'] =	htmlspecialchars(mysql_real_escape_string($_POST['medidas']));;
				update('measures',$h ,"post_id = '$urledit' ");
			}if(!empty($_POST['papel_tipo']))
			{
				$i['post_id'] = $postedit['id'] ;
				$i['paper_type'] =	htmlspecialchars(mysql_real_escape_string($_POST['papel_tipo']));;
				update('papers',$i ,"post_id = '$urledit' ");
			}									
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
            update('posts', $f, "id = '$urledit'");           
            $_SESSION['return'] = '<span class="alert alert-success" style="float:left;"">Seu Artigo foi atualizado com sucesso, voc&ecirc; pode visualiza-lo <a href="'.BASE.'/categoria/'.$f['url'].'" target="_blanck" title="Ver artigo">aqui</a>, ou precione <span class="label label-info">"F5"</span> para recarregar a p&aacute;gina e verificar as altera&ccedil;&otilde;es caso elas n&atilde;o aparecerem de imediato!</span>';
            header('Location: index2.php?exe=posts/posts-edit&editid='.$urledit);
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
  	<legend>Editar artigo:<strong style="color:#900"> <?php  echo $postedit['titulo']; ?></strong></legend>
<!--------------------------------------------------------------------------------------------------FOTO   --->   
    <div class="controls"><?php if ($postedit['thumb'] != '' && file_exists('../uploads/'.$postedit['thumb'])){
  echo '<a href="../uploads/'.$postedit['thumb'].'" title="Ver Imagem" rel="Shadowbox"><img src="../thumb.php?src='.BASE.'/uploads/'.$postedit['thumb'].'&w=80&h=100&zc1&q=100" title="'.$postedit['titulo'].'" alt="'.$postedit['titulo'].'" /></a>';
}else{  echo 'Sem Imagem: ';} ?>
	</div> 	
    <div class="control-group">
     	<label class="control-label"  for="thumb"><span>Foto de Exibi&ccedil;&atilde;o:</span></label>
     	<div class="controls">
        <input type="file" id="thumb" class="span4"  name="thumb" />
        </div>
  	</div>
<!-----------------------------------------/FOTO --------------------------------------------->     
    <div class="control-group">
    	<label class="control-label" for="titulo"><span>Nome do Produto:</span></label>
    	<div class="controls">
        <input type="text" id="titulo" name="titulo" class="span4" value="<?php echo $postedit['titulo']; ?>" />
        </div>
    </div>
  
    <div class="control-group">    
    	<label class="control-label" for="content"><span>Descri&ccedil;&atilde;o:</span></label>
    	<div class="controls">
        <textarea id="content" name="content" class="span4" rows="5"><?php echo htmlspecialchars(stripcslashes($postedit['content'])); ?></textarea>
        </div>
    </div>
     <div class="control-group">
    	 <label class="control-label" for="preco"><span>Pre&ccedil;o:</span></label>
     	<div class="controls">
        <input type="text" id="preco" name="preco" class="span4" value="<?php echo $postedit['preco']; ?>" />
        </div>
    </div> 
<!--------------------------------------------------------------------------------------------------MEDIDAS  ---> 
    <?php $readMeasure = read('measures',"WHERE post_id = '$urledit'"); if($readMeasure){ foreach($readMeasure as $measure); 
	   echo '<div class="controls"><a href="index2.php?exe=posts/posts-edit&editid='.$postedit['id'].'&delmeasure='.$postedit['id'].'&del=true" title="Deletar Medidas" class="btn btn-danger">Deletar Medidas</a></div>'; ?>    
     <div class="control-group">    
    	<label class="control-label" for="medidas"><span>Medidas:</span></label>
    	<div class="controls">
        <textarea id="medidas" name="medidas" class="span4" rows="5"><?php echo htmlspecialchars(stripcslashes($measure['measure'])); ?></textarea>
        </div>
    </div> 
     <?php } ?>
<!------------------------------------------/MEDIDAS ------------------------------------------>  
<!--------------------------------------------------------------------------------------------------PAGINAS  --->       
	<?php $readPagers = read('pagers',"WHERE post_id = '$urledit'"); if($readPagers){ foreach($readPagers as $pager); 
	   echo '<div class="controls"><a href="index2.php?exe=posts/posts-edit&editid='.$postedit['id'].'&delpage='.$postedit['id'].'&del=true" title="Deletar P&aacute;ginas" class="btn btn-danger">Deletar P&aacute;ginas</a></div>'; ?>
      <div class="control-group">    
    	<label class="control-label" for="paginas"><span>P&aacute;ginas:</span></label>
    	<div class="controls">
        <textarea id="paginas" name="paginas" class="span4" rows="5"><?php echo htmlspecialchars(stripcslashes($pager['paginas'])); ?></textarea>
        </div>
    </div> 
    <?php } ?>   
<!------------------------------------------/PAGINAS  ------------------------------------------>     
<!--------------------------------------------------------------------------------------------------TIPO DE PAPEL  --->   
    <?php $readPapers = read('papers',"WHERE post_id = '$urledit'"); if($readPapers){ foreach($readPapers as $paper); 
    echo '<div class="controls"><a href="index2.php?exe=posts/posts-edit&editid='.$postedit['id'].'&delpaper='.$postedit['id'].'&del=true" title="Deletar Tipo de Papel" class="btn btn-danger">Deletar Tipo de Papel</a></div>'; ?>
       <div class="control-group">
    	 <label class="control-label" for="papel_tipo"><span>Tipo de Papel:</span></label>
     	<div class="controls">
           <textarea id="papel_tipo" name="papel_tipo" class="span4" rows="3"><?php echo htmlspecialchars(stripcslashes($paper['paper_type'])); ?></textarea>
       
        </div>
    </div> 
    <?php } ?> 
<!-----------------------------------------/TIPO DE PAPEL  -------------------------------------->     
<!--------------------------------------------------------------------------------------------------COR  --->
        <?php $readColors = read('post_colors',"WHERE post_id = '$urledit'"); if($readColors){ foreach($readColors as $color):
    echo '<div class="controls"><a href="index2.php?exe=posts/posts-edit&editid='.$postedit['id'].'&delcor='.$postedit['id'].'&del=true" title="Deletar Cores" class="btn btn-danger">Deletar Cores</a></div>'; ?>
     <div class="control-group">
  <label class="control-label" for="checkboxes">Cores Dispon&iacute;veis:</label>  
  <div class="controls">
  <?php 
$colors = array_values(explode(',', $color['color_post']));foreach($colors as $cor):
$cores = strtr($cor,"'", " ");
echo   '<br><span style="background-color:'.$cores.';border:#2A3F00 solid 2px;">&nbsp;&nbsp;&nbsp;&nbsp;</span> --'.$cores;
	endforeach;
  	endforeach;?>    
  </div>
</div>  
 <?php } ?>
 <!----------------------------------------/COR  ------------------------------------------------>   
 <!--------------------------------------------------------------------------------------------------CATEGORIA --->   
    <div class="control-group"> 
    	<label class="control-label" for="categoria"><span>Categoria:</span></label>
    	<div class="controls">
        <select id="categoria" name="categoria" class="input-xlarge span4">
        	<?php  $readCAtegoria =read('cat', "WHERE id = '$postedit[cat_id]'"); foreach($readCAtegoria as $cat);?>
            <option value="<?php echo $postedit['cat_id']; ?>" ><?php echo $cat['nome']; ?></option>
            <?php 
                 $readCAtegoriaPai =read('cat', "WHERE id_pai IS NULL AND tipo = 'dropmenu'");
                 if (!$readCAtegoriaPai) 
                 {
                    echo '<option value="">N&atilde;o encontramos categoria &nbsp;&nbsp;</option>';
                 }else
                 {
                    foreach ($readCAtegoriaPai as $pai):
					
                     echo ' <option value=""disabled="disabled">'.$pai['nome'].'</option>';
                     $readCategorias = read('cat', "WHERE id_pai = '$pai[id]'");
                     if (!$readCategorias) 
                     {
                        echo ' <option value="" disabled="disabled">&raquo; &raquo; Cadastre uma sub Categoria aqui!</option>'; 
                     }else
                     {
                          foreach ($readCategorias as $cat):                         
                          echo ' <option value="'.$cat['id'].'"';
                           if ($cat['id'] ==  $postedit['categoria']) 
                           {
                                echo 'selected ="selected"';
                            } 
                          echo '>&raquo; &raquo;'.$cat['nome'].'</option>';
                          endforeach;
                     }
                    endforeach;
                 }
                   ?>            
        </select>
        </div>
   </div>  
  <!----------------------------------------------------/CATEGORIA ----------------------------------> 
  <!--------------------------------------------------------------------------------------------------PERMISSÃO  --->    
   <div class="control-group">  
      <label class="control-label" for="nivel"><span>Permiss&atilde;o do artigo:</span></label>
      <div class="controls">                                                                      
            <label class="radio inline" for="radios-0"><input type="radio" value="0" id="radios-0" name="nivel" <?php if(!$f['nivel'] || $f['nivel'] == '0') echo ' checked="checked"'; ?>/> Livre</label>
            <label class="radio inline" for="radios-1"><input type="radio" value="4" id="radios-1" name="nivel" <?php if($f['nivel'] && $f['nivel'] == '4') echo ' checked="checked"'; ?> /> Leitor</label>
            <label class="radio inline" for="radios-2"><input type="radio" value="3" id="radios-2" name="nivel"<?php if($f['nivel'] && $f['nivel'] == '3') echo ' checked="checked"'; ?> /> Premium</label>
        </div>
    </div> 
   <!------------------------------------/PERMISSÃO --------------------------------------------------> 
    <div class="control-group">    
    	<label class="control-label" for="data"><span>Data:</span></label>
    	<div class="controls">
        <input type="text" id="data" name="data" class="span4" value="<?php  echo date('d/m/Y H:i:s',strtotime($postedit['data'])); ?>" />
        </div>
    </div>  
    <div class="control-group">
    <label class="control-label" for="sendForm"></label>
    <div class="controls">
    <input type="submit" value="Atualizar Artigo" id="sendForm" name="sendForm" class="btn btn-success" />
    </div>
    </div>  
</fieldset>       
    </form>	
</section><!-- /bloco span8 -->
<?php }}else{header('Location: ../index2.php');}?>