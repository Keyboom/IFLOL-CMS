
<!DOCTYPE html>
<html lang="pt-br">
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
  $(".js-example-basic-multiple-limit").select2({
    maximumSelectionLength: 5
  });
</script>
<meta charset="UTF-8">
<title>Inscrição Time</title>
</head>
<body>
<form action="inscricaotime.php" method="post">
    <p>
        <label for="nome">Nome do Time:</label>
        <input type="text" name="t_nome" id="t_nome" required>
    </p>
    <p>
        <label for="players">Jogadores:</label>
        <select class="js-example-basic-multiple-limit" name="jogadores" id="jogadores" multiple="multiple">
            <option>teste</option>
            <option>test3ew</option>
            <option>testewqe</option>
            <option>testdsae</option>
        </select>
    </p>
    <input type="submit" value="Submit">
</form>
</body>
</html>