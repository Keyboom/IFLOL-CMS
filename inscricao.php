
<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php include 'imports.php' ?>
<title>Inscrição Jogos</title>
</head>
<body>
    <div class="title">
      II Campeonato de LoL do IFBA
    </div>
    <div class="box">
    	<?php
include 'const.php';
try{
	$PDO = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PWD);
	$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $PDO->prepare("INSERT INTO jogador (j_nome, j_nicklol, j_email, j_numWhats, j_curso, j_ano, j_concorda, j_senha) VALUES (:nome, :nick, :email, :numero, :curso, :ano, :concordo, :senha)");
	$stmt->bindParam(':nome', $nome);
	$stmt->bindParam(':nick',$nick);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':numero',$numero);
	$stmt->bindParam(':curso', $curso);
	$stmt->bindParam(':ano',$ano);
	$stmt->bindParam(':concordo',$concordo);
	$stmt->bindParam(':senha', $senha);
	$nome = $_REQUEST['nome'];
	$nick = $_REQUEST['nick'];
	$email = $_REQUEST['email'];
	$numero = $_REQUEST['wpp'];
	$curso = $_REQUEST['curso'];
	$ano = $_REQUEST['ano'];
	$concordo = filter_var($_REQUEST['concordo'], FILTER_VALIDATE_BOOLEAN);
	$senha = $_REQUEST['senha'];
	$stmt->execute();
	echo "Inscrição realizada com sucesso!";
} catch(PDOException $e){
	echo 'Não foi possível conectar ao banco de dados. Erro: ' . $e->getMessage();
}
$PDO = null;
?>

    </div>
</body>
</html>

