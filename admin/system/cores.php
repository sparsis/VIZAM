<?php
if (function_exists('getUser')) 
{
	if (!getUser($_SESSION['autUser']['id'], '1')) 
	{
		echo '<span class="alert alert-error">Desculpe, Voc&ecirc; n&atilde;o tem permiss&atilde;o para gerenciar as categorias!</span>';
	}else
	{
?>
<section class="span8">
	<a href="index2.php?exe=system/cores-create" title="Cadastrar Cores" class="pull-right label label-info">Cadastrar nova Cor</a>

	<?php
	if (!empty($_GET['delcor'])) 
	{
		$idDel = mysql_real_escape_string($_GET['delcor']);
		$readDelcor = read('colors', "WHERE color_id = '$idDel'");		
		if ($readDelcor) 
		{
			$del = delete('colors', "color_id = '$idDel'");
			echo '<span class="alert alert-success">Cor removida com sucesso !</span>';	
			
		}else{
			echo '<span class="alert alert-error pull-left"><h4>cor n&atilde;o encontrada!"</h4> </span>';
			}
	}	
	$readColors = read('colors' );
	if (!$readColors) 
	{
		echo '<span class="alert alert-info">N&atilde;o Existem resgistros de cores ainda !</span>';
	}else
	{
		######################################### CORES #####################################################
		echo '<table class="table table-bordered table-hover">
		<caption>cores: </caption>
			  <thead>
  			  <tr>
    		  <th>cores:</th>    		  
    		  <th>cores_Hexa:</th>
			   <th>cores_RGB:</th>
    		  <th colspan="2">a&ccedil;&otilde;es:</td>
  			  </tr>
			  </thead>
			  <tbody>';
  		foreach ($readColors as $color): 
  		$catTags = ($color['tags'] != '' ? 'ok.png' : 'no.png');
  		echo '<tr>';
  		echo '<td style="text-align:left;"><span style="background-color:'.$color['color_hexadecimal'].';">&nbsp;&nbsp;&nbsp;&nbsp;</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$color['color_name'].'</span> </td>';  	
  		echo '<td>'.$color['color_hexadecimal'].'</td>';
		echo '<td>'.$color['color_rgb'].'</td>';
  		echo '<td><a href="index2.php?exe=system/cores-edit&editid='.$color['color_id'].'"';
  			echo 'title="editar cor '.$color['color_name'].'"><img src="ico/edit.png" alt="editar cor '.$color['color_name'].'" ';
			echo 'title="editar cor '.$color['color_name'].'" /></a></td>';						
		echo '<td><a href="index2.php?exe=system/cores&delcor='.$color['color_id'].'"';	
			echo 'title="deletar cor '.$color['color_name'].'"><img src="ico/no.png" alt="deletar cor '.$color['color_name'].'" ';
			echo 'title="deletar cor '.$color['color_name'].'" /></a></td>';		
		echo '</tr>';
		endforeach;
	echo '</tbody>';
	echo '</table>';
		######################################### FIM CORES#####################################################	
		
	}
?>
</section><!-- bloco span8 -->
<?php }}else{header('Location: ../index2.php');}?>