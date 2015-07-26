<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
    header('Location: index2.php');
  }else
  {
    $urledit = $_GET['editid'];
      $readEdit = read('colors', "WHERE color_id = '$urledit'");
      if (!$readEdit) 
      {
        header('Location: index2.php?exe=system/cores');
      }else
      {
      
        foreach ($readEdit as $postedit);
?>
<section class="span8">
<a href="index2.php?exe=system/cores" title="Cores" class="pull-right label label-info">Listar Cores</a>
<?php
    if (isset($_POST['sendForm'])) 
    {
         $f['color_name']    		= htmlspecialchars(mysql_real_escape_string($_POST['color_name']));
        $f['color_hexadecimal']      = htmlspecialchars(mysql_real_escape_string($_POST['color_hexadecimal']));
         $f['color_rgb']    		= htmlspecialchars(mysql_real_escape_string($_POST['color_rgb']));                          
        if (in_array('', $f)) 
        {
           echo '<span class="alert alert-info" style="float:left;">Informe todos os Campos!</span>';
        }else
        {
            if ($postedit['color_name'] != $f['color_name']) 
            {
                $f['color_name_url'] = setUri($f['color_name']);
                $readPostUri = read('colors', "WHERE color_name_url LIKE  '%$f[color_name_url]%' AND color_id != '$urledit'");
                if ($readPostUri) 
                {
                  $f['color_name_url'] = $f['color_name_url'].'-'.count($readPostUri);
                  $readPostUri = read('colors', "WHERE color_name_url = '$f[color_name_url]' AND color_id != '$urledit'");
                  if ($readPostUri) 
                  {
                  $f['color_name_url'] = $f['color_name_url'].'_'.time();
                  }
                }
            }else
            {
               $f['color_name_url'] = $postedit['color_name_url'];
            }            
            update('colors', $f, "color_id = '$urledit'");           
            $_SESSION['return'] = '<span class="alert alert-success" style="float:left;"">Cor atualizada com sucesso!</span>';
            header('Location: index2.php?exe=system/cores-edit&editid='.$urledit);
        }
        }elseif(!empty($_SESSION['return']))
            {
                echo $_SESSION['return'];
                unset($_SESSION['return']);
            }
     }      
?>
     <form name="formulario" action="" method="post" class="form-horizontal" >
    <fieldset>
  	<legend>Criar <strong>Cor:</strong></legend>   
    <div class="control-group">
    	<label class="control-label" for="color_name"><span>Color Name:</span></label>
    	<div class="controls">
        <input type="text" id="color_name" name="color_name" class="span4" value="<?php echo $postedit['color_name']; ?>" />
        </div>
    </div>  
     <div class="control-group">
    	 <label class="control-label" for="color_hexadecimal"><span>Color HEXA:</span></label>
     	<div class="controls">
        <input type="text" id="color_hexadecimal" name="color_hexadecimal" class="span4" value="<?php echo $postedit['color_hexadecimal']; ?>" />
        </div>
    </div>
    <div class="control-group">
    	 <label class="control-label" for="color_rgb"><span>Color RGB:</span></label>
     	<div class="controls">
        <input type="text" id="color_rgb" name="color_rgb" class="span4" value="<?php echo $postedit['color_rgb']; ?>" />
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
    <input type="submit" value="Atualizar" id="sendForm" name="sendForm" class="btn btn-success" />
    </div>
    </div>  
</fieldset>       
    </form>	
</section><!-- /bloco span8 -->
<?php }}else{header('Location: ../index2.php');}?>