
<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
   echo '<span class="alert alert-error" style="float:left;">Desculpe, Voc&ecirc; n&atilde;to tem permiss&atilde;o para gerenciar as p&aacute;ginas!</span>';
  }else
  {
 
?>
<section class="span8">
<?php
    //REMOVE A PAGINAS
    if (!empty($_GET['delid'])) 
    {
     $delid = $_GET['delid'];     
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
      delete('posts',"id = '$delid'");
    }
    $pag = (empty($_GET['pag']) ? '1': $_GET['pag']);
    $maximo = 10;
    $inicio = ($pag * $maximo) - $maximo;
    $readArt = read('posts', " WHERE tipo = 'pagina' {$_SESSION[where]} ORDER BY data DESC LIMIT $inicio,$maximo");
    if (!$readArt) 
    {
        echo '<span class="alert alert-info" style="float:left;">N&atilde;to Existe Registros de P&aacute;ginas!</span>';
    }else 
    {
        echo '<table class="table table-bordered table-hover">
		<caption>P&aacute;ginas: </caption>
			  <thead>
              <tr>
                <th>nome:</th>
                <th>resumo:</th>
                <th>tags:</th>
                <th>criada:</th>
                <th colspan="3">a&ccedil;&otilde;tes:</th>
              </tr>
			  </thead>
			  <tbody>';
        foreach ($readArt as $art):  
        $setIco =($art['tags'] == '' ? 'alert.png' : 'ok.png');        
        echo '<tr>';
        echo '<td><a href="'.BASE.'/sessao/'.$art['url'].'" title="'.$art['titulo'].'" target="_blank">'.lmWord($art['titulo'],20).'</a></td>';
        echo '<td>'.lmWord($art['content'],35).' </td>';
        echo '<td><img src="ico/'.$setIco.'" alt="'.$$art['tags'].'" title="'.$art['tags'].'" /></a></td>';
        echo '<td>'.date('d/m/y H:i',strtotime($art['data'])).'</td>';       
        echo '<td><a href="index2.php?exe=paginas/paginas-edit&editid='.$art['id'].'" title="editar"><img src="ico/edit.png" alt="editar" title="editar" /></a></td>  ';
        echo '<td><a href="index2.php?exe=paginas/gallery&postid='.$art['id'].'" title="postar galeria"><img src="ico/gb.png" alt="postar galeria" title="postar galeria" /></a></td>';
        echo '<td><a href="index2.php?exe=paginas/paginas&pag='.$pag.'&delid='.$art['id'].'" title="excluir página"><img src="ico/no.png" alt="excluir página" title="excluir página" /></a></td>';
        echo '</tr>';        
        endforeach;
		echo '</tbody>';
        echo '</table>';
        $link = 'index2.php?exe=paginas/paginas&pag=';
        readPaginator('posts'," WHERE tipo = 'pagina' {$_SESSION[where]} ORDER BY data DESC", $maximo, $link, $pag);
    }
?>
</section><!-- bloco span8-->
<?php }}else{header('Location: ../index2.php');}?>