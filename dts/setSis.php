<?php
/********************************
SETA A URL DA HOME
*********************************/
function setHome()
{
	echo BASE;
}
/********************************
INCLUDE ARQUIVOS
*********************************/
function setArq($nomeArquivo)
{
	if (file_exists($nomeArquivo.'.php')) 
	{
		include($nomeArquivo.'.php');
	}else
	{
		echo 'Erro ao incluir <strong>'.$nomeArquivo.'.php </strong>, arquivo ou caminho n&atilde;o encontrado';
	}
}
/********************************
TRANSFORMA STRING EM URL
*********************************/
function setUri($string){
    $string = strtolower(utf8_decode($string)); $i=1;
    $string = strtr($string, utf8_decode('àáâãäåæçèéêëìíîïñòóôõöøùúûýýÿ'), 'aaaaaaaceeeeiiiinoooooouuuyyy');
    $string = preg_replace("/([^a-z0-9])/",'-',utf8_encode($string));
    while($i>0) $string = str_replace('--','-',$string,$i);
    if (substr($string, -1) == '-') $string = substr($string, 0, -1);
    return $string;
}
/********************************
SOMA VISITAS 
*********************************/
function setViews($topicoId)
{
	$topicoId = mysql_real_escape_string($topicoId);
	$readArtigo = read('posts', "WHERE id = '$topicoId'");

	foreach ($readArtigo as $artigo); 
	$views = $artigo['visitas'];
	$views = $views +1;
	$dataViews = array(
		'visitas' => $views );
	update('posts', $dataViews, "id = '$topicoId'");
}
?>
