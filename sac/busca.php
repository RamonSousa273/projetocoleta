<?php
session_start();
include_once("./../class.php");
include_once("./../funcoes.php");
$aux = new Coleta();

$data = $_POST['coleta'];
$data2 = $_POST['coleta2'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/busca.css">
</head>
<body>
    <form class="" action="" method="post">
      <div class="menu">
        <h3>MENU</h3>
        <hr>
        <button type="submit" value="0" name="ini">INICÍO</button>
        <button type="submit" value="0" name="nova">NOVA COLETA</button>
      </div>
    </form>

    <div class="direita">
    <div class="grid">
          <?php
          $registros = $aux -> buscarColetaData($data, $data2);
          $q = count($registros);
          for ($i=0; $i < $q ; $i++) {
            $progresso = verificaEstagio($registros[$i]);
			$auto = "disabled";
			if ($registros[$i]['DOCUMENTADO'] == 1){
				$auto = "";
			}
           ?>
          <div class="conteudo">
            <form class="" action="" method="post">
            <p>Numero da coleta: <?php echo $registros[$i]['NUMEROCOLETA']; ?> <button style="background-color: #FA5858;" type="submit" name="excluir" value="<?php echo $registros[$i]['IDREGISTRO']; ?>">Excluir</button>
              <button style="background-color: #2E9AFE;" type="submit" name="dados" value="<?php echo $registros[$i]['IDREGISTRO']; ?>">Dados</button>
			  <button type="submit" name="AUTO" value="<?php echo $registros[$i]['IDREGISTRO']; ?>" <?php echo $auto;
			  ?>>Autorização</dados>
              <button style="background-color: #64FE2E;" type="submit" name="consolidar" value="<?php echo $registros[$i]['IDREGISTRO'];?>" <?php echo $progresso['con']; ?> >Consolidar</button>
              <?php echo date('d/m/Y', strtotime($registros[$i]['DATALIMITE'])); ?>
            </p>

            </form>
            <div class="progress">
              <div class="<?php echo $progresso['class']; ?>" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progresso['valor']; ?>%"><?php echo $progresso['estagio']; ?></div>
            </div>
			<p style="font-size: 12px;">SOLICITAÇÃO <i style="color: <?php echo $progresso['soli']; ?>" class="fa fa-circle"></i> | ACEITE <i style="color: <?php echo $progresso['ace']; ?>" class="fa fa-circle"></i> |
            COLETADO <i style="color: <?php echo $progresso['col']; ?>" class="fa fa-circle"></i> | DOCUMENTADO <i <i style="color: <?php echo $progresso['doc']; ?>" class="fa fa-circle"></i> |
             EMITIDO <i style="color: <?php echo $progresso['emi']; ?>" class="fa fa-circle"></i> |
             EMBARCADO <i style="color: <?php echo $progresso['emb']; ?>" class="fa fa-circle"></i></p>
          </div>
          <?php } ?>
        </div>
        <?php
            if($q == 0){
                ?>
                <img src="img/listaVazia.svg" alt="" style="width: 50%; margin-top: 40px;">
                <h1>Sem coletas nesta data</h1>
                <?php
            }
        ?>
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
if (isset($_POST['AUTO'])){
  $_SESSION['id'] = $_POST['AUTO'];
  ?>
  <script type="text/javascript">
      window.location.href = "anexar.php";
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
  $aux -> excluir($id);
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php
}
if (isset($_POST['consolidar'])) {
  $id = $_POST['consolidar'];
  $aux -> consolidar($id);
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php
}

 ?>