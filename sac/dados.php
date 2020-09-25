<?php session_start(); 
	include_once("./../class.php");
    include_once("./../funcoes.php");
	include_once("./../conexao.php");
	$aux = new Coleta();
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
    <link rel="stylesheet" href="css/dados.css">
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
      <div class="dadosCorpo">
        <?php

        $id = $_SESSION['id'];
        $dado = $aux->getDados($id);
        
        $cor = verificaEstagio($dado);
         ?>
        <div class="dados">
          <h4>Dados da coleta</h4>
          <p>SOLICITAÇÃO <i style="color: <?php echo $cor['soli']; ?>" class="fa fa-circle"></i> | ACEITE <i style="color: <?php echo $cor['ace']; ?>" class="fa fa-circle"></i> |
            COLETADO <i style="color: <?php echo $cor['col']; ?>" class="fa fa-circle"></i> | DOCUMENTADO <i <i style="color: <?php echo $cor['doc']; ?>" class="fa fa-circle"></i> |
             EMITIDO <i style="color: <?php echo $cor['emi']; ?>" class="fa fa-circle"></i> |
             EMBARCADO <i style="color: <?php echo $cor['emb']; ?>" class="fa fa-circle"></i></p>
          <div class="grid">
            <div class="conteudo">
              <p>Numero da coleta: <?php echo $dado['NUMEROCOLETA']; ?></p>
            </div>
            <div class="conteudo">
              <p>Cliente: <?php echo $dado['CLIENTE']; ?></p>
            </div>
            <div class="conteudo">
              <p>Hora Início: <?php echo $dado['HORAINI']; ?></p>
            </div>
            <div class="conteudo">
              <p>Hora Fim: <?php echo $dado['HORAFIM']; ?></p>
            </div>

            <div class="conteudo">
              <p>Data Solicitação: <?php echo $dado['DATASOLICITACAO']; ?></p>
            </div>
            <div class="conteudo">
              <p>Hora Solicitação: <?php echo $dado['HORASOLICITACAO']; ?></p>
            </div>
            <div class="conteudo">
              <p>Data Aceite: <?php echo $dado['DATAACEITE']; ?></p>
            </div>
            <div class="conteudo">
              <p>Hora Aceite: <?php echo $dado['HORAACEITE']; ?></p>
            </div>
            <div class="conteudo">
              <p>Data Coletado: <?php echo $dado['DATACOLETADO']; ?></p>
            </div>
            <div class="conteudo">
              <p>Hora Coletado: <?php echo $dado['HORACOLETADO']; ?></p>
            </div>
            <div class="conteudo">
              <p>Data Documentado: <?php echo $dado['DATADOCUMENTADO']; ?></p>
            </div>
            <div class="conteudo">
              <p>Hora Documentado: <?php echo $dado['HORADOCUMENTADO']; ?></p>
            </div>
            <div class="conteudo">
              <p>Data Emitido: <?php echo $dado['DATAEMITIDO']; ?></p>
            </div>
            <div class="conteudo">
              <p>Hora Emitido: <?php echo $dado['HORAEMITIDO']; ?></p>
            </div>
            <div class="conteudo">
              <p>Data Embarque: <?php echo $dado['DATAEMBARQUE']; ?></p>
            </div>
            <div class="conteudo">
              <p>Hora Embarque: <?php echo $dado['HORAEMBARQUE']; ?></p>
            </div>
          </div>
		  <br>
		  <table class="table table-dark table-bordered" style="float: left; width: 50%;">
			<tr>
				<td>CTE</td>
			</tr>
			<?php 
				$dado = $aux->getCte($id);
				$c = count($dado);
				for($i=0; $i<$c; $i++){
			?>
				<tr>
					<td><a href="<?php echo $dado[$i]['CTE']; ?>" download="<?php echo $dado[$i]['CTE']; ?>" >DOWNLOAD</a></td>
				</tr>
				<?php } ?>
		  </table>
		  <table class="table table-dark table-bordered" style="float: right; width: 50%;">
			<tr>
				<td>Autorização</td>
			</tr>
			<?php 
				$dado = $aux->getAutorizacao($id);
				$c = count($dado);
				for($i=0; $i<$c; $i++){
			?>
				<tr>
					<td><a href="<?php echo $dado[$i]['AUTORIZACAO']; ?>" download="<?php echo $dado[$i]['AUTORIZACAO']; ?>" >DOWNLOAD</a></td>
				</tr>
				<?php } ?>
		  </table>
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
  ?>
  <script type="text/javascript">
      window.location.href = "dados.php";
  </script>
  <?php
}

 ?>
