<?php
include_once("./../class.php");
$aux = new Coleta();

$numero = $_POST['coleta'];
$dados = $aux->buscaColeta($numero);
if (is_array($dados[0])) {
    $coleta = $dados[0];
$notas1 = $dados[1];
$notas2 = $dados[2];
$cte = $dados[3];
$autorizacao = $dados[4];
$embarque = $dados[5];
}else{
    ?>
    <script type="text/javascript">
        alert("Não encontrado!");
        window.location.href = "consultarColetas.php";
    </script>
<?php
}

    # code...

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/busca.css">
</head>
<body>
    <form class="" action="" method="post">
      <div class="menu">
        <h3>MENU</h3>
        <p>Ultima atualização: <?php echo date("H:i"); ?></p>
        <hr>
        <button type="submit" value="0" name="ini">INICÍO</button>
        <button type="submit" value="0" name="nova">NOVA COLETA</button>
      </div>
    </form>

    <div class="direita">
        <h3>Dados da coleta</h3>
    <table class="table table-bordered table-primary">
    <thead>
    <tr>
    <td>Numero da coleta</td>
    <td>Cliente</td>
    <td>Agente</td>
    <td>Lacre</td>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td><?php echo $coleta['NUMEROCOLETA'] ?></td>
    <td><?php echo $coleta['CLIENTE'] ?></td>
    <td><?php echo $coleta['AGENTE'] ?></td>
    <td><?php echo $coleta['LACRE'] ?></td>
    </tr>
    </tbody>
    </table>

    <br>

    <table class="table table-bordered table-primary">
    <thead>
    <td>Numero da nota</td>
    <td>Volume</td>
    <td>Peso real</td>
    <td>Altura</td>
    <td>Largura</td>
    <td>Comprimento</td>
    <td>Chave da nota</td>
    </thead>
    <tbody>
    <?php
    $c = count($notas1);
    $c2 = count($notas2);
    for ($i=0; $i < $c ; $i++) { 

       for ($a=0; $a < $c2 ; $a++) { 
           if ($notas1[$i]['IDREGISTRO']==$notas2[$a]['IDNF']) {
            ?>
            <tr>
            <td><?php echo $notas1[$i]['NUMERONOTA'] ?></td>
            <td><?php echo $notas2[$a]['QUANTIDADE'] ?></td>
            <td><?php echo $notas2[$a]['PESOREAL'] ?></td>
            <td><?php echo $notas2[$a]['ALTURA'] ?></td>
            <td><?php echo $notas2[$a]['LARGURA'] ?></td>
            <td><?php echo $notas2[$a]['COMPRIMENTO'] ?></td>
            <td><?php echo $notas2[$a]['CHAVEDANOTA'] ?></td>
            </tr>
            <?php
           }
       }
    }
    ?>
    </tbody>
    </table>

    <br>

    <div class="esquerda">
    <table class="table table-bordered table-primary">
    <thead>
    <tr>
    <td>CTE</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $j = count($cte);
    for ($k=0; $k < $j ; $k++) { 
        ?>
        <tr>
        <td><a href="<?php echo $cte[$k]['CTE']; ?>" download="<?php echo $cte[$k]['NOME']; ?>">
        <?php echo $cte[$k]['NOME']; ?></a></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    </table>
    </div>
    
    <div class="direita2">
    <table class="table table-bordered table-primary">
    <thead>
    <tr>
    <td>AUTORIZAÇÃO</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $j = count($autorizacao);
    for ($k=0; $k < $j ; $k++) { 
        ?>
        <tr>
        <td><a href="<?php echo $autorizacao[$k]['AUTORIZACAO']; ?>" download="<?php echo $autorizacao[$k]['NOME']; ?>">
        <?php echo $autorizacao[$k]['NOME']; ?></a></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    </table>
    </div>
    <br><br><br>

    <table class="table table-bordered table-primary">
    <thead>
    <tr>
    <td>EMBARQUE</td>
    <td>TRANSFERIDOR</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $j = count($embarque);
    for ($k=0; $k < $j ; $k++) { 
        ?>
        <tr>
        <td><?php echo $embarque[$k]['NUMEROEMBARQUE']; ?></td>
        <td><?php echo $embarque[$k]['TRANSFERIDOR']; ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
    </table>
    </div>
</body>
</html>