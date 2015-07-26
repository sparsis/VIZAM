<?php
require('iniSis.php');
$conn = mysql_connect(HOST,USER,PASS) or die('Erro ao connectar: '.mysql_error());
$db = mysql_select_db(DB) or die('Erro ao selecionar o Banco: '.mysql_error());
/************************************************
GERA RESUMOS
**************************************************/
function lmWord($string, $words = '100')
{
	$string = strip_tags($string); // Revovendo as Tags HTML para retornar só as Strings
	$count 	= strlen($string);		// retorna a quantidade de String na variável
	if ($count <= $words) 
	{
		return $string;
	}
	else
	{
		$strpos = strrpos(substr($string, 0, $words),' ');
		return substr($string,0, $strpos).' [...]';
	}
}
/************************************************
VALIDA CPF
**************************************************/
function ValCpf($cpf)
{
	$cpf = preg_replace('/[^0-9]/','',$cpf);
	$digtoA = 0;
	$digtoB = 0;
	for($i=0, $x=10; $i <=8 ; $i++, $x--) 
	{ 
		$digtoA += $cpf[$i] * $x;
	}
	for($i=0, $x=11; $i <=9 ; $i++, $x--)
	 { 
		if (str_repeat($i, 11) == $cpf) 
		{
			return false;
		}
		$digtoB += $cpf[$i] * $x;
	 }	
	$somaA = (($digtoA%11) < 2) ? 0 : 11-($digtoA%11);
	$somaB = (($digtoB%11) < 2) ? 0 : 11-($digtoB%11);	
	if($somaA != $cpf[9] || $somaB != $cpf[10])
	{
	 	return false;
	}
	else
	{
		return true;
	}
}
/************************************************
VALIDAR EMAIL
**************************************************/
function valMail($email)
{
	if (preg_match('/^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/',$email)) {
		return true;
	}
	else
	{
		return false;
	}	
}
/************************************************
ENVIAR EMAIL
**************************************************/
function sendMail($assunto,$mensagem,$remetente,$nomeRemetente,$destino,$nomeDestino, $reply = NULL, $replyNome = NULL)
{
		require_once('mail/PHPMailerAutoload.php'); //Include pasta/classe do PHPMailer
		
		$mail = new PHPMailer(); //INICIA A CLASSE
		$mail->IsSMTP(); //Habilita envio SMPT
		$mail->SMTPAuth = true; //Ativa email autenticado
		$mail->IsHTML(true);
		$mail->SMTPSecure = 'tls'; 
	   //$mail->SMTPSecure = 'ssl'; 
		$mail->SMTPDebug = 2;		
		$mail->Host = MAILHOST; //Servidor de envio
		$mail->Port = MAILPORT; //Porta de envio
		$mail->Username = MAILUSER; //email para smtp autenticado
		$mail->Password = MAILPASS; //seleciona a porta de envio
		//$mail->wordWarp = 50;		
		$mail->From = utf8_decode($remetente); //remetente
		$mail->FromName = utf8_decode($nomeRemetente); //remtetene nome		
		if($reply != NULL)
		{
			$mail->AddReplyTo(utf8_decode($reply),utf8_decode($replyNome));	
		}		
		$mail->Subject = utf8_decode($assunto); //assunto
		$mail->Body = utf8_decode($mensagem); //mensagem
		$mail->AddAddress(utf8_decode($destino),utf8_decode($nomeDestino)); //email e nome do destino		
		if($mail->Send())
		{
			return true;
		}else
		{
			return false;
		}
}
/************************************************
FORMATA DATA EM TIMESTAMP
**************************************************/
function formDate($data)
{
	$timestamp =explode(" ", $data);
	$getData = $timestamp[0];
	$getTime = $timestamp[1];

	$setData = explode('/', $getData);
	$dia = $setData[0];
	$mes = $setData[1];
	$ano = $setData[2];

	if (!$getTime):
		$getTime = date('H:i:s');
	endif;

	$resultado = $ano.'-'.$mes.'-'.$dia.' '.$getTime;

	return $resultado;
}
/************************************************
MANAGER ESTATISTICAS OBS: CONFIGURAR CONFORME A TABELA CRIADA
**************************************************/
function viewManager($times = 2)
{	
	$selMes = date('m');
	$selAno = date('Y');
	if (empty($_SESSION['startView']['sessao'])) 
	{
		$_SESSION['startView']['sessao'] = session_id();
		$_SESSION['startView']['ip'] =  $_SERVER['REMOTE_ADDR'];
		$_SESSION['startView']['url'] = $_SERVER['PHP_SELF'];
		$_SESSION['startView']['time_end'] = time() + $times;
		create('views_online',$_SESSION['startView']);
		$readViews = read('views', "WHERE mes= '$selMes' AND ano = $selAno ");
		if (!$readViews) 
		{
			$createViews = array('mes' =>$selMes , 'ano' => $selAno );
			create('views', $createViews);
		} else
		{
			foreach ($readViews as $views);
			if (empty($_COOKIE['startView']))  
			{
				$updateViews = array(
					'visitas' => $views['visitas']+1, 
					'visitantes' => $views['visitantes']+1 
				);
				update('views', $updateViews, "mes = '$selMes' AND ano = '$selAno'");
				setcookie('startView', time(), time()+60*60*24, '/');
			}else
			{
				$updateVisitas = array('visitas' => $views['visitas']+1 );
				update('views', $updateVisitas, "mes = '$selMes' AND ano = '$selAno'"); 
			}
		}
	}else
	    {
	    	$readPageViews = read('views', "WHERE mes = '$selMes' AND ano = '$selAno'");
	    	if ($readPageViews) 
	    	{
	    		foreach ($readPageViews as $value) 
	    		{
	    			$updatePageViews = array('pageviews' => $value['pageviews']+1);
	    			update('views', $updatePageViews, "mes = '$selMes' AND ano = '$selAno'"); 
	    		}
	    	}

			$id_sessao = $_SESSION['startView']['sessao'];
			if (($_SESSION['startView']['time_end']) <= time() ) 
		{
			delete('views_online', "sessao = '$id_sessao' OR time_end <= time(NOW())");
			unset($_SESSION['startView']);
		}else
		{
			$_SESSION['startView']['time_end'] = time() + $times;
			$timeEnd = array('time_end' => $_SESSION['startView']['time_end']);
			update('views_online',$timeEnd, "sessao = '$id_sessao'");
		}
	}
	$time = time();
	$readViewsEnds = read('views_online', "WHERE time_end < '$time'");
	if ($readViewsEnds) 
	{
		foreach ($readViewsEnds as $viewsEnd):
			delete('views_online',"id = '$viewsEnd[id]'");
		endforeach;
	}
}
/************************************************
PAGINAÇÃO DE RESULTADOS
**************************************************/
function readPaginator($tabela, $cond, $maximos, $link, $pag, $width = NULL, $maxlinks = 4)
{
	$readPaginator = read("$tabela", "$cond");
	$total = count($readPaginator);

	if ($total > $maximos) 
	{
		$paginas = ceil($total/$maximos);
		if ($width) 
		{
			echo '<div class="paginator" style="width:'.$width.'">';
		}else
		{
			echo '<div class="paginator">';
		}
		echo '<a href="'.$link.'1">Primeira Página</a>';

		for($i = $pag - $maxlinks; $i <= $pag - 1; $i++)
		{
			if ($i >= 1) 
			{
				echo '<a href="'.$link.$i.'">'.$i.'</ a>';
			}
		}	
		echo '<span class="atv">'.$pag.'</span>';
		for($i = $pag + 1; $i <= $pag + $maxlinks; $i++)
		{
			if ($i <= $paginas) 
			{
				echo '<a href="'.$link.$i.'">'.$i.'</ a>';
			}
		}	
		echo '<a href="'.$link.$paginas.'">Última Página</ a>';
		echo '</div><!-- /paginator -->';
	}
}
/************************************************
ENVIAR IMAGENS
**************************************************/
function uploadImage($tmp, $nome, $width, $pasta)
{
	$ext = substr($nome, -3);
	switch ($ext) {
		case 'jpg': $img = imagecreatefromjpeg($tmp); break;
		case 'png': $img = imagecreatefrompng($tmp); break;
		case 'gif': $img = imagecreatefromgif($tmp); break;			
	}
	$x = imagesx($img);
	$y = imagesy($img);
	$height = ($width * $y) /$x;
	$new = imagecreatetruecolor($width, $height);
	imagealphablending($new, false);
	imagesavealpha($new, true);
	imagecopyresampled($new, $img, 0, 0, 0, 0, $width, $height, $x, $y);
	switch ($ext) {
		case 'jpg': imagejpeg($new, $pasta.$nome, 100); break;
		case 'png': imagepng($new, $pasta.$nome); break;
		case 'gif': imagegif($new, $pasta.$nome); break;			
	}
	imagedestroy($img);
	imagedestroy($new);
}
?>