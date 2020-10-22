<?php session_start(); 
include_once("./../class.php");
include_once("./../funcoes.php");
$aux = new Coleta();
/*if(isset($_SESSION['OPERACAO'])){

}else{
  ?>
<script type="text/javascript">
    alert("Faça Login!");
    window.location.href = "./../index.php";
</script>
<?php
}*/
?>
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
        <h3>COLETAS</h3>
        <div class="grid">
          <?php
          
          $dado = $aux->getColeta(1);
		  $c = count($dado);
          for($i=0; $i<$c; $i++){
            $progresso = verificaEstagio($dado[$i]);
            $anexa = "disabled";
            if ($dado[$i]['VISTODADOS'] == 1) {
              $anexa = "";
            }
			if ($dado[$i]['EMITIDO'] == 1){
				$stl = "style=\"color: green;\"";
			}else{
				$stl = "style=\"color: green;  display: none;\"";
			}
           ?>
          <form class="" action="" method="post">
          <div class="conteudo">
            <p>Numero da coleta: <?php echo $dado[$i]['NUMEROCOLETA']; ?> |
              <a href="<?php echo $dado[$i]['PDFCOLETA']; ?>" download="<?php echo $dado[$i]['NOME']; ?>" >DOWNLOAD PDF</a>
              | Cliente: <?php echo $dado[$i]['CLIENTE']; ?> <i class="fa fa-check-circle" <?php echo $stl; ?>></i>
            </p>
            <p> <button type="submit" class="btn btn-primary" value="<?php echo $dado[$i]['IDREGISTRO']; ?>" name="dados">Dados da coleta</button> <button type="submit" class="btn btn-secondary" value="<?php echo $dado[$i]['IDREGISTRO']; ?>" name="anexar" <?php echo $anexa; ?>>Anexar CTE/AUTORIZAÇÃO</button> 
      </p>
      <div class="progress">
              <div class="<?php echo $progresso['class']; ?>" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progresso['valor']; ?>%"><?php echo $progresso['estagio']; ?></div>
            </div>
			<p style="font-size: 12px;">SOLICITAÇÃO <i style="color: <?php echo $progresso['soli']; ?>" class="fa fa-circle"></i> | ACEITE <i style="color: <?php echo $progresso['ace']; ?>" class="fa fa-circle"></i> |
            COLETADO <i style="color: <?php echo $progresso['col']; ?>" class="fa fa-circle"></i> | DOCUMENTADO <i <i style="color: <?php echo $progresso['doc']; ?>" class="fa fa-circle"></i> |
             EMITIDO <i style="color: <?php echo $progresso['emi']; ?>" class="fa fa-circle"></i> |
             EMBARCADO <i style="color: <?php echo $progresso['emb']; ?>" class="fa fa-circle"></i></p>
			<p>
			<table>
				<?php
				$idB = $dado[$i]['IDREGISTRO'];
				$cte = $aux -> getCte($idB);
				$r = count($cte);
				for($x=0; $x<$r; $x++){
				?>
				<tr>
					<td>CTE: <a href="<?php echo $cte[$x]['CTE'] ?>" download="<?php echo $cte[$x]['NOME'] ?>" ><?php echo $cte[$x]['NOME'] ?></a></td>
				</tr>
				<?php } ?>
			</table>
			<table>
				<?php
				$auto = $aux -> getAutorizacao($idB);
				$z = count($auto);
				for($y=0; $y<$z; $y++){
				?>
				<tr>
					<td>Autorização: <a href="<?php echo $auto[$y]['AUTORIZACAO'] ?>" download="<?php echo $auto[$y]['NOME'] ?>" ><?php echo $auto[$y]['NOME'] ?></a></td>
				</tr>
				<?php } ?>
			</table>
			</p>
          </div>
          </form>
        <?php } ?>
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
if (isset($_POST['dados'])) {
  $id = $_POST['dados'];
  $_SESSION['id'] = $id;
  ?>
  <script type="text/javascript">
      window.location.href = "dadosColeta.php";
  </script>
  <?php
}
if (isset($_POST['anexar'])) {
  $id = $_POST['anexar'];
  $_SESSION['id'] = $id;
  ?>
  <script type="text/javascript">
      window.location.href = "anexar.php";
  </script>
  <?php
}
if (isset($_POST['concluido'])){
	$id = $_POST['concluido'];
	$aux -> concluidoOperacao($id);
	?>
  <script type="text/javascript">
      alert("Concluido");
	  window.location.href = "index.php";
  </script>
  <?php
}
 ?>
