<?php
$produtoUrl = mysql_real_escape_string($url[1]);
$readProduto = read('posts', "WHERE url = '$produtoUrl'");
if (!$readProduto) 
{
  header('Location: '.BASE.'/404');
}else
{
    foreach ($readProduto as $art);
    setViews($art['id']);
    setArq('tpl/header'); ?>

<div class="row">
<section class="span4">
	<h1 ><?php echo $art['titulo']; ?></h1>   
 
<?php
if (!getUser($_SESSION['autUser']['id'],$art['nivel']) && $art['nivel'] != '0') 
{
  $nivel = ($art['nivel'] == 1? 'Admin' : ($art['nivel'] == 2 ? 'Editor' : ($art['nivel'] == 3 ? 'Premium' : 'Leitor (FREE)')));
?> 
  <h2>Desculpe, acesso restrito a usuários <strong><?php echo $nivel; ?></strong>.</h2>
  <p>Para ter acesso a este artigo você deve estar logado e ter a conta de nível "PREMIUM". Se você não é cadastrado no <?php echo SITENAME;?>, <a href="<?php setHome();?>/pagina/cadastro" title="cadastre-se">clique aqui</a>
   e cadastre-se.</p>
   <p>Se já é cadastrado, você pode acessar seu perfil e solicitar sua conta premium agora mesmo!</p>
<?php 
}else
{ 
?> 
  
      <?php
 getThumb($art['thumb'],$art['titulo'],$art['titulo'],'250', '200', '', '', '#','r', BASE.'/uploads/'.$art['thumb'],'zoom_01'); 
		 echo '<p>'.$art['titulo'].'</p>';
      $readArtGb = read('posts_gb', "WHERE post_id = '$art[id]'");
      if ($readArtGb) 
      {
        echo '<ul class="unstyled inline" >';
          foreach ($readArtGb as $gb):            
            echo '<li>';   
        
            getThumb($gb['img'], $art['titulo'].'(imagem'.$gbn.')', $art['titulo'], '100', '65', $art['id'], '', '', '','');
            echo '</li>';
          endforeach;    
        echo '</ul><!-- //gallery -->';

   
       } 
       ?> 
   <span>Postado dia: <strong><?php echo date('d/m/Y H:i:s',strtotime($art['data']))?></strong></span>
   <span> | Em : <a href="<?php setHome();?>/categoria/<?php echo getCat($art['cat_id'],'url');?>"><?php echo getCat($art['cat_id'],'nome');?></a></span>
   <span> | Visitas :<strong><?php echo $art['visitas']; ?></strong></span>
       
<?php
}
?>    
</section><!-- /section span4 -->
<!-----------------------------------------------------DESCRIÇÕES DO PRODUTO ----------->
<section class="span3">
<h5>Descrição :</h5>
<p><?php echo $art['content']; ?></p>
<h5>Pre&ccedil;o : </h5>
<p><?php echo $art['preco']; ?></p>
		<?php 
		$readMeasures = read('measures', "WHERE post_id = '$art[id]'"); 
		$readPagers = read('pagers', "WHERE post_id = '$art[id]'");		
		$readPapers = read('papers', "WHERE post_id = '$art[id]'");
		$readColors = read('post_colors', "WHERE post_id = '$art[id]'");
		if(!empty($readMeasures))
			{	echo '<h5>Medidas :</h5>';
				foreach($readMeasures as $measure); 
				echo '<p>'.$measure['measure'].'</p>';
			}
	  if(!empty($readPagers))
			{	echo '<h5>P&aacute;ginas :</h5>';		
				foreach($readPagers as $pager);
				echo '<p>'.$pager['paginas'].'</p>';				
			}
	  if(!empty( $readPapers))
			{ 	echo '<h5>Tipo de Papel :</h5>';
				foreach($readPapers as $paper);				
				echo '<p>'.$paper['paper_type'].'</p>';
			}
	  if(!empty($readColors))
			{	echo '<h5>Cores :</h5>';
				foreach($readColors as $color): $colors = array_values(explode(',', $color['color_post']));
				foreach($colors as $cor):       $cores = strtr($cor,"'", " ");
				echo   '<span style="background-color:'.$cores.';border:#2A3F00 solid 2px; margin:2px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>';
				endforeach;	endforeach;
			}	  


 ?>



</section><!-- /section span3 -->
<!------------------------------------/DESCRIÇÕES DO PRODUTO -------------------------->

<!-----------------------------------------------------------------SIDEBAR -------- ---->
    <section class="span4 offset1">
    	<?php setArq('tpl/sidebar'); ?>
</section><!-- /section span4 offset1 -->
<!-----------------------------------/SIDEBAR ------------------------------------------->
</div>
<?php 
} 
?>

