<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de coletas</title>
    <link rel="stylesheet" href="css/consultar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <form class="" action="" method="post">
      <div class="menu">
        <h3>MENU</h3>
        <p>Ultima atualização: <?php echo date("H:i"); ?></p>
        <hr>
        <button type="submit" value="0" name="ini">INICÍO</button>
        <button type="submit" value="0" name="nova">NOVA COLETA</button>
      </div>
      </form>
    <div class="direita">
        <div class="dentroForm">
        <form action="busca.php" method="POST">
        <p>Buscar Coletas</p>
        <p style="width: 49%; float: left;">
          Data Inicio <br>
          <input id="busca" class="form-control" type="date" name="coleta" id="">
        </p>
        <p style="width: 49%; float: right">
          Data fim <br>
          <input id="busca2" type="date" class="form-control" name="coleta2" id="">
        </p>
            <br><br>
            <input class="btn btn-primary" type="submit" value="Consultar">
            
        </form>
        </div>
    </div>
</body>
</html>