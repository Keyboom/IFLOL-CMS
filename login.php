<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php include 'imports.php' ?>
<title>Inscrição Jogos</title>
</head>
<body>
    <div class="title" style="margin-top:20%">
      II Campeonato de LoL do IFBA
    </div>
    <div class="box">
        <center>LOGIN</center>
        <form action="doLogin.php" method="post">
              <input type="text" class="form-control" id="username" name="username" placeholder="Email" required="" autofocus=""/>
              <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required="" autofocus=""/>
            <center><input type="submit" value="Enviar"></center>
        </form>
    </div>
</body>
</html>
