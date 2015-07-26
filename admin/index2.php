<?php
ob_start(); session_start();
require('../dts\dbaSis.php');
require('../dts\getSis.php');
require('../dts\setSis.php');
require('../dts\outSis.php');
if (!$_SESSION['autUser']) 
{
  header('Location: index.php');
}else
{
  $userId      = $_SESSION['autUser']['id'];
  $readAutUser = read('users', "WHERE id = '$userId'");
  if ($readAutUser) 
  {
    foreach ($readAutUser as $autUser);
      if ($autUser['nivel'] < '1' || $autUser['nivel'] > '2') 
      {
        header('Location: '.BASE.'/pagina/perfil');
      } 
    
  }else
  {
    header('Location: index.php');
  }
}
$readPremium = read('users', "WHERE nivel = '3' AND premium_end < date(NOW())");
if ($readPremium) 
{
  foreach ($readPremium as $premium):
  $end = array('nivel' => '4', 'premium_end' => '0000-00-00 00:00:00');
  update('users',$end,"id = '$premium[id]'");  
  endforeach;  
}
	 require_once('includes/header.php');
     require_once('includes/menu.php');    
      if (empty($_GET['exe'])) 
      {
        require('home.php');
      }elseif (file_exists($_GET['exe'].'.php')) 
      {
        require($_GET['exe'].'.php');
      }else
      {
        echo '<div class="bloco"><span class="ms in">Desculpe, a página que você está tentando acessar é inválida!</ span></div>';
      }       
    ?>    
<div style="clear:both"></div> 
<footer>Desenvolvido por <a href="#" title="Sistema desenvolvido por Anderson S. Monteiro" > Soft-Treinamento </a></footer><!-- Footer -->
</div><!--row/menu-->
</section><!--container-->
</body>
<?php  require_once('js/jsc.php'); ob_end_flush(); ?>
</html>