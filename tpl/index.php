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
  <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Decora&ccedil;&otilde;es</a></li>
        <li ><a href="#tab2" data-toggle="tab">Foto Livro</a></li>
        <li ><a href="#tab3" data-toggle="tab">Foto Presentes</a></li>
        <li ><a href="#tab4" data-toggle="tab">Impress&otilde;es Digitais</a></li>
        <li ><a href="#tab5" data-toggle="tab">Lembran&ccedil;as e Convites</a></li>
        <li ><a href="#tab6" data-toggle="tab">Pain&eacute;is de Madeiras</a></li>
        <li ><a href="#tab7" data-toggle="tab">Tudo para sua Festa</a></li>
        <li ><a href="#tab8" data-toggle="tab">Volta &agrave;s Aulas</a></li>
   </ul>
    <div class="tab-content">
    	<div class="tab-pane active" id="tab1">
        	<p> lista de Decora&ccedil;&otilde;es</p>
   <!-- AQUI TERÁ UM LOOP DE PRODUTOS DECORAÇÕES --->         
            <ul class="thumbnails">
            <?php for($i=1; $i < 10; $i++){ echo ' 
                      
 		 <li class="span4">
    		<div class="thumbnail">
     			 <img src="http://placehold.it/300x200" alt="">
     			 <h3>Rótulo para a miniatura</h3>
     			 <p>Texto do thumbnail...</p>
   			</div>
  		</li>
        
         '; } ?>  		
		</ul>      
        </div>
            <!-- ONDE SE ENCERRA O LOOP DE DECORAÇÕES-->  
        <div class="tab-pane" id="tab2">
        	<p> lista de Foto Livro</p>
              <!-- AQUI TERÁ UM LOOP DE FOTO LIVRO --->         
            <ul class="thumbnails">
            <?php for($i=1; $i < 10; $i++){ echo ' 
                      
 		 <li class="span4">
    		<div class="thumbnail">
     			 <img src="http://placehold.it/300x200" alt="">
     			 <h3>Rótulo para a miniatura</h3>
     			 <p>Texto do thumbnail...</p>
   			</div>
  		</li>
        
         '; } ?>  		
		</ul>
     <!-- ONDE SE ENCERRA O LOOP DE FOTO LIVRO-->  
        </div>
        <div class="tab-pane" id="tab3">
        	<p> lista de Foto Presentes</p>
              <!-- AQUI TERÁ UM LOOP DE FOTO PRESENTES --->         
            <ul class="thumbnails">
            <?php for($i=1; $i < 10; $i++){ echo ' 
                      
 		 <li class="span4">
    		<div class="thumbnail">
     			 <img src="http://placehold.it/300x200" alt="">
     			 <h3>Rótulo para a miniatura</h3>
     			 <p>Texto do thumbnail...</p>
   			</div>
  		</li>
        
         '; } ?>  		
		</ul>
     <!-- ONDE SE ENCERRA O LOOP DE FOTO PRESENTES-->  
        </div>
        <div class="tab-pane" id="tab4">
        	<p> lista de Impress&otilde;es Digitais</p>
              <!-- AQUI TERÁ UM LOOP DE IMPRESSÕES DIGITAIS--->         
            <ul class="thumbnails">
            <?php for($i=1; $i < 10; $i++){ echo ' 
                      
 		 <li class="span4">
    		<div class="thumbnail">
     			 <img src="http://placehold.it/300x200" alt="">
     			 <h3>Rótulo para a miniatura</h3>
     			 <p>Texto do thumbnail...</p>
   			</div>
  		</li>
        
         '; } ?>  		
		</ul>
     <!-- ONDE SE ENCERRA O LOOP DE IMPRESSÕES DIGITAIS-->  
        </div>
        <div class="tab-pane" id="tab5">
        	<p> lista de Lembran&ccedil;as e Convites</p>
              <!-- AQUI TERÁ UM LOOP DE LEMBRANÇAS E CONVITES --->         
            <ul class="thumbnails">
            <?php for($i=1; $i < 10; $i++){ echo ' 
                      
 		 <li class="span4">
    		<div class="thumbnail">
     			 <img src="http://placehold.it/300x200" alt="">
     			 <h3>Rótulo para a miniatura</h3>
     			 <p>Texto do thumbnail...</p>
   			</div>
  		</li>
        
         '; } ?>  		
		</ul>
     <!-- ONDE SE ENCERRA O LOOP DE LEMBRANÇAS E CONVITE-->  
        </div>
        <div class="tab-pane" id="tab6">
        	<p> lista de Pain&eacute;is de Madeiras</p>
              <!-- AQUI TERÁ UM LOOP DE PAINÉIS DE MADEIRA --->         
            <ul class="thumbnails">
            <?php for($i=1; $i < 10; $i++){ echo ' 
                      
 		 <li class="span4">
    		<div class="thumbnail">
     			 <img src="http://placehold.it/300x200" alt="">
     			 <h3>Rótulo para a miniatura</h3>
     			 <p>Texto do thumbnail...</p>
   			</div>
  		</li>
        
         '; } ?>  		
		</ul>
     <!-- ONDE SE ENCERRA O LOOP DE PAINEIS DE MADEIRA-->  
        </div>
        <div class="tab-pane" id="tab7">
        	<p> lista de Tudo para sua Festa</p>
              <!-- AQUI TERÁ UM LOOP DE TUDO PARA SUA FESTA --->         
            <ul class="thumbnails">
            <?php for($i=1; $i < 10; $i++){ echo ' 
                      
 		 <li class="span4">
    		<div class="thumbnail">
     			 <img src="http://placehold.it/300x200" alt="">
     			 <h3>Rótulo para a miniatura</h3>
     			 <p>Texto do thumbnail...</p>
   			</div>
  		</li>
        
         '; } ?>  		
		</ul>
     <!-- ONDE SE ENCERRA O LOOP DE TUDO PARA SUA FESTA-->  
        </div>
        <div class="tab-pane" id="tab8">
        	<p> lista de Volta &agrave;s Aulas</p>
              <!-- AQUI TERÁ UM LOOP DE VOLTA AS AULAS --->         
            <ul class="thumbnails">
            <?php for($i=1; $i < 10; $i++){ echo ' 
                      
 		 <li class="span4">
    		<div class="thumbnail">
     			 <img src="http://placehold.it/300x200" alt="">
     			 <h3>Rótulo para a miniatura</h3>
     			 <p>Texto do thumbnail...</p>
   			</div>
  		</li>
        
         '; } ?>  		
		</ul>
     <!--ONDE SE ENCERRA O LOOP DE VOLTA AS AULAS-->  
        </div>
	</div>
</section>
<section id="paginacao">
    <div class="page-header">
        <h5>paginação</h5>
    </div>
    <div class="pagination">
        <ul>
            <li><a href=""> < </a></li>
            <li><a href=""> 1 </a></li>
            <li><a href=""> 2 </a></li>
            <li><a href=""> 3 </a></li>
            <li><a href=""> > </a></li>
        </ul>
    </div>
</section>                    		

	
  <?php setArq('tpl/footer'); ?>
  