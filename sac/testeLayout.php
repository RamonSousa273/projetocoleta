<?php session_start(); 
    include_once("./../class.php");
    include_once("./../funcoes.php");
  $aux = new Coleta();
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home - SAC/Torre de Controle</title>

    <link rel="stylesheet" href="css/teste.css">
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
      <div class="menu2">
        <img src="img/vialogo.png" alt="">
        <p>Ultima atualização: <?php echo date("H:i"); ?></p>
        <hr>
        <div class="botao">
        <button type="submit" value="0" name="ini">INICÍO</button>
        <button type="submit" value="0" name="nova">NOVA COLETA</button>
        <button type="submit" value="0" name="sair">SAIR</button>
    </div>
      </div>
      </form>
      <div class="coletaPrev">
        
        <div class="grid">
        <div class="titulo">
          <h3 style="text-align: center;">COLETAS</h3>
        </div>
          <?php

          $coletas = new Coleta;
          $registros = $coletas -> getColeta(0);
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
            <p>Numero da coleta: <?php echo $registros[$i]['NUMEROCOLETA']; ?> 
            <button style="background-color: #FA5858;" type="submit" name="excluir" value="<?php echo $registros[$i]['IDREGISTRO']; ?>">Excluir</button>
              <button style="background-color: #2E9AFE;" type="submit" name="dados" value="<?php echo $registros[$i]['IDREGISTRO']; ?>">Dados</button>
            <button type="submit" name="nm" value="<?php echo $registros[$i]['IDREGISTRO']; ?>">Anexar Notas/Memorandos</button>
        <button type="submit" name="AUTO" value="<?php echo $registros[$i]['IDREGISTRO']; ?>" <?php echo $auto;
			  ?>>Autorização</button>
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
if (isset($_POST['AUTO'])){
  $_SESSION['id'] = $_POST['AUTO'];
  ?>
  <script type="text/javascript">
      window.location.href = "anexar.php";
  </script>
  <?php
}

if(isset($_POST['nm'])){
  $_SESSION['id'] = $_POST['nm'];
  ?>
  <script type="text/javascript">
      window.location.href = "addNM.php";
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
if(isset($_POST['sair'])){
  include_once('./../ClassLogin.php');
  $ajd = new ControleLogin();
  $ajd -> LogOff();
}

 ?>
