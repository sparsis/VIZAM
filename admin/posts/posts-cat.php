<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
      header('Location: index2.php');
  }else
  {
?>
<section class="span8"><!--bloco form-->
<a href="index2.php?exe=posts/posts" title="Listar Produtos" class="pull-right btn btn-primary" >Listar Produtos</a>
<?php
    if (isset($_POST['sendForm'])) 
    {        
        $f['categoria'] = htmlspecialchars(mysql_real_escape_string($_POST['categoria'])); 				
                     
        if (in_array('', $f)) 
        {
           echo '<span class="alert alert-info">Informe uma categoria!</span>';
        }else
        {
            header('Location: index2.php?exe=posts/posts-create&editid='.$f['categoria']);     
           
        }
     
    }
?>
<form name="formulario" action="" method="post"  class="form-horizontal" enctype="multipart/form-data">
<fieldset>
<legend>Cadastrar novo conte&uacute;do:</legend>    
	<div class="control-group">
    <label class="control-label" for="categoria"><span>Select:</span></label> 
    	<div class="controls">
        <select id="categoria" class="input-xlarge span4" name="categoria">
            <option value="" >Selecione uma categoria &nbsp;&nbsp;</option>
            <?php $readCAtegoria =read('cat', "WHERE id_pai IS NULL");
			if (!$readCAtegoria){echo '<option value="">N&atilde;o encontramos categoria &nbsp;&nbsp;</option>';}
			else{
				$readCAtegoriaDrop =read('cat', "WHERE id_pai IS NULL AND tipo = 'dropmenu'");
						if($readCAtegoriaDrop){
						foreach ($readCAtegoriaDrop as $pai):					
							echo ' <option value="" disabled="disabled">'.$pai['nome'].'</option>';
							$readCategorias = read('cat', "WHERE id_pai = '$pai[id]' AND tipo = 0");
							if (!$readCategorias){echo ' <option value="" disabled="disabled">&raquo; &raquo; Cadastre uma sub Categoria aqui!</option>';}
							else{foreach ($readCategorias as $cat):                         
									echo ' <option value="'.$cat['id'].'"';
									if ($cat['id'] == $f['categoria']){echo 'selected ="selected"';} 
									echo '>&raquo; &raquo;'.$cat['nome'].'</option>';
								 endforeach;
								 }
						endforeach;
						}
						 $readCAtegoriaMenu =read('cat', "WHERE id_pai IS NULL AND tipo = 'menu'");
						 if($readCAtegoriaMenu)
						 {
					foreach ($readCAtegoriaMenu as $pai): echo ' <option value="'.$pai['id'].'">'.$pai['nome'].'</option>'; endforeach;
						 }
				 }
					 ?>            
        </select>
        </div>
    </div>    
    <div class="control-group">	  
      <label class="control-label" for="sendForm"></label>
    <div class="controls" id="sendForm">  
     <input type="submit" value="CONTINUAR" name="sendForm" class="btn btn-danger" />
    <!--<a href="index2.php?exe=posts/posts-create&editid='.$art['id'].'" class="btn btn-danger" title="editar">CONTINUAR </a>-->
    </div>
    </div>     
</fieldset>    
</form>	
</section><!--sapn8-->
<?php }}else{header('Location: ../index2.php');}?>