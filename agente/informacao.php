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
            <form class="" action="" method="post">
              <?php
              $id = $_SESSION['id'];
              if (isset($_SESSION['nota'])) {
                $not = $_SESSION['nota'];
              }else{
                $not = "";
              }
               ?>

            <p>Numero da nota: <input type="text" class="form-control" name="nume" value="<?php echo $not; ?>" required> </p>
            <?php $_SESSION['nota']=""; ?>
            <p> Volume: <input type="text" class="form-control" name="vol" value="" required> </p>
            <p> Peso real: <input type="text" class="form-control" name="pes" value="" required> </p>
            <p> Altura: <input type="text" class="form-control" name="alt" value="" required> </p>
            <p> Largura: <input type="text" class="form-control" name="lar" value="" required> </p>
            <p> Comprimento: <input type="text" class="form-control" name="com" value="" required> </p>
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
if (isset($_POST['reg'])) {
  include_once("./../conexao.php");
  include_once("./../funcoes.php");

  $id = $_SESSION['id'];
  $num = $_POST['nume'];
  $vol = $_POST['vol'];
  $pes = $_POST['pes'];
  $alt = $_POST['alt'];
  $lar = $_POST['lar'];
  $com = $_POST['com'];
  
  $aux->addInfo($id, $num, $vol, $pes, $alt, $lar, $com);

}
 ?>
