
<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
    header('Location: index2.php');
  }else
  {
  if (isset($_POST['sendFiltro'])) 
  {
     $search = $_POST['search'];
     if (!empty($search) && $search != 'Titulo:') 
     {
        $_SESSION['where'] = "AND titulo LIKE '%$search%'";
        header('Location: index2.php?exe=posts/posts ');
     }else
     {
        unset($_SESSION['where']);
        header('Location: index2.php?exe=posts/posts ');
     }
  }
?>
<section class="span8">
    <form name="filtro" action="" class="navbar-search" method="post">   
        <label>        
            <input type="text" name="search" class="radius" size="30" value="Titulo:" 
            onclick="if(this.value=='Titulo:')this.value=''" 
            onblur="if(this.value=='')this.value='Titulo:'"
            />
       </label>         
        <input type="submit" value="filtrar resultados" name="sendFiltro" class="btn" />
    </form>


<?php
    //ALTERA O STATUS DO POST
    if (isset($_GET['sts'])) 
    {
      $status   = $_GET['sts'];
      $topicoid = $_GET['id'];
      if ($status == '0') 
      {
        $datas = array('status' => '1' );
        update('posts',$datas,"id = '$topicoid'");
      }else
      {
        $datas = array('status' => '0' );
        update('posts',$datas,"id = '$topicoid'");
      }
    }
    //REMOVE O POST
    if (!empty($_GET['delid'])) 
    {
     $delid = $_GET['delid'];
     $thumb = $_GET['thumb'];
     $pasta = '../uploads/';
     $readGbdel = read('posts_gb', "WHERE post_id = '$delid'");
     if ($readGbdel) 
     {
        foreach ($readGbdel as $gbDel):
          if (file_exists($pasta.$gbDel['img']) && !is_dir($pasta.$gbDel['img']))
          { 
          unlink($pasta.$gbDel['img']);
          }
        endforeach;
        delete('posts_gb', "post_id = '$delid'");		
		
     }
     if (file_exists($pasta.$thumb) && !is_dir($pasta.$thumb))
     { 
        unlink($pasta.$thumb);
     }
       
		$readMesure = read('measures', "WHERE post_id = '$delid'");	
		if(!empty($readMesure))	{delete('measures', "post_id = '$delid'");}
		
		$readpager = read('pagers', "WHERE post_id = '$delid'");		
		if(!empty($readpager))	{delete('pagers', "post_id = '$delid'");}
		
		$readpaper = read('papers', "WHERE post_id = '$delid'");
		if(!empty($readpaper))	{delete('papers', "post_id = '$delid'");}
		
		$readcolor = read('post_colors', "WHERE post_id = '$delid'");
		if(!empty($readcolor))	{delete('post_colors', "post_id = '$delid'");}
		
		 delete('posts',"id = '$delid'");
    }
    $pag = (empty($_GET['pag']) ? '1': $_GET['pag']);
    $maximo = 10;
    $inicio = ($pag * $maximo) - $maximo;
    $readArt = read('posts', " WHERE tipo = 'post' {$_SESSION[where]} ORDER BY cat_id ASC LIMIT $inicio,$maximo");
    if (!$readArt) 
    {
        echo '<span class="alert alert-info">N&atilde;o Existe Registros para Listar</span>';
    }else 
    {	
        echo '<table class="table table-bordered table-hover">
			  <caption>Produtos:</caption>
			  <thead>
              <tr>
                 <th>categoria:</th>
                <th>data:</th>
				 <th>nome do produto:</th>
               
                <th>visitas:</th>
                <th colspan="4">a&ccedil;&otilde;es:</th>
              </tr>
			  </thead><tbody>';

        foreach ($readArt as $art):
        $views = ($art['visitas'] != '' ? $art['visitas'] : '0');
        $setIco =($art['status'] == '0' ? 'alert.png' : 'ok.png'); 
        $setAtv =($art['status'] == '0' ? 'ativar' : 'desativar');    
        echo '<tr>';
      
      
        echo '<td><a target="_blank" href="'.BASE.'/produtos/'.getCat($art['cat_id'],'url').'" title="'.getCat($art['cat_id'],'url').'">'.getCat($art['cat_id'],'nome').'</a></td>';
		 echo '<td>'.date('d/m/y H:i',strtotime($art['data'])).'</td>';
		echo '<td><a href="'.BASE.'/produto/'.$art['url'].'" title="'.$art['titulo'].'" target="_blank">'.lmWord($art['titulo'],30).'</a></td>';
        echo '<td>'.$views.'</td>';        
        echo '<td><a href="index2.php?exe=posts/posts-edit&editid='.$art['id'].'" title="editar"><img src="ico/edit.png" alt="editar" title="editar" /></a></td>  ';
        echo '<td><a href="index2.php?exe=posts/gallery&postid='.$art['id'].'" title="postar galeria"><img src="ico/gb.png" alt="postar galeria" title="postar galeria" /></a></td>';
        echo '<td><a href="index2.php?exe=posts/posts&pag='.$pag.'&sts='.$art['status'].'&id='.$art['id'].'" title="'.$setAtv.'"><img src="ico/'.$setIco.'" alt="'.$setAtv.'" title="'.$setAtv.'" /></a></td>';
        echo '<td><a href="index2.php?exe=posts/posts&pag='.$pag.'&delid='.$art['id'].'&thumb='.$art['thumb'].'" title="excluir"><img src="ico/no.png" alt="excluir" title="excluir" /></a></td>';
        echo '</tr>';        
        endforeach;
		echo '</tbody>';
        echo '</table>';
		
		
		
        $link = 'index2.php?exe=posts/posts&pag=';
        readPaginator('posts'," WHERE tipo = 'post' {$_SESSION[where]} ORDER BY data DESC", $maximo, $link, $pag);
    }
?>
</section><!-- /bloco span8 -->
<?php }}else{ header('Location: ../index2.php');}?>