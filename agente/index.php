<?php
session_start();
$_SESSION['id'] = "";
 ?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home - Agente</title>
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
      </div>
      </form>
      <div class="direito">

        <div class="grid">
          <?php
          include_once("./../conexao.php");
          include_once("./../funcoes.php");
          $sql = "SELECT * FROM tbdcoletas WHERE CONCLUIDO = '0'";
          $sql = $conn->query($sql) or die($conn->error);
          while($dado = $sql->fetch_array()){
            $id = $dado['IDREGISTRO'];
            $coletado = "disabled";
            $info = "disabled";
            $emb = "disabled";
            $aceitar = "";
            if ($dado['ACEITA'] == 1) {

              $coletado = "";
              $aceitar = "disabled";
            }
            if ($dado['COLETADO'] == 1) {
              $info = "";
              $coletado = "disabled";
            }
            if ($dado['EMITIDO'] == 1) {
              $info = "disabled";
              $emb = "";
            }
            if ($dado['EMBARQUE'] == 1) {
              $emb = "";
            }

           ?>
           <div class="conteudo">
             <p>Numero da colta: <?php echo $dado['NUMEROCOLETA']; ?></p>
             <p>PDF Coleta: <a href="<?php echo $dado['PDFCOLETA']; ?>" download="<?php echo $dado['PDFCOLETA']; ?>" >DOWNLOAD</a></p>
             <?php
             if ($dado['EMITIDO'] != 0) {
               $sql2 = "SELECT * FROM tbdcte WHERE IDCOLETA = '$id'";
               $sql2 = $conn->query($sql2) or die($conn->error);
               while($dado2 = $sql2->fetch_array()){
              ?>
              <p> <a href="<?php echo $dado2['CTE']; ?>" download="<?php echo $dado2['CTE']; ?>" >DOWNLOAD CTE</a> </p>
            <?php } ?>
            <?php
            $sql2 = "SELECT * FROM tbdautorizacao WHERE IDCOLETA = '$id'";
            $sql2 = $conn->query($sql2) or die($conn->error);
            while($dado2 = $sql2->fetch_array()){
           ?>
           <p> <a href="<?php echo $dado2['AUTORIZACAO']; ?>" download="<?php echo $dado2['AUTORIZACAO']; ?>">DOWNLOAD AUTORIZACAO</a> </p>
         <?php } ?>
          <?php } ?>
             <form class="" action="" method="post">
               <p class="meio"> <button type="submit" value="<?php echo $dado['IDREGISTRO']; ?>" name="aceitar" <?php echo $aceitar; ?>>Aceitar</button>
                 <button type="submit" value="<?php echo $dado['IDREGISTRO']; ?>" name="coletado" <?php echo $coletado; ?>>Coletado</button>
                 <button type="submit" value="<?php echo $dado['IDREGISTRO']; ?>" name="info" <?php echo $info; ?>>Adicionar Informação</button>
               </p>
               <p class="meio"> <button type="submit" value="<?php echo $dado['IDREGISTRO']; ?>" name="emb" <?php echo $emb; ?>>Informar embarque</button> </p>
             </form>
           </div>
          <?php } ?>


          </div>
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
if (isset($_POST['info'])) {
  $_SESSION['id'] = $_POST['info'];
  ?>
  <script type="text/javascript">
      window.location.href = "informacao.php";
  </script>
  <?php
}
if (isset($_POST['emb'])) {

  $_SESSION['id'] = $_POST['emb'];
  ?>
  <script type="text/javascript">
      window.location.href = "embarque.php";
  </script>
  <?php
}
if (isset($_POST['aceitar'])) {
  include_once("./../conexao.php");
  include_once("./../funcoes.php");
  $id = $_POST['aceitar'];
  $data = date("Y-m-d");
  $hora = date("H:i");
  $sql = "UPDATE tbdcoletas SET ACEITA = '1' WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  $sql = "UPDATE tbdcoletas SET DATAACEITE = '$data' WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  $sql = "UPDATE tbdcoletas SET HORAACEITE = '$hora' WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php
}
if (isset($_POST['coletado'])) {
  include_once("./../conexao.php");
  include_once("./../funcoes.php");
  $id = $_POST['coletado'];
  $data = date("Y-m-d");
  $hora = date("H:i");
  $sql = "UPDATE tbdcoletas SET COLETADO = '1' WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  $sql = "UPDATE tbdcoletas SET DATACOLETADO = '$data' WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  $sql = "UPDATE tbdcoletas SET HORACOLETADO = '$hora' WHERE IDREGISTRO = '$id'";
  $sql = $conn->query($sql) or die($conn->error);
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php

}
 ?>
