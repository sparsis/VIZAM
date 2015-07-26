<?php
require('iniSis.php');
$conn = mysql_connect(HOST,USER,PASS) or die('Erro ao connectar: '.mysql_error());
$db = mysql_select_db(DB) or die('Erro ao selecionar o Banco: '.mysql_error());
/************************************************
FUNÇÃO DE CADASTRO NO BANCO
**************************************************/
function create($tabela, array $datas)
{
	$fields = implode(", ", array_keys($datas));
	$values = "'".implode("', '", array_values($datas))."'";
	$qrCreate = "INSERT INTO {$tabela} ($fields) VALUES($values)";
	$stCreate = mysql_query($qrCreate) or die('Erro ao Cadastrar em '.$tabela.' '.mysql_error());
	if ($stCreate) 
	{ 
		return true;
	}	
}
/************************************************
FUNÇÃO PARA LER OS CADASTROS DO BANCO
**************************************************/
function read($tabela, $cond = NULL)
{
	//$where = ($where != NULL ? "WHERE $where": "");
	$qrRead = "SELECT * FROM {$tabela} {$cond}";
	$stRead = mysql_query($qrRead) or die('Erro ao ler em '.$tabela.' '.mysql_error());
	$cField = mysql_num_fields($stRead);
	for ($i=0; $i < $cField; $i++) 
	{ 
		$names[$i] = mysql_field_name($stRead, $i);
	}
	for ($x=0; $res = mysql_fetch_assoc($stRead) ; $x++ ) 
	{
		for ($y = 0; $y < $cField ; $y++) 
		{ 
			$result[$x][$names[$y]] = $res[$names[$y]];
		}
	}	
	return $result;
}
/************************************************
FUNÇÃO  DE EDIÇÃO DO BANCO
**************************************************/
function update($tabela, array $datas, $where)
{
	foreach ($datas as $fields => $values) 
	{
		$campos[] = "$fields = '$values'";
	}
	$campos = implode(", ", $campos);
	$qrUpdate = "UPDATE {$tabela} SET $campos WHERE {$where}";
	$stUpdate = mysql_query($qrUpdate) or die('Erro ao Atualizar em '.$tabela.' '.mysql_error());
	if ($stUpdate) 
	{
		return true ;
	}
}
/************************************************
FUNÇÃO  DE DELETAR NO BANCO
**************************************************/
function delete($tabela, $where)
{
	$qrDelete = "DELETE FROM {$tabela} WHERE $where ";
	$stDelete = mysql_query($qrDelete) or die('Erro ao Deletar em '.$tabela.' '.mysql_error());
	if ($stDelete) 
	{
		return true ;
	}
}
?>