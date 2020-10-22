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
    <link rel="stylesheet" href="css/anexar.css">
  </head>
  <body>
    <div class="corpo">
    <form class="" action="" method="post">
      <div class="menu">
        <h3>MENU</h3>
        <hr>
        <button type="submit" value="0" name="ini">INICÍO</button>
        <button type="submit" value="0" name="nova">NOVA COLETA</button>
        <button type="submit" value="0" name="sair">SAIR</button>
      </div>
      </form>
      <div class="direito">
        <div class="grid">
          <div class="conteudo">

          </div>
          <div class="conteudo2">
            <form class="" enctype="multipart/form-data" action="" method="post">
              <h3>Anexar Memorando/Notas</h3>
              <p>Memorando:</p>
              <input type="file" class="form-control" accept=".pdf" name="CTE[]" value="" multiple>
              <br>
              <p>Notas:</p>
              <input type="file" class="form-control" accept=".pdf" name="AUTO[]" value="" multiple>
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
if (isset($_POST['ANEXAR'])) {
  include_once("./../conexao.php");
  include_once("./../class.php");
  $id = $_SESSION['id'];
  $data = date("Y-m-d");
  $hora = date("H:i");
  $precte = false;
  $preaut = false;
	foreach($_FILES['CTE']['name'] as $ind => $val){
    if(!empty($val)){
		$precte = true;
    }
	}
	if($precte){
		$file = $_FILES['CTE'];
		$aux -> anexarMemorando($file, $id);
	}

	foreach($_FILES['AUTO']['name'] as $ind => $val){
		if(!empty($val)){
			$preaut = true;
		}
	}
	if($preaut){
		$file = $_FILES['AUTO'];
		$aux -> anexarNotasRetirada($file, $id);
	}
	?>
		<script type="text/javascript">
			alert("Anexado com sucesso!");
			window.location.href = "index.php";
		</script>
  <?php
}
 ?>
