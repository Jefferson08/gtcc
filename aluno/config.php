<?php 


$config = array();


define("BASE_URL","http://projeto.pc/aluno/");

$config['dbname'] = "projeto";
$config['host'] = "localhost";
$config['dbuser'] = "root";
$config['dbpass'] = "";

global $db;

try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
	echo "Erro".$e->getMessage();
}