<?php
session_start();
if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset($_SESSION['usuario']);
	unset($_SESSION['senha']);
	header('location:index.php');
	}
include 'const.php';
try{
	$PDO = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PWD);

	$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $PDO->prepare("INSERT INTO timemingles (t_nome,t_tag) VALUES (:t_nome,:t_tag);");
	$stmt->bindParam(':t_nome', $nometime);
	$stmt->bindParam(':t_tag', $tag);
	$nometime = $_POST['t_nome'];
	$tag = $_POST['t_tag'];
	$stmt->execute();
} catch(PDOException $e){
	echo 'Não foi possível conectar ao banco de dados. Erro: ' . $e->getMessage();
}
$stmt = $PDO->prepare("SELECT id_time FROM timemingles WHERE t_nome=:t_nome");
	$stmt->bindParam(':t_nome', $nometime);
$stmt->execute();
$id = $stmt->fetch();
$idfinal = $id['id_time'];
$stmt=$PDO->prepare("UPDATE jogador SET j_time=:id WHERE j_nicklol = :pessoa1 or j_nicklol = :pessoa2 or j_nicklol = :pessoa3 or j_nicklol = :pessoa4 or j_nicklol = :pessoa5");
$stmt->bindParam(':pessoa1',$_POST['jogadores'][0]);
$stmt->bindParam(':pessoa2',$_POST['jogadores'][1]);
$stmt->bindParam(':pessoa3',$_POST['jogadores'][2]);
$stmt->bindParam(':pessoa4',$_POST['jogadores'][3]);
$stmt->bindParam(':pessoa5',$_POST['jogadores'][4]);
$stmt->bindParam(':id',$idfinal);
$stmt->execute();
$PDO = null;
echo "<center>Time Inscrito com sucesso!</center>";
header('Location:dashboard.php',5);
?>
