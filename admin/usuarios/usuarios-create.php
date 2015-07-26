<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
    echo '<span class="alert alert-info" style="float:left;">Desculpe, Você não tem permissão para gerenciar os usuários!</span>';
  }else
  {
?>

<section class="span8">
<a href="index2.php?exe=usuarios/usuarios" title="Listar Usu&aacute;rios" class="pull-right label label-info" > Listar Usuários</a>

<?php 
  if(isset($_POST['sendForm']))
  {
    $f['nome']     = strip_tags(trim(mysql_real_escape_string($_POST['nome'])));
    $f['cpf']      = strip_tags(trim(mysql_real_escape_string($_POST['cpf'])));
    $f['email']    = strip_tags(trim(mysql_real_escape_string($_POST['email'])));    
    $f['senha']    = md5($_POST['senha']);
    $f['rua']      = strip_tags(trim(mysql_real_escape_string($_POST['rua'])));
    $f['cidade']   = strip_tags(trim(mysql_real_escape_string($_POST['cidade'])));
    $f['cep']      = strip_tags(trim(mysql_real_escape_string($_POST['cep'])));
    $f['telefone'] = strip_tags(trim(mysql_real_escape_string($_POST['telefone'])));
    $f['celular']  = strip_tags(trim(mysql_real_escape_string($_POST['nome'])));
    $f['nivel']    = strip_tags(trim(mysql_real_escape_string($_POST['nivel'])));
    $f['statusS']  = strip_tags(trim(mysql_real_escape_string($_POST['status'])));
    $f['status']   = ($f['statusS'] == '1' ? $f['statusS'] : '0');
    $f['date']  = strip_tags(trim(mysql_real_escape_string($_POST['cadData'])));
    $f['cadData']  = formDate($f['date']);
    if (in_array('', $f)) 
    {
      echo '<span class="alert alert-error" style="float:left;">Voc&ecirc; deixou Campos em Branco, Sugerimos que informe todos os Dados!</span>';
    }elseif (!valMail($f['email'])) 
    {
       echo '<span class="alert alert-error" style="float:left;">Atenção: O e-mail informado não tem um formato válido!</span>';
    }elseif (!valCpf($f['cpf'])) 
    {
        echo '<span class="alert alert-error" style="float:left;">Atenção: O CPF informado não tem um formato v&aacute;lido!</span>';
    }elseif (strlen($_POST['senha']) < 8 || strlen($_POST['senha']) > 12) 
    {
      echo '<span class="alert alert-error" style="float:left;">Erro: Senha deve conter 8 ou at&eacute; 12 caracteres!</span>';
    }else
    {
      $readUserMail = read('users', "WHERE email = '$f[email]'");
      $readUserCpf = read('users', "WHERE cpf = '$f[cpf]'");
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
              $tmp = $imagem['tmp_name'];
              $ext = substr($imagem['name'], -3);
              $nome = md5(time()).'.'.$ext;
              $f['avatar'] = $nome;
              uploadImage($tmp, $nome, '200', $pasta);
            }
            unset($f['date']);
            unset($f['statusS']);
            create('users', $f);
            echo '<span class="alert alert-success" style="float:left;">Usu&aacute;rio cadastrado com sucesso!</span>';
            unset($f);           
            } 
      }  
  }
?>
<form name="formulario" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
<fieldset>
<legend>Cadastrar Usu&aacute;rio:</legend>
	 <div class="control-group">
    <label class="control-label" for="avatar"><span>Avatar:</span></label>      
      <div class="controls">
        <input type="file" class="input-file" id="avatar" name="avatar" value="<?php if($f['avatar']) echo $f['avatar']; ?>" />
      </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="nome"><span>Nome:</span></label>
    	<div class="controls">
        <input type="text" class="span4" id="nome" name="nome" value="<?php if($f['nome']) echo $f['nome']; ?>" />
   		</div>
    </div>
     <div class="control-group">    
       <label class="control-label" for="cpf"><span>CPF:</span></label>
    	<div class="controls">
        <input type="text" class="span4" id="cpf" name="cpf" value="<?php if($f['cpf']) echo $f['cpf']; ?>" />
 		</div>
     </div>   
     <div class="control-group">
       <label class="control-label" for="email"><span>E-mail:</span></label>
    	<div class="controls">
        <input type="text" class="span4" id="email" name="email"  value="<?php if($f['email']) echo $f['email']; ?>" />
    	</div>
     </div>   
     <div class="control-group">
       <label class="control-label" for="senha"><span>Senha:</span></label>
      	<div class="controls">
        <input type="password" class="span4"id="senha" name="senha"  value="<?php if($_POST['senha']) echo $_POST['senha']; ?>" />
  		</div>
     </div>   
     <div class="control-group">
       <label class="control-label" for="rua"><span>Rua, Número:</span></label>
      	<div class="controls">
        <input type="text" class="span4" id="rua" name="rua"  value="<?php if($f['rua']) echo $f['rua']; ?>" />
        </div>
    </div>
     <div class="control-group">
       <label class="control-label" for="cidade"><span>Cidade / UF:</span></label>
      	<div class="controls">
        <input type="text" class="span4" id="cidade" name="cidade" value="<?php if($f['cidade']) echo $f['cidade']; ?>" />
    	</div>
     </div>   
     <div class="control-group">
       <label class="control-label" for="cep"><span>CEP:</span></label>
      <div class="controls">
        <input type="text" class="span4" id="cep" name="cep" value="<?php if($f['cep']) echo $f['cep']; ?>" />
        </div>
    </div>
     <div class="control-group">
       <label class="control-label" for="telefone"><span>Telefone:</span></label>
        <div class="controls">
        <input type="text" class="span4" id="telefone" name="telefone" value="<?php if($f['telefone']) echo $f['telefone']; ?>" />
        </div>
    </div>
     <div class="control-group">
       <label class="control-label" for="celular"><span>Celular:</span></label>
      <div class="controls">
        <input type="text" class="span4" id="celular" name="celular" value="<?php if($f['celular']) echo $f['celular']; ?>" />
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
           <option <?php if($f['statusS'] && $f['statusS'] == '1') echo 'selected="selected"'; ?>value="1">Ativado &nbsp;&nbsp;</option>
           <option <?php if($f['statusS'] && $f['statusS'] == '-1') echo 'selected="selected"'; ?>value="-1">Desativado &nbsp;&nbsp;</option>
        </select>
      </div>
    </div> 
    <div class="control-group"> 
    <label class="control-label" for="cadData"><span>Data do Cadastro:</span></label>
      	<div class="controls">
        <input type="text" name="cadData" id="cadData" class="span4" value="<?php echo date('d/m/Y H:i:s'); ?>" />
        </div>
   	</div> 
     <?php } ?> 
    <div class="control-group">
    <label class="control-label" for="sendForm"></label>
    <div class="controls">
    <input type="submit" value="Cadastrar Novo Usu&aacute;rio" id="sendForm" name="sendForm" class="btn btn-primary" />
    </div>
    </div>
    </fieldset>   
</form>	
</section><!-- /bloco span8 -->
<?php }}else{header('Location: ../index2.php');}?>