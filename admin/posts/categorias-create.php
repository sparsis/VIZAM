<?php
if (function_exists('getUser')) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
    echo '<span class="alert alert-error" style="float:left;">Desculpe, Voc&ecirc; n&atilde;o tem permiss&atilde;o para gerenciar as categorias!</span>';
  }else
  {
?>
<section class="span8">       
<a href="index2.php?exe=posts/categorias" title="Voltar" class="pull-right btn-primary">Voltar</a>       
<?php  
 if (isset($_POST['sendForm'])) 
 {
     $f['nome']    = htmlspecialchars(stripcslashes(mysql_real_escape_string($_POST['nome'])));    
     $f['date']    = htmlspecialchars(stripcslashes(mysql_real_escape_string($_POST['data'])));
	 $f['tipo']	   = 'dropmenu' ;
     if (in_array('', $f)) 
     {
         echo '<span class="alert alert-info" style="float:left;">Preencha todos os Campos!</span>';
     }else
     {
        $f['data'] = formDate($f['date']); unset($f['date'] );
        $f['url'] = setUri($f['nome']);
        $readCatUri = read('cat', "WHERE url LIKE  '%$f[url]%'");
        if ($readCatUri) 
        {
            $f['url'] = $f['url'].'-'.count($readCatUri);
            $readCatUri = read('cat', "WHERE url = '$f[url]'");
            if ($readCatUri) 
            {
            $f['url'] = $f['url'].'_'.time();
            }
        }
        create('cat',$f);
        $_SESSION['return'] = '<span class="alert alert-success">Categoria criada com sucesso!</span>';
        header('Location: index2.php?exe=posts/categorias-create');
     }     
 }elseif (!empty( $_SESSION['return'])) 
 {
   echo  $_SESSION['return'];
   unset( $_SESSION['return']);
 }
?>
        <form name="formulario" action="" class="form-horizontal" method="post">
         <fieldset>
			<legend>Criar categoria:</legend>
            <div class="control-group">
            <label class="control-label" for="nome"><span>Nome:</span></label>
            	<div class="controls">
                <input type="text" id="nome" name="nome" class="span4" value="<?php if ($f['nome']) {echo $f['nome'];} ?>" />
                </div>
           </div>
            <div class="control-group">
            <label class="control-label" for="data"><span>Data:</span></label>
            	<div class="controls">
                <input type="text" class="span4" id="data" name="data" rows="3" value="<?php if($f['date']){ echo $f['date']; }else{ echo date('d/m/Y H:i:s'); }?>" />
                </div>
             </div>            
            <div class="control-group">	  
                 <label class="control-label" for="sendForm"></label>
                 <div class="controls" id="sendForm">
                <input type="submit" value="Criar Categoria" name="sendForm" class="btn btn-primary" />
                </div>
            </div>          
         </fieldset>    
        </form>	
</section><!-- /bloco span8 -->
<?php }}else{ header('Location: ../index2.php');}?>