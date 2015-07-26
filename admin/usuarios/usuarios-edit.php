<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '2')) 
  {
   header('Location: index2.php');
  }else
  {
    $userEditId = $_GET['userid'];
    $readEditId = read('users', "WHERE id = '$userEditId'");
      if (!$readEditId) 
      {
        header('Location: index2.php?exe=usuarios/usuarios');
      }elseif ($_SESSION['autUser']['nivel'] != '1') 
            {
            foreach ($readEditId as $user);
                if ($_SESSION['autUser']['id'] != $user['id']) 
                {
                  header('Location: index2.php?exe=usuarios/usuarios');
                }
            }else
            
      foreach ($readEditId as $user);
      $status = ($user['status'] == '1' ? $user['status'] : '-1' );    
?>
<section class="span8">
<?php if ($_SESSION['autUser']['nivel'] == '1') { ?>
<a href="index2.php?exe=usuarios/usuarios" title="Voltar" class="pull-right label label-info" >voltar</a>
<?php }else{ ?>
<a href="index2.php" title="Voltar" class="pull-right label label-info" >voltar</a>
<?php } 
  if(isset($_POST['sendForm']))
  {
    $f['nome']     = strip_tags(trim(mysql_real_escape_string($_POST['nome'])));
    $f['cpf']      = strip_tags(trim(mysql_real_escape_string($_POST['cpf'])));
    $f['cpf']      =($f['cpf'] != ''? $f['cpf'] : $user['cpf']);
    $f['email']    = strip_tags(trim(mysql_real_escape_string($_POST['email'])));
    $f['email']    =($f['email'] != ''? $f['email'] : $user['email']);   
    $f['senha']    = md5($_POST['senha']);
    $f['rua']      = strip_tags(trim(mysql_real_escape_string($_POST['rua'])));
    $f['cidade']   = strip_tags(trim(mysql_real_escape_string($_POST['cidade'])));
    $f['cep']      = strip_tags(trim(mysql_real_escape_string($_POST['cep'])));
    $f['telefone'] = strip_tags(trim(mysql_real_escape_string($_POST['telefone'])));
    $f['celular']  = strip_tags(trim(mysql_real_escape_string($_POST['celular'])));
    $f['nivel']    = strip_tags(trim(mysql_real_escape_string($_POST['nivel'])));
    $f['nivel']    =($f['nivel'] != ''? $f['nivel'] : $user['nivel']);
    $f['statusS']  = strip_tags(trim(mysql_real_escape_string($_POST['status'])));
    $f['statusS']    =($f['statusS'] != ''? $f['statusS'] : $user['status']);
    $f['status']   = ($f['statusS'] == '1' ? $f['statusS'] : '0');
    $f['date']  = strip_tags(trim(mysql_real_escape_string($_POST['cadData'])));
    $f['date']    =($f['date'] != ''? $f['date'] : date('d/m/Y H:i:s',strtotime($user['cadData'])));
    $f['cadData']  = formDate($f['date']);
    if ($f['nivel'] == '3') 
    {
      $f['premium_end'] = mysql_real_escape_string($_POST['premium_end']);
      $f['premium_end'] = date('Y-m-d H:i:s',strtotime('+'.$f['premium_end'].'months'));
    }
    if (in_array('', $f)) 
    {
      echo '<span class="alert alert-info" style="float:left;">Voc&ecirc; deixou Campos em Branco, Sugerimos que informe todos os Dados!</span>';
    }elseif (!valMail($f['email'])) 
    {
       echo '<span class="alert alert-error" style="float:left;">Aten&ccedil;&atilde;o: O e-mail informado n&atilde;o tem um formato v&aacute;lido!</span>';
    }elseif (!valCpf($f['cpf'])) 
    {
        echo '<span class="alert alert-error" style="float:left;">Aten&ccedil;&atilde;o: O CPF informado n&atilde;o tem um formato v&aacute;lido!</span>';
    }elseif (strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 12) 
    {
      echo '<span class="alert alert-error" style="float:left;">Erro: Senha devoe conter 8 ou at&eacute; 12 caracteres!</span>';
    }else
    {
      $readUserMail = read('users', "WHERE email = '$f[email]' AND id != '$userEditId'");
      $readUserCpf = read('users', "WHERE cpf = '$f[cpf]' AND id != '$userEditId'");
      if ($readUserMail) 
      {
       echo '<span class="alert alert-error" style="float:left;"> Erro : J&aacute; existe este E-mail cadastrado, informe outro E-mail!</span>';
      }elseif ($readUserCpf) 
      {
        echo '<span class="alert alert-error" style="float:left;"> Erro : J&aacute; existe este CPF cadastrado, informe outro CPF!</span>';       
      }else
      {
        if (!empty($_FILES['avatar']['tmp_name'])) 
        {
          $imagem = $_FILES['avatar'];
          $pasta = '../uploads/avatars/';
          if (file_exists($pasta.$user['avatar']) && !is_dir($pasta.$user['avatar'])) 
          {
            unlink($pasta.$user['avatar']);
          }
          $tmp = $imagem['tmp_name'];
          $ext = substr($imagem['name'], -3);
          $nome = md5(time()).'.'.$ext;
          $f['avatar'] = $nome;
          uploadImage($tmp, $nome, '200', $pasta);
        }
        unset($f['date']);
        unset($f['statusS']);
        update('users', $f, "id = '$userEditId'");
        $_SESSION['return'] = '<span class="alert alert-success" style="float:left;">Usu&aacute;rio atualizado com sucesso!</span>';
        header('Location: index2.php?exe=usuarios/usuarios-edit&userid='.$userEditId);
      }
   }
  }elseif(!empty($_SESSION['return']))
        {
           echo $_SESSION['return'];
           unset($_SESSION['return']);
        }      
?>
<form name="formulario" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
<fieldset>
  <legend>Editar Usu&aacute;rio: <strong><?php echo $user['nome']; ?></strong></legend>
   <div class="controls">
<?php
if ($user['avatar'] != '' && file_exists('../uploads/avatars/'.$user['avatar'])) 
{
  echo '<a href="../uploads/avatars/'.$user['avatar'].'" title="Ver Avatar" rel="Shadowbox"><img src="../thumb.php?src='.BASE.'/uploads/avatars/'.$user['avatar'].'&w=80&h=100&zc1&q=100" title="Avatar do Usuário" alt="Avatar do usuário" /></a>';
}else
{
  echo 'Cadastre uma foto: ';
}
?>  </div> <div class="control-group">    	
    <label class="control-label" for="avatar">
      <span>Foto de Exibi&ccedil;&atilde;o</span></label>
      <div class="controls">
        <input type="file" class="span4" id="avatar" name="avatar" size="60" />
       </div>
    </div> 
  <div class="control-group">
    <label class="control-label" for="nome"><span>Nome:</span></label>
      	<div class="controls">
        <input type="text" class="span4" id="nome" name="nome" value="<?php  echo $user['nome']; ?>" />
    	</div>
   </div>     
        <?php if ($_SESSION['autUser']['nivel'] == '1') { ?>
   <div class="control-group">     
       <label class="control-label" for="cpf"><span>CPF:</span></label>
        <div class="controls">
        <input type="text" class="span4" id="cpf" name="cpf" value="<?php echo $user['cpf']; ?>" />
        </div>
    </div>
    <div class="control-group">
       <label class="control-label" for="email"><span>E-mail:</span></label>
       <div class="controls">
        <input type="text" class="span4" id="email" name="email" value="<?php echo $user['email']; ?>" />
        </div>
    </div>
    <?php } ?>
    <div class="control-group">
       <label class="control-label" for="senha"><span>Senha:</span></label>
      	<div class="controls">
        <input type="password" class="span4" id="senha" name="senha" placeholder="Cadastre uma nova senha" value="<?php if($_POST['senha']) echo $_POST['senha']; ?>" />
        </div>
    </div>
    <div class="control-group">
       <label class="control-label" for="rua"><span>Rua, N&uacute;mero:</span></label>
       <div class="controls">
        <input type="text"class="span4" id="rua" name="rua" value="<?php echo $user['rua']; ?>" />
   		</div>
    </div>    
    <div class="control-group">
       <label class="control-label" for="cidade"><span>Cidade / UF:</span></label>
     	<div class="controls">
        <input type="text" class="span4" id="cidade" name="cidade" value="<?php echo $user['cidade']; ?>" />
        </div>
    </div>
    <div class="control-group">
       <label class="control-label" for="cep"><span>CEP:</span></label>      
      <div class="controls">
        <input type="text" class="span4" id="cep" name="cep" value="<?php echo $user['cep']; ?>" />
    	</div>
    </div>
    <div class="control-group">
       <label class="control-label" for="telefone"><span>Telefone:</span></label>      
      <div class="controls">
        <input type="text" class="span4" id="telefone" name="telefone" value="<?php echo $user['telefone']; ?>" />
   	  </div>
    </div>
    <div class="control-group">
       <label class="control-label" for="celular"><span>Celular:</span></label>      
      <div class="controls">
        <input type="text" class="span4" id="celular" name="celular" value="<?php echo $user['celular']; ?>" />
      </div>
    </div>  
    <?php if ($_SESSION['autUser']['nivel'] == '1') { ?>
    <div class="control-group"> 
    <label class="control-label" for="nivel"><span>Select:</span></label>
      <div class="controls">
        <select id="nivel" name="nivel" class="input-xlarge span4" onchange="if(this.value=='3'){document.getElementById('ccpremium').style.display = 'block'}else{document.getElementById('ccpremium').style.display = 'none'}" >
          <option value="">Selecione o nível deste usuário &nbsp;&nbsp;</option>
           <option <?php if($user['nivel'] && $user['nivel'] == '4') echo 'selected="selected"'; ?>value="4">Leitor &nbsp;&nbsp;</option>
           <option <?php if($user['nivel'] && $user['nivel'] == '3') echo 'selected="selected"'; ?>value="3">Premium &nbsp;&nbsp;</option>
           <option <?php if($user['nivel'] && $user['nivel'] == '2') echo 'selected="selected"'; ?>value="2">Editor &nbsp;&nbsp;</option>
           <option <?php if($user['nivel'] && $user['nivel'] == '1') echo 'selected="selected"'; ?>value="1">Administrador &nbsp;&nbsp;</option>          
        </select>
       </div>
   </div>
	<div id="ccpremium" class="control-group" style="display:none" ><span class="alert alert-info" style="float:left;">Voc&ecirc; Selecionou "PREMIUM", informe a quantidade de MESES para manter este n&iacute;vel:</span>
    <label  class="control-label" for="premium_end" ></label>
      <div class="controls">
        <input type="text" id="premium_end" name="premium_end" class="input-xlarge span4" value="1" />
       </div>
    </div>    
     <div class="control-group">   
     <label class="control-label" for="status"><span>Select:</span></label>
      	<div class="controls">
        <select id="status" name="status" class="input-xlarge span4">
          <option value="">Selecione o status &nbsp;&nbsp;</option>
           <option <?php if($status && $status == '1') echo 'selected="selected"'; ?>value="1">Ativado &nbsp;&nbsp;</option>
           <option <?php if($status && $status == '-1') echo 'selected="selected"'; ?>value="-1">Desativado &nbsp;&nbsp;</option>           
        </select>
        </div>
     </div>
     <div class="control-group">
    <label class="control-label" for="cadData"><span>Data do Cadastro:</span></label>
      	<div class="controls">
        <input type="text" id="cadData" name="cadData" class="input-xlarge span4" value="<?php echo date('d/m/Y H:i:s',strtotime($user['cadData'])); ?>" />
    </div>
    </div>
    <?php } ?> 
     <div class="control-group">
    <label class="control-label" for="sendForm"></label>
    <div class="controls">
    <input type="submit" id="sendForm" name="sendForm" class="btn btn-primary" value="Atualizar Usu&aacute;rio" /> 
    </div>
    </div>
</fieldset>     
</form>	
</section><!-- /bloco span8-->
<?php }}else{header('Location: ../index2.php');}?>