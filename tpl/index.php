<?php setArq('tpl/header'); 
 ###########################################CARROUSSEL DOS MENUS ############################################## 
$catUrl = mysql_real_escape_string($url[1]);
$readCat = read('cat', "WHERE url = '$catUrl'");

if (!$readCat) 
{	   		$readCat = read('cat', "WHERE tipo = 'menu' AND url = 'home'"); foreach ($readCat as $cat);			
			$readSlidea = read('carroussel',"WHERE cat_id = '$cat[id]' ORDER BY data DESC");			
		    foreach ($readSlidea as $slide);           
		echo'<section class="carousel slide" id="carrossel"> <!--section carrossel-->';
    	echo'<div class="carousel-inner"> '; 
		    echo '<div class="item active" >';               
            getThumb($slide['img'],$cat['nome'], $cat['nome'], '1200', '700', '', '', '#', 't');               
             echo	'<div class="carousel-caption">
             		<h4>'.$cat['nome'].'</h4>                    
                    </div>
                </div>'; 
				$slidemenu = $slide['id'];
				$readSlide = read('carroussel',"WHERE cat_id = '$cat[id]' AND id != '$slidemenu' ORDER BY data DESC");	 		 
		        foreach ($readSlide as $slide):     
             echo   '<div class="item">';               
            getThumb($slide['img'],$cat['nome'], $cat['nome'], '1200', '700', '', '', '#', 't');               
             echo	'<div class="carousel-caption">
             		<h4>'.$cat['nome'].'</h4>                   
                    </div>
                </div>';
                endforeach;   ?>                
    </div>
    <a href="#carrossel" class="carousel-control left" data-slide="prev" >&lsaquo;</a>
    <a href="#carrossel" class="carousel-control right" data-slide="next">&rsaquo;</a> 
    </section> <!--section carrossel-->   
    <?php
}else {
    foreach ($readCat as $cat);	
			$readSlidea = read('carroussel',"WHERE cat_id = '$cat[id]' ORDER BY data DESC");			
		    foreach ($readSlidea as $slide);           
		echo'<section class="carousel slide" id="carrossel"> <!--section carrossel-->';
    	echo'<div class="carousel-inner">'; 
		    echo '<div class="item active" >';               
            getThumb($slide['img'],$cat['nome'], $cat['nome'], '1200', '700', '', '', '#', 't');               
             echo	'<div class="carousel-caption">
             		<h4>'.$cat['nome'].'</h4>                    
                    </div>
                </div>'; 
				$slidemenu = $slide['id'];
				$readSlide = read('carroussel',"WHERE cat_id = '$cat[id]' AND id != '$slidemenu' ORDER BY data DESC");	 		 
		        foreach ($readSlide as $slide):     
             echo   '<div class="item">';               
            getThumb($slide['img'],$cat['nome'], $cat['nome'], '1200', '700', '', '', '#', 't');               
             echo	'<div class="carousel-caption">
             		<h4>'.$cat['nome'].'</h4>                   
                    </div>
                </div>';
                endforeach;   ?>                
    </div>
    <a href="#carrossel" class="carousel-control left" data-slide="prev" >&lsaquo;</a>
    <a href="#carrossel" class="carousel-control right" data-slide="next">&rsaquo;</a> 
    </section> <!--section carrossel-->      
    <?php }
#################################################### FIM DO CARROUSSEL#################################################?> 
<section>
  <h3>Conhe&ccedil;a Nossas Categorias</h3>
    <?php $exib = read('(SELECT DISTINCT cat_id FROM posts) posts');  foreach ($exib as $ex):
		$exibCat = read('cat',"WHERE id = '$ex[cat_id]' ");	foreach ($exibCat as $cat): ?>
  <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab"><?php echo $cat['nome']; ?></a></li>
   </ul>
    <div class="tab-content">
    	<div class="tab-pane active" id="tab1">
        <?php echo '<p><a title="'.$cat['nome'].' | '.SITENAME.'" href="'.BASE.'/produtos/'.$cat['url'].'">'.$cat['nome'].'</a></p>'; ?>       
   <!-- AQUI TERÁ UM LOOP DE PRODUTOS --->         
            <ul class="thumbnails">
          <?php
			   $postList = read('posts', "WHERE cat_id = '$ex[cat_id]' AND status = '1' ORDER BY visitas LIMIT 3");  foreach ($postList as $list): 
		echo '<li class="span4">';
    	echo'<div class="thumbnail">';
		 getThumb($list['thumb'],$list['titulo'],$list['titulo'],'250', '200', '', '', '#','r', BASE.'/uploads/'.$list['thumb'],''); 
		echo '<h3>'.lmWord($list['titulo'],50).'</h3>';             
               echo '<p>'.lmWord($list['content'],50).'</p>';		
			   echo '<a title="Ver mais de '.$list['titulo'].'" href="'.BASE.'/produto/'.$list['url'].'" class="btn btn-large btn-block btn-primary">saiba mais ... </a>';
		
		echo '</div>';
  		echo '</li>';
		endforeach;
		echo '</ul>';
  		echo '</div>';
		endforeach;
		endforeach;
			 ?>
            <!-- ONDE SE ENCERRA O LOOP -->
</section>
  <?php setArq('tpl/footer'); ?>
  
