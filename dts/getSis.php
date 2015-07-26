<?php
require('iniSis.php');
/************************************************
FUNÇÃO GET HOME
**************************************************/
function getHome()
{
	$url = isset($_GET['url']) ? $_GET['url'] : '';	
	$url = explode('/', $url);
	$url[0] = ($url[0] == NULL ? 'index' : $url[0]);
	
		if(file_exists('tpl/'.$url[0].'.php'))
		{
			 require_once('tpl/'.$url[0].'.php');
		}elseif(file_exists('tpl/'.$url[0].'/'.$url[1].'.php'))
		{
			 require_once('tpl/'.$url[0].'/'.$url[1].'.php');
		}else
		{
			 require_once('tpl/404.php');
		}
}
/************************************************
FUNÇÃO GET THUMB
**************************************************/
	function getThumb($img, $titulo, $alt, $w, $h, $grupo =NULL, $dir = NULL, $link = NULL, $a = NULL, $zoom = NULL, $id = NULL)
	{
		//TIPOS DE CORTE
		$a = ($a != NULL ? '&a='.$a : '');
		//a=t  align top     		.jpg&a=t&w=130&h=90
		//a=b  align bottom  		.jpg&a=b&h=70&w=100
		//a=r  align center right   .jpg&a=r
		//a=r align right           .jpg&a=r&w=60&h=130
		$grupo = ($grupo != NULL ? "[$grupo]": "");
		$dir   = ($dir != NULl ? "$dir": "uploads");
		$verDir = explode('/',$_SERVER['PHP_SELF']);
		$urlDir = (in_array('admin', $verDir) ?'../' : '');
		if (file_exists($urlDir.$dir.'/'.$img)) 
		{
			if ($link == '') 
			{
				echo'
				<a href="'.BASE.'/'.$dir.'/'.$img.'" rel="shadowbox'.$grupo.'" title="'.$titulo.'">
				<img src="'.BASE.'/thumb.php?src='.BASE.'/'.$dir.'/'.$img.'&w='.$w.'&h='.$h.'&zc=100'.$a.'" title="'.$titulo.'" alt="'.$alt.'" />
				</a>
				';
			}elseif ($link == '#') 
			{
				echo'				
<img id="'.$id.'" src="'.BASE.'/thumb.php?src='.BASE.'/'.$dir.'/'.$img.'&w='.$w.'&h='.$h.'&zc=100'.$a.'" title="'.$titulo.'" alt="'.$alt.'" data-zoom-image="'.$zoom.'" />				
				';
			}else
			{
				echo'
				<a href="'.$link.'" title="'.$titulo.'">
				<img src="'.BASE.'/thumb.php?src='.BASE.'/'.$dir.'/'.$img.'&w='.$w.'&h='.$h.'&zc=100'.$a.'" title="'.$titulo.'" alt="'.$alt.'" />
				</a>
			       ';
			}
		}else
		{	
			echo'				
				<img id="'.$id.'" src="'.BASE.'/thumb.php?src='.BASE.'/images/default.png&w='.$w.'&h='.$h.'&zc=100'.$a.'" data-zoom-image="'.$zoom.'" title="'.$titulo.'" alt="'.$alt.'" />				
				';
		}
	}	
/************************************************
FUNÇÃO GET CAT
**************************************************/
function getCat($catID, $campo = NULL )
{	
	$categoria = mysql_real_escape_string($catID);
	$readCategoria = read('cat', "WHERE id = '$categoria'");
	if ($readCategoria) 
	{
		if($campo)
		{
			foreach ($readCategoria as $cat ) 
			{
				return $cat[$campo];
			}
		}else
		{
			return $readCategoria;
		}		
	}else
	{
		return 'Erro ao ler categoria';
	}
}
/************************************************
FUNÇÃO GET AUTOR  "OBS:CONFIGURA O NOME DA TABELA DE USUARIOS"
**************************************************/
function getAutor($autorId, $campo =NULL)
{
	$autorId = mysql_real_escape_string($autorId);
	$readAutor = read('users', "WHERE id = '$autorId'");
	//* @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	//$email = "someone@somewhere.com";
    //$default = "http://www.somewhere.com/homestar.jpg";
    //$size = 40;
    //$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
	if ($readAutor) 
	{
		foreach ($readAutor as $autor); 
			if (!$autor['avatar']):
				$gravatar = "http://www.gravatar.com/avatar/" ;
				$gravatar .= md5(strtolower(trim($autor['email'])));
				$gravatar .= '?d=mm&S=180';
				$autor['foto'] = $gravatar;
			endif;
			if (!$campo) 
			{
				return $autor;
			}else
			{
				return $autor[$campo];
			}		
	}else
	{
		echo 'Erro ao ler autor';
	}
}
/************************************************
FUNÇÃO GET USER
**************************************************/
function getUser($user, $nivel)
{
	if ($nivel != NULL) 
	{
		$readUser = read('users', "WHERE id = '$user'");
		if ($readUser) 
		{
			foreach ($readUser as $usuario); 
			if ($usuario['nivel'] <= $nivel && $usuario['nivel'] != '0' && $usuario['nivel'] <= '4') 
			{
				return true;
			}else
			{
				return false;
			}
		}else
		{
			return false;
		}
	}else
	{
		return true;
	}
}
?>