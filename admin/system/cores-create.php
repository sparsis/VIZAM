<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
      echo '<span class="alert alert-error" style="float:left;">Desculpe, Voc&ecirc; n&atilde;o tem permiss&atilde;o para gerenciar as cores!</span>';
  }else
  {      
       
?>
<section class="span8">
<a href="index2.php?exe=system/cores" title="Artigos" class="pull-right label label-info">Listar Cores</a>
<?php
    if (isset($_POST['sendForm'])) 
    {
        $f['color_name']    		= htmlspecialchars(mysql_real_escape_string($_POST['color_name']));
        $f['color_hexadecimal']      = htmlspecialchars(mysql_real_escape_string($_POST['color_hexadecimal']));
         $f['color_rgb']    		= htmlspecialchars(mysql_real_escape_string($_POST['color_rgb']));        
        if (in_array('', $f)) 
        {
           echo '<span class="alert alert-info">Informe todos os Campos!</span>';
        }else
        {            
                $f['color_name_url'] = setUri($f['color_name']);
                $readPostUri = read('colors', "WHERE color_name_url LIKE  '%$f[color_name_url]%'");
                if ($readPostUri) 
                {
                  $f['color_name_url'] = $f['color_name_url'].'-'.count($readPostUri);
                  $readPostUrl = read('colors', "WHERE color_name_url = '$f[color_name_url]'");
                  if ($readPostUrl) 
                  {
                  $f['color_name_url'] = $f['color_name_url'].'_'.time();
                  }                
            	} 
				create('colors',$f);
				$_SESSION['return'] = '<span class="alert alert-success">Categoria criada com sucesso!</span>';
				header('Location: index2.php?exe=system/cores-create');
     }     
 }elseif (!empty( $_SESSION['return'])) 
 {
   echo  $_SESSION['return'];
   unset( $_SESSION['return']);
 }
?>
    <form name="formulario" action="" method="post" class="form-horizontal" >
    <fieldset>
  	<legend>Criar <strong>Cor:</strong></legend>   
    <div class="control-group">
    	<label class="control-label" for="color_name"><span>Color Name:</span></label>
    	<div class="controls">
        <input type="text" id="color_name" name="color_name" class="span4" value="<?php if ($f['color_name']) {echo $f['color_name'];} ?>" />
        </div>
    </div>  
     <div class="control-group">
    	 <label class="control-label" for="color_hexadecimal"><span>Color HEXA:</span></label>
     	<div class="controls">
        <input type="text" id="color_hexadecimal" name="color_hexadecimal" class="span4" value="<?php if ($f['color_hexadecimal']) {echo $f['color_hexadecimal'];} ?>" />
        </div>
    </div>
    <div class="control-group">
    	 <label class="control-label" for="color_rgb"><span>Color RGB:</span></label>
     	<div class="controls">
        <input type="text" id="color_rgb" name="color_rgb" class="span4" value="<?php if ($f['color_rgb']) {echo $f['color_rgb'];} ?>" />
        </div>
    </div>     
    <div class="control-group">
  <label class="control-label" for="checkboxes">Cores j&aacute; cadastradas:</label>
  <div class="controls">
  <?php $readColor = read('colors'); foreach($readColor as $color):
   echo '<label class="checkbox inline span2" for="'.$color['color_name'].'">';
   echo '<input type="checkbox" name="'.$color['color_name'].'" id="'.$color['color_name'].'" value="'.$color['color_id'].'">';
  echo   '<span style="background-color:'.$color['color_hexadecimal'].'">&nbsp;&nbsp;&nbsp;&nbsp;</span> '.$color['color_name']; 
  echo '</label>';
  	endforeach;
    ?>    
  </div>
</div>    
    <div class="control-group">
    <label class="control-label" for="sendForm"></label>
    <div class="controls">
    <input type="submit" value="Cadastrar nova Cor" id="sendForm" name="sendForm" class="btn btn-success" />
    </div>
    </div>  
</fieldset>       
    </form>	
</section><!-- /bloco span8 -->
<?php }}else{header('Location: ../index2.php');}?>