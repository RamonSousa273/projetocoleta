<?php session_start(); 
include_once("./../class.php");
include_once("./../funcoes.php");
$aux = new Coleta();
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
              <a href="<?php echo $dado[$i]['PDFCOLETA']; ?>" download="<?php echo $dado[$i]['PDFCOLETA']; ?>" >DOWNLOAD PDF</a>
              | Cliente: <?php echo $dado[$i]['CLIENTE']; ?> <i class="fa fa-check-circle" <?php echo $stl; ?>></i>
            </p>
            <p> <button type="submit" class="btn btn-primary" value="<?php echo $dado[$i]['IDREGISTRO']; ?>" name="dados">Dados da coleta</button> <button type="submit" class="btn btn-secondary" value="<?php echo $dado[$i]['IDREGISTRO']; ?>" name="anexar" <?php echo $anexa; ?>>Anexar CTE/AUTORIZAÇÃO</button> </p>
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
 ?>
