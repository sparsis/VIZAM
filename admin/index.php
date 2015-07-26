<?php
ob_start();
session_start();
require ('../dts/dbaSis.php');
require('../dts/outSis.php');
if (!empty($_SESSION['autUser']))
{
  header('Location: index2.php'); 
}
include("includes/header.php");
        if (isset($_POST['sendLogin'])) 
        {
            $f['email']  =mysql_real_escape_string($a = isset($_POST['email']) ? $_POST['email']: ''); 
            $f['senha']  =mysql_real_escape_string($b = isset($_POST['senha']) ? $_POST['senha']: ''); 
            $f['salva']  =mysql_real_escape_string($c = isset($_POST['remember']) ? $_POST['remember']: '');           
              if (!$f['email'] || !valMail($f['email'])) 
              {
                echo '<span class="ms al">Campo e-mail está vazio, ou não tem um formato válido</span>';          
              }elseif (strlen($f['senha']) < 8 ||  strlen($f['senha']) > 12)
              {
                 echo '<span class="alert alert-error">Senha deve ter entre 8 e 12 caracteres! </span>'; 
              }else
              {
                $autEmail = $f['email'] ;
                $autSenha = md5($f['senha']);
                $readAutUser =  read('users', "WHERE email = '$autEmail'");     
                      if ($readAutUser) 
                      {
                         foreach ($readAutUser as $autUser );
                             if ($autEmail == $autUser['email'] && $autSenha == $autUser['senha']) 
                             {
                                     if ($autUser['nivel'] == 1 || $autUser['nivel'] == 2) 
                                     {            
                                                if ($f['salva']) 
                                                {
                                                  $cookiesalva = base64_encode($autEmail).'&'.base64_encode($f['senha']);
                                                  setcookie('autUser',$cookiesalva, time()+60*60*24*30,'/');
                                                }else
                                                {
                                                  setcookie('autUser', '', time()+3600,'/');
                                                }
                                                    $_SESSION['autUser'] = $autUser;
                                                    header('Location:'.$_SERVER['PHP_SELF']);
                                      }else
                                      {
                                        echo '<span class="alert alert-error">o Nível de acesso não permite a esta área . Vamos redirecionar você para o login de usuário!</span>'; 
                                        header('Refresh: 5; url='.BASE.'/pagina/login');
                                      }  
                             }else
                             {
                               echo '<span class="alert alert-error">Senha informada não é válida!</span>'; 
                             }
                      }else
                      {
                         echo '<span class="alert alert-error">Erro, e-mail informado não é válido!</span>'; 
                      }
              }            
        }elseif (!empty($_COOKIE['autUser'])) 
        {
          $cookie = $_COOKIE['autUser'];
        } 
         $texto = isset($_GET['remember']) ? $_GET['remember'] : '';
         if(!$texto)
         {  
?>
<div class="row">
<div class="logo">
<img src="<?php echo BASE;?>/admin/images/login-logo.png"  alt="Foto Vizam - Área administrativa | Login" title="Foto Vizam - Área administrativa | Login" />
</div>
</div><!-- div row-->
<div class="row">
<section class="span9 offset3">



        <form name="login" action="" method="post" class="form-horizontal">                       
            <div class="control-group">     
            	<label class="control-label" for="inputEmail"><span>E-mail:</span> </label>
                <div class="controls">
                    <input type="text" id="inputEmail" name="email" placeholder="Email" />
                </div>
            </div>
            <div class="control-group">
            	<label class="control-label" for="inputPassword"><span>Senha:</span> </label>
                <div class="controls">
                	<input type="password" id="inputPassword" name="senha" placeholder="Senha" />
                </div>
            </div>           
            <div class="control-group">
                <div class="controls">
                    <input type="submit" value="Logar-se" name="sendLogin" class="btn btn-inverse" />
                    <label class="checbox">
                    <input type="checkbox" name="remember" value="1" <?php //if ($f['salva'])  echo 'checked="checked"' ?> /> 
                    Lembrar meus dados de acesso!
                    </label>
                    <a href="index.php?remember=true" class="link" title="Esqueci minha senha!">Esqueci minha senha!</a>
                </div>
            </div>
        </form>
<?php  
          }else
          {
                if (isset($_POST['sendRecover'])) 
                {
                  $rec['email']  =mysql_real_escape_string($a = isset($_POST['email']) ? $_POST['email']: '');
                  $recover = $rec['email'];
                  $readRec = read('users', "WHERE email= '$recover'");
                        if (!$readRec ) 
                        {
                          echo ' <span class="alert alert-error">Erro: E-mail não confere!</span>';
                        }else
                        {
                          foreach ($readRec as $rec);
                                if($rec['nivel'] == 1 || $rec['nivel'] == 2) 
                                {
                                $msg='<h3 style="font:16px \'Trebucher MS\', Arial, Helvetica, sans-serif; color:#099;">Prezado '.$rec['nome'].', recupere seu acesso!</h3><p style="font:bold 12px Arial, 
                                Helvetica, sans-serif; color:#666;">Estamos entrando em contato pois foi solicitado em nosso nível administrador / editor a recuperação de dados de acesso. 
                                Verifique logo abaixo  os dados de seu usuário: </p><hr><p style="font:italic 14px \'Trebucher MS\', Arial, Helvetica, sans-serif; color:#069;">E-mail: '.$rec['email'].'<br>Senha: '.$rec['code'].'
                               </p><hr><p style="font:bold 12px Arial, Helvetica, sans-serif; color:#666;">Atenciosamente a administração <a style="color:#900;" 
                                href="http://www.temestilo.com.br/produtos/imagens/1428/(1428)conjunto_de_calcinha_e_sutia_com_bijuacute_-_ref_3370_full.jpg" title="Imagem do Site de logon">Mudar Imagem?</a>
                               <hr><img alt="Mudar Imagem ?" title="TEste para envio de email" src="http://www.temestilo.com.br/produtos/imagens/1428/(1428)conjunto_de_calcinha_e_sutia_com_bijuacute_-_ref_3370_full.jpg"></p>';
                                 
                                 sendMail('Recupere seus dados', $msg, MAILUSER, SITENAME, $rec['email'], $rec['nome']);
                                echo '<span class="ms ok">Seus dados foram enviados com sucesso para : <strong>'.$rec['email'].'</strong> Favor verifique!</span>';
                                }else
                                {
                                   echo '<span class="alert alert-error">o Nível de acesso não permite a esta área . Vamos redirecionar você para o login de usuário!</span>'; 
                                          header('Refresh: 5; url='.BASE.'/pagina/login');
                                }
                        }
          }
?>
<div class="row">
<div class="logo span11 offset1">
<img src="<?php echo BASE;?>/admin/images/login-logo.png"  alt="Foto Vizam - Área administrativa | Login" title="Foto Vizam - Área administrativa | Login" />  
</div>
</div><!-- div row-->
<div class="row">
<div class="span11 offset1 alert alert-info">
<span>&nbsp;&nbsp;&nbsp;Informe seu e-mail para que possamos enviar seus dados de acesso!</span>  
</div>
</div><!-- div row-->
<div class="row">
 


<section class="span11 offset1">
     <!--Formulário de recuperação de senha --> 
    <form name="recover" action="" method="post" class="form-horizontal"> 
    
            <div class="control-group">        
            <label class="control-label" for="inputEmail"><span>E-mail:</span></label>
                    <div class="controls">
                    <input type="text" id="inputEmail" name="email" placeholder="Email" />              
                    </div>       
            </div>
        <div class="controls">
        <input type="submit" value="Recuperar dados" name="sendRecover" class="btn btn-inverse" /> 
        <a href="index.php" class="label label-info" title="Voltar">Voltar</a>
        </div>
    </form>
<?php 
}
?>   

</section><!--span9 offset3-->
</div><!-- div row-->
</section><!--container-->
</body>
<?php 
        ob_end_flush();
?>
</html>