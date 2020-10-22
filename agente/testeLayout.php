<?php
session_start();
$_SESSION['id'] = "";
include_once("./../conexao.php");
include_once("./../class.php");
$aux = new Coleta;
/*if(isset($_SESSION['AGENTE'])){

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
    <title>Home - Agente</title>
    <script src="https://kit.fontawesome.com/212fcddd30.js" crossorigin="anonymous"></script>
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
      <div class="topo">

      </div>
      <div class="corpo">
        <?php 
            $dados = $aux->getColeta(0);
            $c = count($dados);
            for ($i=0; $i < $c; $i++) {
                $id = $dados[$i]['IDREGISTRO'];
            ?>
                <div class="coleta">
                    <div class="coletaTopo">
                        <div class="coletaTopoIcone">
                            <i class="fas fa-truck-moving fa-5x"></i>
                        </div>
                        <p>Cliente: <?php echo $dados[$i]['CLIENTE']; ?><br>
                        Numero da coleta: <?php echo $dados[$i]['NUMEROCOLETA']; ?></p>
                        
                    </div>
                    <hr>
                    <div class="coletaInformacao">
                        <?php 
                            $cte = $aux->getCte($id);
                            $d = count($cte);
                            for ($j=0; $j < $d ; $j++) { 
                        ?>
                        <p>CTE: <a href="<?php echo $cte[$j]['CTE'] ?>"><?php echo $cte[$j]['NOME'] ?></a></p>
                        <?php 
                            }    
                        ?>

                        <?php 
                            $autorizacao = $aux->getAutorizacao($id);
                            $d = count($autorizacao);
                            for ($j=0; $j < $d ; $j++) { 
                        ?>
                        <p>Autorização de embarque: <a href="<?php echo $autorizacao[$j]['AUTORIZACAO'] ?>"><?php echo $autorizacao[$j]['NOME'] ?></a></p>
                        <?php 
                            }    
                        ?>
                    </div>
                    <hr>
                    <div class="coletaBotoes">
                        <form action="" method="POST">
                            <button type="submit" style = "float: left;">Aceitar</button>
                            <button type="submit">Coletado</button>
                            <button type="submit" style = "float: left;">Adicionar Notas</button>
                            <button type="submit">Informar Embarque</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
      </div>
      <div class="rodape">
          <div class="btnRodape">
          <a href="">
            <p><i class="fas fa-home fa-3x"></i></p>
            <p> Inicio</p></a>
            </div>
      </div>
  </body>
</html>
