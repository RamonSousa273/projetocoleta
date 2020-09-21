<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home - SAC/Torre de Controle</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <script type="text/javascript">

      Redirect();
      function Redirect()
      {
              setTimeout("location.reload(true);",120000);
      }
    </script>
  </head>
  <body>
    <div class="corpo">
      <form class="" action="" method="post">
      <div class="menu">
        <h3>MENU</h3>
        <p>Ultima atualização: <?php echo date("H:i"); ?></p>
        <hr>
        <button type="submit" value="0" name="ini">INICÍO</button>
        <button type="submit" value="0" name="nova">NOVA COLETA</button>
      </div>
      </form>
      <div class="coletaPrev">
        <div class="titulo">
          <h3>COLETAS</h3>
        </div>
        <div class="grid">
          <?php
          include_once("./../conexao.php");
          include_once("./../funcoes.php");
          $sql = "SELECT * FROM tbdcoletas WHERE CONCLUIDO = '0' ORDER BY DATALIMITE";
          $sql = $conn->query($sql) or die($conn->error);
          while($dado = $sql->fetch_array()){
            $progresso = verificaEstagio($dado);
           ?>
          <div class="conteudo">
            <form class="" action="" method="post">
            <p>Numero da coleta: <?php echo $dado['NUMEROCOLETA']; ?> <button style="background-color: #FA5858;" type="submit" name="excluir" value="<?php echo $dado['IDREGISTRO']; ?>">Excluir</button>
              <button style="background-color: #2E9AFE;" type="submit" name="dados" value="<?php echo $dado['IDREGISTRO']; ?>">Dados</button>
              <button style="background-color: #64FE2E;" type="submit" name="consolidar" value="<?php echo $dado['IDREGISTRO'];?>" <?php echo $progresso['con']; ?> >Consolidar</button>
              <?php echo date('d/m/Y', strtotime($dado['DATALIMITE'])); ?>
            </p>

            </form>
            <div class="progress">
              <div class="<?php echo $progresso['class']; ?>" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progresso['valor']; ?>%"><?php echo $progresso['estagio']; ?></div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </body>
</html>
<?php
if (isset($_POST['nova'])) {
  ?>
  <script type="text/javascript">
      window.location.href = "novaColeta.php";
  </script>
  <?php
}
if (isset($_POST['ini'])) {
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php
}
if (isset($_POST['dados'])) {
  $id = $_POST['dados'];
  $_SESSION['id'] = $id;
  ?>
  <script type="text/javascript">
      window.location.href = "dados.php";
  </script>
  <?php
}
if (isset($_POST['excluir'])) {
  $id = $_POST['excluir'];
  include_once("./../conexao.php");
  $sql = "DELETE FROM tbdcoletas WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php
}
if (isset($_POST['consolidar'])) {
  $id = $_POST['consolidar'];
  $data = date("d/m/Y");
  $hora = date("H:i");
  include_once("./../conexao.php");
  $sql = "UPDATE tbdcoletas SET CONCLUIDO = '1' WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  $sql = "UPDATE tbdcoletas SET DATAEMBARQUE = '$data' WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  $sql = "UPDATE tbdcoletas SET HORAEMBARQUE = '$hora' WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php
}

 ?>
