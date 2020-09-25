<?php
session_start();
$_SESSION['id'] = "";
include_once("./../conexao.php");
include_once("./../class.php");
$aux = new Coleta;
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
          $registros = $aux->getColeta(0);
          $q = count($registros);
          for ($i=0; $i < $q ; $i++) {
            $id = $registros[$i]['IDREGISTRO'];
            $coletado = "disabled";
            $info = "disabled";
            $emb = "disabled";
            $aceitar = "";
			      $obs = "disabled";
            if ($registros[$i]['ACEITA'] == 1) {

              $coletado = "";
              $aceitar = "disabled";
            }
            if ($registros[$i]['COLETADO'] == 1) {
              $info = "";
              $coletado = "disabled";
            }
            if ($registros[$i]['EMITIDO'] == 1) {
              $info = "disabled";
              $emb = "";
            }
            if ($registros[$i]['EMBARQUE'] == 1) {
              $emb = "";
            }
			if($registros[$i]['OBSERVACAO'] != ""){
				$obs = "";
			}

           ?>
           <div class="conteudo" style="padding: 10px;">
             <p>Numero da colta: <?php echo $registros[$i]['NUMEROCOLETA']; ?>
			 <button id="btn" <?php echo $obs; ?>>Observação</button></p>
             <p>PDF Coleta: <a href="<?php echo $dado['PDFCOLETA']; ?>" download="<?php echo $registros[$i]['PDFCOLETA']; ?>" >DOWNLOAD</a></p>
			 <p style="display: none;" id="text"><?php echo($registros[$i]['OBSERVACAO']); ?></p>
             <?php
             if ($registros[$i]['EMITIDO'] != 0) {

               $ctes = $aux -> getCte($registros[$i]['IDREGISTRO']);
               $j = count($ctes);
               for ($c=0; $c < $j ; $c++) {
              ?>
              <p> <a href="<?php echo $ctes[$c]['CTE']; ?>" download="<?php echo $ctes[$c]['CTE']; ?>" >DOWNLOAD CTE</a> </p>
            <?php } ?>
            <?php
            $auto = $aux -> getAutorizacao($registros[$i]['IDREGISTRO']);
            $j = count($auto);
            for ($c=0; $c < $j ; $c++) {
           ?>
           <p> <a href="<?php echo $auto[$c]['AUTORIZACAO']; ?>" download="<?php echo $auto[$c]['AUTORIZACAO']; ?>">DOWNLOAD AUTORIZACAO</a> </p>
         <?php } ?>
          <?php } ?>
             <form class="" action="" method="post">
               <p class="meio"> <button type="submit" value="<?php echo $registros[$i]['IDREGISTRO']; ?>" name="aceitar" <?php echo $aceitar; ?>>Aceitar</button>
                 <button type="submit" value="<?php echo $registros[$i]['IDREGISTRO']; ?>" name="coletado" <?php echo $coletado; ?>>Coletado</button>
                 <button type="submit" value="<?php echo $registros[$i]['IDREGISTRO']; ?>" name="info" <?php echo $info; ?>>Adicionar Informação</button>
               </p>
               <p class="meio"> <button type="submit" value="<?php echo $registros[$i]['IDREGISTRO']; ?>" name="emb" <?php echo $emb; ?>>Informar embarque</button> </p>
             </form>
           </div>
          <?php } ?>
          </div>
         </div>
        </div>
	   </div>
      </div>
	  <script type="text/javascript">
      "use strict";
    var switchText = document.getElementById("btn");
    var elToggled = document.getElementById("text");
    elToggled.style.display = "none";
    switchText.addEventListener("click", function(){
        if(elToggled.style.display == "block") {
            elToggled.style.display = "none";
        } else {
            elToggled.style.display = "block";
        }
    }, false);
  </script>
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
  $id = $_POST['aceitar'];
  $aux->aceitar($id);
  
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php
}
if (isset($_POST['coletado'])) {
  $id = $_POST['coletado'];
  $aux->coletado($id);
  ?>
  <script type="text/javascript">
      window.location.href = "index.php";
  </script>
  <?php

}
 ?>
