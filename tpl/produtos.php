<?php
$catUrl = mysql_real_escape_string($url[1]);
$readCat = read('cat', "WHERE url = '$catUrl'");
if (!$readCat) 
{
    header('Location: '.BASE.'/404');
}else
    foreach ($readCat as $cat);
?>
<?php 
setArq('tpl/header'); //Menu header
###########################################CARROUSSEL DAS CATEGORIAS ##############################################     			
		$readSlidea = read('carroussel',"WHERE cat_id = '$cat[id]' ORDER BY data DESC");
			foreach ($readSlidea as $slide);           
			echo'<section class="carousel slide" id="carrossel"> <!--section carrossel-->';
			echo'<div class="carousel-inner"> '; 
			echo '<div class="item active" >';               
			getThumb($slide['img'],$cat['nome'], $cat['nome'], '1200', '700', '', '', '#', 't');               
			echo	'<div class="carousel-caption"><h4>'.$cat['nome'].'</h4></div></div>'; 
		
			$readSlide = read('carroussel',"WHERE cat_id = '$cat[id]' AND id != '$slide[id]' ORDER BY data DESC");	 		 
			foreach ($readSlide as $slide):     
			echo   '<div class="item">';               
			getThumb($slide['img'],$cat['nome'], $cat['nome'], '1200', '700', '', '', '#', 't');               
			echo	'<div class="carousel-caption"><h4>'.$cat['nome'].'</h4></div></div>';
			endforeach;   ?>        	
 
    </div>
    <a href="#carrossel" class="carousel-control left" data-slide="prev" >&lsaquo;</a>
    <a href="#carrossel" class="carousel-control right" data-slide="next">&rsaquo;</a> 
    </section> <!--section carrossel-->     
    <?php #################################################### FIM DO CARROUSSEL#################################################?>    
<section>
    	<h1><?php echo $cat['nome']; ?></h1>         
          <ul class="nav nav-tabs">
       			 <li class="active"><a href="#tab1" data-toggle="tab"><?php echo $cat['nome']; ?></a></li>        
  		 </ul>
<div class="tab-content">
    <div class="tab-pane active" id="tab1">
        <p> Lista de <?php echo $cat['nome']; ?></p>         
         
    <?php  
         echo '<ul class="thumbnails">';
         $pag = (empty($url[3]) ? '1': $url[3]);
         $maximo = 8;
         $inicio = ($pag * $maximo) - $maximo;
         if ($cat['id_pai'] != '') 
         {
             $readProdutos = read('posts',"WHERE cat_id = '$cat[id]' AND tipo = 'post' AND status = '1' ORDER BY data DESC LIMIT $inicio, $maximo");
         }else
         {
             $readProdutos = read('posts',"WHERE cat_pai = '$cat[id]' AND tipo = 'post' AND status = '1' ORDER BY data DESC LIMIT $inicio, $maximo");     
         }
         foreach ($readProdutos as $art):
          
            echo '<li';
         
		    echo ' class="span4" ';
            echo '>';
			echo '<div class="thumbnail">';		
            getThumb($art['thumb'],$cat['nome'].'--'.$art['titulo'], $art['titulo'], '250', '200', '', '', '#','r');               
			echo '<h3>'.lmWord($art['titulo'],50).'</h3>';             
               echo '<p>'.lmWord($art['content'],50).'</p>';		
			   echo '<a title="Ver mais de '.$art['titulo'].'" href="'.BASE.'/produto/'.$art['url'].'" class="btn btn-large btn-block btn-primary">saiba mais ... </a>';
			echo '</div>';	
            echo '</li>';            
             endforeach;
        echo  '</ul>';
		echo '</div>';
		echo '</div>';
echo '</section>';
        $link = BASE.'/categoria/'.$cat['url'].'/page/';
        if ($cat['id_pai'] != '') 
        {
           readPaginator('posts'," WHERE cat_id = '$cat[id]' AND tipo = 'post' AND status = '1' ORDER BY data DESC", $maximo, $link, $pag,'870px');
        }else
        {
           readPaginator('posts'," WHERE cat_pai = '$cat[id]' AND tipo = 'post' AND status = '1' ORDER BY data DESC", $maximo, $link, $pag,'870px');   
        }

    ?>
  
	  
	  
	    
          
