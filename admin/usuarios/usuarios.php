<?php
if (function_exists(getUser)) 
{
  if (!getUser($_SESSION['autUser']['id'], '1')) 
  {
    echo '<span class="alert alert-error" style="float:left;">Desculpe, Voc&ecirc; n&atilde;o tem permiss&atilde;o para gerenciar os usu&aacute;rios!</span>';
  }else
  {
    $userId = $_SESSION['autUser']['id'];
    if (isset($_POST['sendFiltro'])) 
    {
     $search = $_POST['search'];
     if (!empty($search) && $search != 'Nome:') 
     {
        $_SESSION['where'] = "AND nome LIKE '%$search%'";
        header('Location: index2.php?exe=usuarios/usuarios ');
     }else
     {
        unset($_SESSION['where']);
        header('Location: index2.php?exe=usuarios/usuarios ');
     }
    }
?>
<section class="span8">
	<form name="filtro" class="navbar-search" action="" method="post">
    	<label>
        	<input type="text" name="search"  value="Nome:" 
            onclick="if(this.value=='Nome:')this.value=''" 
            onblur="if(this.value=='')this.value='Nome:'"
            />
        </label>
        <input type="submit" value="filtrar resultados" name="sendFiltro" class="btn" />
    </form>

<?php
  if (!empty($_GET['deluser'])) 
  {
    $delUserId = $_GET['deluser'];
    $readDelUser = read('users', "WHERE id = '$delUserId'");
    if (!$readDelUser) 
    {
      echo '<span class="alert alert-error" style="float:left;">Erro: Usu&aacute;rio n&atilde;o Existe!</span>';
    }else
    {
      foreach ($readDelUser as $delUser);
      if ($delUser['id'] == $userId) 
      {
         echo '<span class="alert alert-error" style="float:left;">Erro: Voc&ecirc; n&atilde;o pode remover seu perfil!</span>';
      }elseif ($delUser['nivel'] == '1') 
      {
       echo '<span class="alert alert-error" style="float:left;">Erro: Voc&ecirc; n&atilde;o pode remover um administrador!</span>';
      }else
      {
       echo '<span class="alert alert-info" style="float:left;">Aten&ccedil;&&atilde;: Voc&ecirc; est&aacute; excluindo o usu&aacute;rio "<strong>'.strtoupper($delUser['nome']).'
       </strong>"<br /> Deseja continuar? [ <a href="index2.php?exe=usuarios/usuarios" title="N&atildeo">N&atildeo</a> ] , 
       [ <a href="index2.php?exe=usuarios/usuarios&delusertrue='.$delUser['id'].'">Sim</a> ]</span>';
      } 
    }
  }
  if (!empty($_GET['delusertrue'])) 
  {
     $delusertrue = $_GET['delusertrue'];
     $readDelAvatar = read('users', "WHERE id = '$delusertrue'");
     foreach ($readDelAvatar as $delAvatar);
     $pasta = '../uploads/avatars/';
     if (file_exists($pasta.$delAvatar['avatar']) && !is_dir($pasta.$delAvatar['avatar'])) 
     {
       unlink($pasta.$delAvatar['avatar']);
     }
     delete('users', "id = '$delusertrue'");
     header('Location: index2.php?exe=usuarios/usuarios');
  }
  $pag = (empty($_GET['pag']) ? '1': $_GET['pag']);
  $maximo = 10;
  $inicio = ($pag * $maximo) - $maximo;
  $readUser = read('users', "WHERE id != '$userId' {$_SESSION[where]} ORDER BY nivel ASC, nome ASC LIMIT $inicio,$maximo");
  if (!$readUser) 
  {
    echo '<span class="alert alert-error" style="float:left;">N&atilde;o existem registros de usu&aacute;rios relacionados a sua busca!</span>';
  }else
  {
    echo '<table class="table table-bordered table-hover">
    <caption>Usu&aacute;rios:</caption>
    <thead>
  <tr>
    <th>#id</th>
    <th>nome:</th>
    <th>email:</th>
    <th>n&iacute;vel:</th>
    <th colspan="2">a&ccedil;&otilde;tes:</td>
  </tr>
  </thead><tbody>';
  foreach ($readUser as $user ):
    $nivel = ($user['nivel'] == '1' ? 'Admin' : ($user['nivel'] == '2' ? 'Editor' : ( $user['nivel'] == '3' ? 'Premium' : 'Leitor' )));
    echo '<tr>';
    echo '<td >'.$user['id'].'</td>';
    echo '<td>'.$user['nome'].'</td>';
    echo '<td>'.$user['email'].'</td>';
    echo '<td>'.$nivel.'</td>';
    echo '<td><a href="index2.php?exe=usuarios/usuarios-edit&userid='.$user['id'].'" title="editar"><img src="ico/edit.png" alt="editar" title="editar" /></a></td>';
    echo '<td><a href="index2.php?exe=usuarios/usuarios&deluser='.$user['id'].'" title="excluir "><img src="ico/no.png" alt="excluir" title="excluir" /></a></td>';
    echo '</tr>';   
  endforeach;
  	echo '</tbody>';
    echo '</table>';
    $link = 'index2.php?exe=usuarios/usuarios&pag=';
    readPaginator('users',"WHERE id != '$userId' {$_SESSION[where]} ORDER BY nivel ASC, nome ASC", $maximo, $link, $pag);
  }
?>                           
</section>
<?php }}else{header('Location: ../index2.php');}?>