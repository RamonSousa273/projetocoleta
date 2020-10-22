<?php session_start(); ?>
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
    <link rel="stylesheet" href="css/dados2.css">
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
        <?php
        include_once("./../conexao.php");
        include_once("./../funcoes.php");
        $id = $_SESSION['id2'];
        $sql = "SELECT * FROM tbdcoletas WHERE IDREGISTRO = '$id'";
        $sql = $conn->query($sql) or die($conn->error);
        $dado = $sql->fetch_array();
         ?>
         <div class="grid1">
           <div class="cont1">

           </div>
           <div class="cont2">
             <?php  ?>
             <div class="conteudo1">
               <p>Numero da nota:  <?php echo $dado['NUMEROCOLETA']; ?></p>
             </div>
             <div class="conteudo1">
               <p> <a href="<?php echo $dado['PDFCOLETA']; ?>" download="<?php echo $dado['PDFCOLETA']; ?>" >DOWNLOAD PDF</a> </p>
             </div>
             <?php
             $sql2 = "SELECT * FROM tbdnf WHERE IDCOLETA = '$id'";
             $sql2 = $conn->query($sql2) or die($conn->error);
             while ($dado2 = $sql2->fetch_array()) {
               $id2 = $dado2['IDREGISTRO'];
              ?>
             <div class="conteudo2">
               <p>Nota: <?php echo $dado2['NUMERONOTA']; ?></p>
               <div class="grid3">
               <?php
               $sql3 = "SELECT * FROM tbddadosnf WHERE IDNF = '$id2'";
               $sql3 = $conn->query($sql3) or die($conn->error);
               while ($dado3 = $sql3->fetch_array()) {
                ?>
                <div class="tab">
                  <table class="table table-dark table-bordered">
                    <tr>
                      <td>Volume: </td> <td><?php echo $dado3['QUANTIDADE']; ?></td>
                    </tr>
                    <tr>
                      <td>Peso Real: </td> <td><?php echo $dado3['PESOREAL']; ?></td>
                    </tr>
                    <tr>
                      <td>Largura: </td> <td><?php echo $dado3['LARGURA']; ?></td>
                    </tr>
                    <tr>
                      <td>Altura: </td> <td><?php echo $dado3['ALTURA']; ?></td>
                    </tr>
                    <tr>
                      <td>Comprimento: </td> <td><?php echo $dado3['COMPRIMENTO']; ?></td>
                    </tr>
                  </table>
                </div>
           <?php } ?>
           </div>
           </div>
             <?php } ?>
             </div>

           </div>
           <div class="cont1">

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
