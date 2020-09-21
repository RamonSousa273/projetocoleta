<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home - Operação</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/anexar.css">
  </head>
  <body>
    <div class="corpo">
      <form class="" action="" method="post">
      <div class="menu">
        <h3>MENU</h3>
        <hr>
        <button type="submit" value="0" name="ini">INICÍO</button>
      </div>
      </form>
      <div class="direito">
        <div class="grid">
          <div class="conteudo">

          </div>
          <div class="conteudo2">
            <form class="" enctype="multipart/form-data" action="" method="post">
              <h3>Anexar CTE/Autorização</h3>
              <p>CTE:</p>
              <input type="file" class="form-control" name="CTE" value="">
              <br>
              <p>Autorização:</p>
              <input type="file" class="form-control" name="AUTO" value="">
              <br>
              <button type="submit" class="btn btn-primary" name="ANEXAR">Anexar</button>
              <br>
              <br>
            </form>
          </div>
          <div class="conteudo">

          </div>
        </div>
      </div>


    </div>
  </body>
</html>
<?php
if (isset($_POST['ini'])) {
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php
}
if (isset($_POST['ANEXAR'])) {
  include_once("./../conexao.php");
  include_once("./../funcoes.php");
  $id = $_SESSION['id'];
  $data = date("Y-m-d");
  $hora = date("H:i");
if ($_FILES['CTE']['error'] == 4) {
}else{
  $c = 0;
  $sql = "SELECT * FROM tbdcte WHERE IDCOLETA = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  while($dado = $sql->fetch_array()){
    $c=$c+1;
  }

  $coleta = $id."cte";
  $ext = ".pdf";
  $new_name = $coleta . $c . $ext;
  $dir = "./../uploads/";
  if (move_uploaded_file($_FILES['CTE']['tmp_name'], $dir.$new_name)){
    $local = "./../uploads/" . $new_name;
    $sql = "INSERT INTO tbdcte(CTE, IDCOLETA) VALUES('$local', '$id')";
    $sql = $conn->query($sql) or die($conn->error);
    $sql = "UPDATE tbdcoletas SET CTE = '1' WHERE IDREGISTRO = '$id'";
    $sql = $conn->query($sql) or die($conn->error);
    $sql = "UPDATE tbdcoletas SET EMITIDO = '1' WHERE IDREGISTRO = '$id'";
    $sql = $conn->query($sql) or die($conn->error);
    $sql = "UPDATE tbdcoletas SET DATAEMITIDO = '$data' WHERE IDREGISTRO = '$id'";
    $sql = $conn->query($sql) or die($conn->error);
    $sql = "UPDATE tbdcoletas SET HORAEMITIDO = '$hora' WHERE IDREGISTRO = '$id'";
    $sql = $conn->query($sql) or die($conn->error);
  }
}
if ($_FILES['AUTO']['error'] == 4) {
}else{

  $c = 0;
  $sql = "SELECT * FROM tbdautorizacao WHERE IDCOLETA = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  while($dado = $sql->fetch_array()){
    $c=$c+1;
  }

  $coleta = $id."autorizacao";
  $ext = ".pdf";
  $new_name = $coleta . $c . $ext;
  $dir = "./../uploads/";
  if (move_uploaded_file($_FILES['AUTO']['tmp_name'], $dir.$new_name)){
    $local = "./../uploads/" . $new_name;
    $sql = "INSERT INTO tbdautorizacao(AUTORIZACAO, IDCOLETA) VALUES('$local', '$id')";
    $sql = $conn->query($sql) or die($conn->error);
    $sql = "UPDATE tbdcoletas SET AUTORIZACAO = '1' WHERE IDREGISTRO = '$id'";
    $sql = $conn->query($sql) or die($conn->error);
    $sql = "UPDATE tbdcoletas SET EMITIDO = '1' WHERE IDREGISTRO = '$id'";
    $sql = $conn->query($sql) or die($conn->error);
    $sql = "UPDATE tbdcoletas SET DATAEMITIDO = '$data' WHERE IDREGISTRO = '$id'";
    $sql = $conn->query($sql) or die($conn->error);
    $sql = "UPDATE tbdcoletas SET HORAEMITIDO = '$hora' WHERE IDREGISTRO = '$id'";
    $sql = $conn->query($sql) or die($conn->error);
  }
}
?>
<script type="text/javascript">
    alert("Anexado com sucesso!");
    window.location.href = "index.php";
</script>
<?php
}

 ?>
