<?php 


$config = array();


define("BASE_URL","http://projeto.pc/banca/");

$config['dbname'] = "projeto";
$config['host'] = "localhost";
$config['dbuser'] = "root";
$config['dbpass'] = "";

global $db;

try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);

} catch (PDOException $e) {
	echo "Erro".$e->getMessage();
}