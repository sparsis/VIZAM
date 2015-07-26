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
<a href="index2.php?exe=posts/cad-menu" title="Criar nova categoria" class="pull-right btn btn-primary">Criar Menu</a>
	<?php
	if (!empty($_GET['delcat'])) 
	{
		$idDel = mysql_real_escape_string($_GET['delcat']);
		$readDelcatm = read('cat', "WHERE id_pai = '$idDel'");
		$readDelcat = read('carroussel', "WHERE cat_id = '$idDel'");
		if (!$readDelcatm AND !$readDelcat) 
		{
			$del = delete('cat', "id = '$idDel'");
			echo '<span class="alert alert-success">Categoria removida com sucesso !</span>';		
		}else{
			echo '<span class="alert alert-error pull-left"><h4>Se for "Menu"</h4> delete as imagens pertencentes a ele antes de exclu&iacute;-lo. Para excluir as imagens v&aacute; em <a href="index2.php?exe=posts/car-menu" title="Editar Imagens">Carroussel Menu</a> e selecione este Menu!</span>
			<span class="alert alert-info pull-left"><h4>Se for "Menu Dopdown"</h4> delete os Sub Menus pertencentes a ele antes de exclu&iacute;-lo. </span>';
			}
	}
	if (!empty($_GET['delsub']))	
	{
	$idDel = mysql_real_escape_string($_GET['delsub']); 
	$readDelcatSub = read('carroussel', "WHERE cat_id = '$idDel'");
	if(!$readDelcatSub){
		
		$del = delete('cat', "id = '$idDel'");
		echo '<span class="alert alert-success">Categoria removida com sucesso!</span>';
	}else{
			echo '<span class="alert alert-error pull-left">Delete as imagens deste Sub Menu antes de exclu&iacute;-lo. Para excluir as imagens selecione o Carroussel respectivo em <a href="index2.php?exe=posts/posts-carroussel" title="Editar Imagens">Carroussel Menu Dopdwon</a>!</span>';
			}
	}
	$pag = (empty($_GET['pag']) ? '1': $_GET['pag']);
	$maximo = 10;
	$inicio = ($pag * $maximo) - $maximo;
	$readCatm = read('cat' ,"WHERE id_pai IS NULL AND tipo = 'menu' LIMIT $inicio, $maximo");
	$readCat = read('cat' ,"WHERE id_pai IS NULL AND tipo != 'menu' LIMIT $inicio, $maximo");
	if (!$readCat OR !$readCatm) 
	{
		echo '<span class="alert alert-info">N&atilde;o Existem resgistros de categorias ainda !</span>';
	}else
	{
				#########################################MENU #####################################################
		echo '<table class="table table-bordered table-hover">
		<caption>Menus: </caption>
			  <thead>
  			  <tr>
    		  <th>categoria:</th>    		  
    		  <th>criada:</th>
    		  <th colspan="2">a&ccedil;&otilde;es:</td>
  			  </tr>
			  </thead>
			  <tbody>';
  		foreach ($readCatm as $cat): 
  		$catTags = ($cat['tags'] != '' ? 'ok.png' : 'no.png');
  		echo '<tr>';
  		echo '<td><span class="icon-forward"></span><span class="label label-inverse">'.$cat['nome'].'</span> </td>';  	
  		echo '<td>'.date('d/m/Y H:i', strtotime($cat['data'])).'</td>';
  		echo '<td><a href="index2.php?exe=posts/categorias-edit&edit='.$cat['id'].'"';
  			echo 'title="editar categoria '.$cat['nome'].'"><img src="ico/edit.png" alt="editar categoria '.$cat['nome'].'" ';
			echo 'title="editar categoria '.$cat['nome'].'" /></a></td>';		
		echo '<td><a href="index2.php?exe=posts/categorias&delcat='.$cat['id'].'"';	
			echo 'title="deletar categoria '.$cat['nome'].'"><img src="ico/no.png" alt="deletar categoria '.$cat['nome'].'" ';
			echo 'title="deletar categoria '.$cat['nome'].'" /></a></td>';		
		echo '</tr>';
		endforeach;
	echo '</tbody>';
	echo '</table>';
		#########################################MENU DROPDOWN#####################################################	
   echo '<a href="index2.php?exe=posts/categorias-create" title="Criar nova categoria" class="pull-right btn btn-primary">Criar Menu Dropdown</a>';
		echo '<table class="table table-bordered table-hover">
		<caption>Menus Dropdown: </caption>
			  <thead>
  			  <tr>
    		  <th>categoria:</th>    		  
    		  <th>criada:</th>
    		  <th colspan="3">a&ccedil;&otilde;es:</td>
  			  </tr>
			  </thead>
			  <tbody>';
  		foreach ($readCat as $cat): 
  		$catTags = ($cat['tags'] != '' ? 'ok.png' : 'no.png');
  		echo '<tr>';
  		echo '<td><span class="icon-forward"></span><span class="label label-inverse">'.$cat['nome'].'</span> </td>';  	
  		echo '<td>'.date('d/m/Y H:i', strtotime($cat['data'])).'</td>';
  		echo '<td><a href="index2.php?exe=posts/categorias-edit&edit='.$cat['id'].'"';
  			echo 'title="editar categoria '.$cat['nome'].'"><img src="ico/edit.png" alt="editar categoria '.$cat['nome'].'" ';
			echo 'title="editar categoria '.$cat['nome'].'" /></a></td>';
		echo '<td><a href="index2.php?exe=posts/categorias-subcreate&idpai='.$cat['id'].'&uri='.$cat['url'].'"';	
			echo 'title="Criar sub categoria"><img src="ico/new.png" alt="Criar sub categoria" ';
			echo 'title="Criar sub categoria" /></a></td>';	
		echo '<td><a href="index2.php?exe=posts/categorias&delcat='.$cat['id'].'"';	
			echo 'title="deletar categoria '.$cat['nome'].'"><img src="ico/no.png" alt="deletar categoria '.$cat['nome'].'" ';
			echo 'title="deletar categoria '.$cat['nome'].'" /></a></td>';		
		echo '</tr>';
	

		
		$readSubCat = read('cat', "WHERE id_pai = '$cat[id]'");
		if ($readSubCat) 
		{
			foreach ($readSubCat as $catSub): 
			$catSubTags = ($catSub['tags'] != ''? 'ok.png' : 'no.png');
			echo '<tr>';
			echo '<td>&raquo;&raquo;'.$catSub['nome'].'</td>';		
			echo '<td>'.date('d/m/Y H:i', strtotime($catSub['data'])).'</td>';
			echo '<td colspan="2"><a href="index2.php?exe=posts/categorias-edit&edit='.$catSub['id'].'&uri='.$cat['url'].'"';
				echo 'title="editar categoria '.$catSub['nome'].'"><img src="ico/edit.png" alt="editar categoria '.$catSub['nome'].'" ';
				echo 'title="editar categoria '.$catSub['nome'].'" /></a></td>';		
			echo '<td><a href="index2.php?exe=posts/categorias&delsub='.$catSub['id'].'"';	
				echo 'title="deletar categoria '.$catSub['nome'].'"><img src="ico/no.png" alt="deletar categoria '.$catSub['nome'].'" ';
				echo 'title="deletar categoria '.$catSub['nome'].'" /></a></td>';
			echo '</tr>';
			endforeach;
	}
	endforeach;
	echo '</tbody>';
	echo '</table>';
	$link = 'index2.php?exe=posts/categorias&pag=';
	readPaginator('cat',"WHERE id_pai IS null", $maximo, $link, $pag);
	}
?>
</section><!-- bloco span8 -->
<?php }}else{header('Location: ../index2.php');}?>