<?php
session_start();
include_once("./../preventivo.php");
include_once("./../conexao.php");
include_once("./../class.php");
$aux = new Coleta;
 ?>
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
    <link rel="stylesheet" href="css/novaColeta.css">
  </head>
  <body>
    <div class="corpo">
      <form class="" action="" method="post">
      <div class="menu">
        <h3>MENU</h3>
        <hr>
        <button type="submit" value="0" name="ini">INICÍO</button>
        <button type="submit" value="0" name="nova">NOVA COLETA</button>
      </div>
    </form>

    <div class="cadastroCorpo">
      <div class="formNovaColeta">
        <h4>Cadastrar coleta</h4>
        <form class="" enctype="multipart/form-data" action="" method="post">
          <div class="grid">
            <div class="conteudo">
              <p>Numero da coleta</p>
              <input type="text" class="form-control" name="numC" value="" required>
            </div>
            <div class="conteudo">
              <p>Cliente</p>
              <input type="text" class="form-control" name="cliente" value="" required>
            </div>
            <div class="conteudo">
              <p>Agente</p>
              <select class="form-control" name="agente">
                <option value=""></option>
                <?php
                $sql = "SELECT * FROM tbdagente";
                $sql = $conn->query($sql) or die($conn->error);
                while ($dado = $sql->fetch_array()) {
                 ?>
                <option value="<?php echo $dado['NOME']; ?>"><?php echo $dado['NOME']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="conteudo">
              <p>Hora de início e fim do periodo de coleta</p>
              <p><input type="time" class="form-control" style="width: 49%; float: left;" name="hora" value="" required> <input type="time" class="form-control" style="width: 49%; float: right;" name="hora2" value="" required></p>
            </div>
            <div class="conteudo">
              <p>PDF da coleta:</p>
              <input type="file" id="ajustaPDF" accept=".pdf" class="form-control" name="pdf" value="" required>
            </div>
            <div class="conteudo">
              <p>Data limite para coleta:</p>
              <input type="date" class="form-control" name="dtlim" value="" required>
            </div>
            <div class="conteudo">
              <p>Hora limite para coleta:</p>
              <input type="time" class="form-control" name="horalim" value="" required>
            </div>
          </div>
          <br>
          <p>Observações:</p>
          <textarea class="form-control" name="obs" rows="8" cols="80"></textarea>
          <br>
          <input type="submit" name="cad" class="cad" value="Cadastrar Coleta">
        </form>
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
if (isset($_POST['cad'])) {

$coleta = removeCaracteresSQL($_POST['numC']);
$cliente = removeCaracteresSQL($_POST['cliente']);
$hora = removeCaracteresSQL($_POST['hora']);
$hora2 = removeCaracteresSQL($_POST['hora2']);
$observacao = removeCaracteresSQL($_POST['obs']);
$agente = removeCaracteresSQL($_POST['agente']);
$datalim = removeCaracteresSQL($_POST['dtlim']);
$horalim = removeCaracteresSQL($_POST['horalim']);
$pdf = $_FILES['pdf'];

$col = new Coleta;
$col->numeroColeta = $coleta;
$col->cliente = $cliente;
$col->agente = $agente;
$col->horaIni = $hora;
$col->horaFim = $hora2;
$col->dataLim = $datalim;
$col->horaLim = $horalim;
$col->observacao = $observacao;
$col->pdfColeta = $pdf;

$col -> setColeta();

?>
<script type="text/javascript">
    alert("Registrado com sucesso!");
    window.location.href = "index.php";
</script>
<?php

}
 ?>
