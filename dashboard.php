<?php
session_start();
if((!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset($_SESSION['usuario']);
	unset($_SESSION['senha']);
	header('location:index.php');
	}

$logado = $_SESSION['usuario'];
include 'imports.php';
include 'const.php';
$streamChannel = "kiraa132";
function curl($url)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);
return $result;
}
$url = "https://api.twitch.tv/kraken/streams?channel=kiraa132&client_id=bupiptfu5kkele7ikrb8tfhbdblumh";

$json_array = json_decode(curl($url), true);

if(isset($json_array['streams'][0]['channel'])) {
$state="<span style='color:green'>ON</span>";
} else {
$state="<span style='color:red'>OFF</span>";
}
try{
	$PDO2 = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PWD);
	$stmt2 = $PDO2->prepare("SELECT j_nome,j_time FROM jogador WHERE j_email=:email");
	$stmt2->bindParam(':email', $_SESSION['usuario']);
	$stmt2->execute();
  $linha= $stmt2 -> fetch();
  $nome = $linha['j_nome'];
	$time = $linha['j_time'];
} catch(PDOException $e){
	echo 'Não foi possível conectar ao banco de dados. Erro:<br/>' . $e->getMessage();
}
$PDO2 = null;
if($time==null){
	$visibilidade="display:block";
	$visibilidade2="display:none";
} else {
	$visibilidade="display:none";
	$visibilidade2="display:block";
}
try{
	$PDO3 = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PWD);
	$stmt3 = $PDO3->prepare("SELECT j_nome,j_nicklol FROM jogador WHERE j_time IS NULL");
	$stmt3->execute();
  $linha= $stmt3 -> fetchAll();
} catch(PDOException $e){
	echo 'Não foi possível conectar ao banco de dados. Erro:<br/>' . $e->getMessage();
}
try{
	$PDO3 = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PWD);
	$stmt3 = $PDO3->prepare("SELECT t_nome, t_tag FROM timemingles WHERE id_time in (SELECT j_time FROM jogador WHERE j_email=:email);");
	$stmt3->bindParam(':email',$_SESSION['usuario']);
	$stmt3->execute();
	$timetag = $stmt3-> fetch();
	$tag = $timetag['t_tag'];
	$nometime = $timetag['t_nome'];
} catch(PDOException $e){
	echo $e;
}
try{
	$PDO3 = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB, MYSQL_USER, MYSQL_PWD);
	$stmt3 = $PDO3->prepare("SELECT j_nicklol FROM jogador WHERE j_time in (SELECT j_time FROM jogador WHERE j_email=:email) ORDER BY j_nicklol;");
	$stmt3->bindParam(':email',$_SESSION['usuario']);
	$stmt3->execute();
	$nickpre = $stmt3->fetchAll();
} catch(PDOException $e){
	echo $e;
}
$PDO3 = null;
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
			<script src="https://use.fontawesome.com/70ce76317e.js"></script>
			<script
		  src="https://code.jquery.com/jquery-3.1.1.min.js"
		  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		  crossorigin="anonymous"></script>
			<link rel="stylesheet" href="css/jquery-ui.min.css"/>
			<script src="css/jquery-ui.min.js"></script>
			<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
			<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
			<script>
$(function() {
	$(document).tooltip();
} );
</script>
			<meta charset="UTF-8">
			<title>Inscrição Time</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="topMenu">
			II Campeonato de League of Legends do IFBA - Campus Camaçari <span>Bem vindo, <?php echo $nome; ?></span>
		</div>
		<div class="lateralMenu">
			<ul>
				<li class="active"><i class="fa fa-users" aria-hidden="true"></i> <span>Inscrição</span></li>
				<li class="inactive" title="Em breve!"><i class="fa fa-trophy" aria-hidden="true"></i> <span>Jogos</span></li>
				<a href="https://www.twitch.tv/kiraa132" target="_blank"><li><i class="fa fa-twitch" aria-hidden="true"></i> <span>Stream (<?php echo $state; ?>)</span></li></a>
				<a href="https://chat.whatsapp.com/ATHhagZHEcwHI8aE4b3KAP" target="_blank"><li><i class="fa fa-whatsapp" aria-hidden="true"></i> <span>Whatsapp</span></li></a>
				<a href="https://www.facebook.com/groups/270586336716591/?ref=ts&fref=ts" target="_blank"><li><i class="fa fa-facebook-square" aria-hidden="true"></i> <span>Facebook</span></li></a>
				<a href="logout.php"><li><i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span></a>
			</ul>
		</div>
		<div class="principal">
			<div class="containerForm" style=<?php echo $visibilidade; ?>>
				<iframe name="ins" style="display:none"></iframe>
				<form action="inscricaotime.php" method="post">
				        <label for="nome">Nome do Time:</label>
				        <input type="text" name="t_nome" id="t_nome" required><br />
								<label for="tagtime">Tag do Time:</label>
								<input type="text" name="t_tag" id="t_tag" maxlength="5" required><br />
				        <label for="players">Jogadores:</label>
				        <select class="js-example-basic-multiple-limit" name="jogadores[]" id="jogadores" multiple="multiple" min="5" required>
									<?php
										foreach ($linha as $value) {
											echo "<option value=\"{$value['j_nicklol']}\">{$value['j_nome']}({$value['j_nicklol']})</option>";
										}
									?>
				        </select><br />
								<script type="text/javascript">
								$("#jogadores").select2({
									maximumSelectionLength:5
								});
								</script>
				    		<input type="submit" id="submit" class="button" value="Submit">
				</form>
			</div>
			<div class="containerForm" style=<?php echo $visibilidade2; ?>>
				Seu time já está inscrito! Aguarde até a liberação das chaves (assim que todos times estiverem inscritos)!
				<div class="time">
<h2><?php echo "{$nometime} [{$tag}]" ?></h2>
<?php
	foreach ($nickpre as $value) {
		echo "<span>{$value['j_nicklol']}</span><br />";
	}
?>
				</div>
			</div>
		</div>
	</body>
</html>
