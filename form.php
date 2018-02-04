
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
        <form action="inscricao.php" method="post">
            <p>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>
            </p>
            <p>
                <label for="nick">Nick no LoL:</label>
                <input type="text" name="nick" id="nick" required>
            </p>
            <p>
                <label for="senha">Senha: <!--(Evite usar a sua senha do LoL; esta será utilizada para editar seu time no site)--></label>
                <input type="password" name="senha" id="senha" placeholder="(Evite usar a sua senha do LoL; esta será utilizada para editar seu time no site)" required>
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required>
            </p>
            <p>
                <label for="wpp">Número Whatsapp:</label>
                <input type="text" name="wpp" id="wpp">
            </p>
            <p>
                <label for="curso">Curso:</label>
                <input type="text" name="curso" id="curso" required>
            </p>
            <p>
                <label for="ano">Ano:</label>
                <input type="text" name="ano" id="ano" required>
            </p>
            <p>
                <label for="concordo">Concordo em haver inscrição e prêmio:</label>
                <input type="radio" name="concordo" id="concordo" value="true">Sim
                <input type="radio" name="concordo" id="concordo" value="false">Não
            </p>
            <center><input type="submit" value="Enviar"></center>
        </form>
    </div>
</body>
</html>
