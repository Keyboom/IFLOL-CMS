
<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php include 'imports.php' ?>
<?php include 'const.php' ?>
<title>Inscrição Jogos</title>
</head>
<body>
    <div class="title">
      II Campeonato de LoL do IFBA
    </div>
    <div class="box">
    	<?php
      session_start();
try{
	$PDO2 = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PWD);
	$stmt2 = $PDO2->prepare("SELECT j_senha FROM jogador WHERE j_email=:email");
	$stmt2->bindParam(':email', $usuario2);
	$usuario2 = $_POST['username'];
	$senha2 = $_POST['password'];
	$stmt2->execute();
  $linha= $stmt2 -> fetch();
  $resultado = $linha['j_senha'];
  if($senha2===$resultado){
      $_SESSION['usuario']=$usuario2;
      $_SESSION['senha']=$senha2;
	   header('Location: dashboard.php',0);
   } else {
     echo "Senha Incorreta!";
   }
} catch(PDOException $e){
	echo 'Não foi possível conectar ao banco de dados. Erro:<br/>' . $e->getMessage();
}
$PDO2 = null;
?>

    </div>
</body>
</html>
