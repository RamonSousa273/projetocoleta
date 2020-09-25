<?php session_start(); 
include_once("./../class.php");
  include_once("./../funcoes.php");
  $aux = new Coleta();
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
    <link rel="stylesheet" href="css/informacao.css">
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
            <h3>Informar Embarque</h3>
            <?php
            $id = $_SESSION['id'];
             ?>
            <form class="" action="" method="post">
            <p> Numero do embarque: <input type="text" class="form-control" name="regval" value=""> </p>
			<p> Numero do CTE: <input type="text" class="form-control" name="cte" value=""> </p>
			<p> Transferidor: <input type="text" class="form-control" name="transferidor" value=""> </p>
            <p> <button type="submit" class="btn btn-primary" name="reg">Registrar</button> </p>
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
if (isset($_POST['info'])) {
  ?>
  <script type="text/javascript">
      window.location.href = "informacao.php";
  </script>
  <?php
}
if (isset($_POST['emb'])) {
  ?>
  <script type="text/javascript">
      window.location.href = "embarque.php";
  </script>
  <?php
}
if (isset($_POST['reg'])) {
  
  $id = $_SESSION['id'];
  $val = $_POST['regval'];
  $cte = $_POST['cte'];
  $transferidor = $_POST['transferidor'];
  
  $aux->addEmbarque($id, $val, $cte, $transferidor);
  
  
  ?>
  <script type="text/javascript">
	  alert("Registrado com sucesso!");
      window.location.href = "index.php";
  </script>
  <?php
}
 ?>
