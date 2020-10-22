<?php
include_once("preventivo.php");

 class Ban
 {
   function banco(){
   $servidor = "localhost";
   //$usuario = "viaexp72_viaport";
   //$senha = "j+pW(Ye^&S4u";
   //$dbname = "viaexp72_coletareversa";
   $usuario = "root";
   $senha = "";
   $dbname = "coletareversa";
   //Criar a conexao
   $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

   if(!$conn){
       die("Falha na conexao: " . mysqli_connect_error());
   }
   return $conn;
 }
 }


class Coleta extends Ban
{

  public $numeroColeta; public $cliente; public $agente; public $horaIni;
  public $horaFim; public $lacre; public $pdfColeta; public $dataLim;
  public $horaLim; public $observacao;

  function setColeta()
  {
    $nColeta = $this->numeroColeta;
    $cli = $this->cliente;
    $age = $this->agente;
    $hIni = $this->horaIni;
    $hFim = $this->horaFim;
    $dLim = $this->dataLim;
    $hLIm = $this->horaLim;
	$obs = $this->observacao;
	
    $horaSo = date("H:i");
	$dataSo = date("Y-m-d");
	
	$nColeta = removeCaracteresSQL($nColeta);
	$cli = removeCaracteresSQL($cli);
	$age = removeCaracteresSQL($age);
	$hIni = removeCaracteresSQL($hIni);
	$hFim = removeCaracteresSQL($hFim);
	$dLim = removeCaracteresSQL($dLim);
	$hLIm = removeCaracteresSQL($hLIm);
	$obs = removeCaracteresSQL($obs);

    $pdf = $this->pdfColeta;
    $nome = $pdf['name'];
    $dir = "./../uploads/solicitacao/";

    if (move_uploaded_file($pdf['tmp_name'],$dir.$nome)) {
      $dir = $dir.$nome;
    }else{
      $dir = "Falha";
    }

    $conn = $this->banco();

    $sql = "INSERT INTO tbdcoletas(NUMEROCOLETA, CLIENTE, HORAINI, HORAFIM,
    DATASOLICITACAO, HORASOLICITACAO, OBSERVACAO, DATALIMITE,
    HORALIMITE, AGENTE, PDFCOLETA, VISIVEL, PDFNOME)
    VALUES('$nColeta', '$cli', '$hIni', '$hFim', '$dataSo', '$horaSo',
    		'$obs', '$dLim', '$hLIm', '$age', '$dir', '1', '$nome')
	";
	$sql = $conn->query($sql) or die($conn->error);

  }

  function getColeta($a){

    $conn = $this->banco();

    $coleta = array();
    $i = 0;

    if ($a == 0) {
    $sql = "SELECT * FROM tbdcoletas WHERE CONCLUIDO != '1' AND VISIVEL = '1'";
    $sql = $conn -> query($sql) or die($conn->error);
    while ($dado = $sql->fetch_array()) {
      array_push($coleta, $dado);
      $i++;
    }
  }else{
    $sql = "SELECT * FROM tbdcoletas WHERE CONCLUIDO != '1' AND DOCUMENTADO = '1' AND VISIVEL = '1'";
    $sql = $conn -> query($sql) or die($conn->error);
    while ($dado = $sql->fetch_array()) {
      array_push($coleta, $dado);
      $i++;
  }
  }

  return $coleta;

}

	function setLacre($id, $lacre){
		$conn = $this->banco();

	}

	function buscaColeta($numeroColeta){

		$numeroColeta = removeCaracteresSQL($numeroColeta);

		$conn = $this->banco();

		$cubo = array();
		
		$sql = "SELECT * FROM tbdcoletas WHERE NUMEROCOLETA = '$numeroColeta'";
		$sql = $conn -> query($sql) or die($conn->erro);

		$dado = $sql->fetch_array();
		array_push($cubo, $dado);

		$id = $dado['IDREGISTRO'];

		if ($dado['DOCUMENTADO'] == "1") {
			
			$notas = array();
			$notas2 = array();

			$sql2 = "SELECT * FROM tbdnf WHERE IDCOLETA = '$id'";
			$sql2 = $conn -> query($sql2) or die($conn->erro);
			while ($dado2 =  $sql2->fetch_array()) {
				$id2 = $dado2['IDREGISTRO'];
				array_push($notas, $dado2);
				$sql3 = "SELECT * FROM tbddadosnf WHERE IDNF = '$id2'";
				$sql3 = $conn -> query($sql3) or die($conn->erro);
				while ($dado3 = $sql3->fetch_array()) {
					array_push($notas2, $dado3);
				}
			}
			array_push($cubo, $notas);
			array_push($cubo, $notas2);
		}
		if ($dado['EMITIDO'] == "1") {

			$cte = array();
			$autorizacao = array();

			$sql2 = "SELECT * FROM tbdcte WHERE IDCOLETA = '$id'";
			$sql2 = $conn -> query($sql2) or die($conn->erro);
			while ($dado2 = $sql2->fetch_array()) {
				array_push($cte, $dado2);
			}

			$sql2 = "SELECT * FROM tbdautorizacao WHERE IDCOLETA = '$id'";
			$sql2 = $conn -> query($sql2) or die($conn->erro);
			while ($dado2 = $sql2->fetch_array()) {
				array_push($autorizacao, $dado2);
			}

			array_push($cubo, $cte);
			array_push($cubo, $autorizacao);

		}
		if ($dado['EMBARQUE'] == "1") {
			
			$embarque = array();

			$sql2 = "SELECT * FROM tbdembarque WHERE IDCOLETA = '$id'";
			$sql2 = $conn -> query($sql2) or die($conn->erro);
			while ($dado2 = $sql2->fetch_array()) {
				array_push($embarque, $dado2);
			}

			array_push($cubo, $embarque);

		}

		return $cubo;

	}

  function getCte($id){

	$id = removeCaracteresSQL($id);

    $cte = array();
    $conn = $this->banco();
    $sql = "SELECT * FROM tbdcte WHERE IDCOLETA = '$id'";
    $sql = $conn -> query($sql) or die($conn->error);
    while ($dado = $sql->fetch_array()) {
      array_push($cte,$dado);
    }
    return $cte;
  }

  function setAutorizacao($files, $id){

	$id = removeCaracteresSQL($id);

    $conn = $this->banco();
    $dir = "./../uploads/autorizacao/";
    $j = count($files);
    $c = 0;
    for ($i=0; $i < $j ; $i++) {
      $name = $files['name'];
      if (move_uploaded_file($files[$j]['tmp_name'],$dir.$name)) {
        $local = $dir.$name;
        $sql = "INSERT INTO tbdautorizacao(AUTORIZACAO, IDCOLETA, NOME) VALUES('$local', '$id', $name)";
        $sql = $conn -> query($sql) or die($conn->error);
        $sql = "UPDATE tbdcoletas SET EMITIDO = '1' WHERE IDREGISTRO = '$id'";
				$sql = $conn->query($sql) or die($conn->error);
        $c++;
      }
    }
    if ($c == $j) {
      return true;
    }else{
      return false;
    }
  }

  function getAutorizacao($id){

	$id = removeCaracteresSQL($id);

    $autorizacao = array();
    $conn = $this->banco();
    $sql = "SELECT * FROM tbdautorizacao WHERE IDCOLETA = '$id'";
    $sql = $conn -> query($sql) or die($conn->error);
    while ($dado = $sql->fetch_array()) {
      array_push($autorizacao,$dado);
    }
    return $autorizacao;
  }

	function consolidar($id){

		$id = removeCaracteresSQL($id);

		$data = date("d/m/Y");
		$hora = date("H:i");
		$conn = $this->banco();
		$sql = "UPDATE tbdcoletas SET CONCLUIDO = '1' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$sql = "UPDATE tbdcoletas SET DATAEMBARQUE = '$data' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$sql = "UPDATE tbdcoletas SET HORAEMBARQUE = '$hora' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}

	function excluir($id){

		$id = removeCaracteresSQL($id);

		$conn = $this->banco();
		$sql = "UPDATE tbdcoletas SET VISIVEL = '0' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}

	function getDados($id){

		$id = removeCaracteresSQL($id);

		$conn = $this->banco();
		$sql = "SELECT * FROM tbdcoletas WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$dado = $sql->fetch_array();
		return $dado;
	}

	function aceitar($id){

		$id = removeCaracteresSQL($id);


		$conn = $this->banco();
		$data = date("Y-m-d");
		$hora = date("H:i");
		$sql = "UPDATE tbdcoletas SET ACEITA = '1' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$sql = "UPDATE tbdcoletas SET DATAACEITE = '$data' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$sql = "UPDATE tbdcoletas SET HORAACEITE = '$hora' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}

	function coletado($id){

		$id = removeCaracteresSQL($id);

		$conn = $this->banco();
		$data = date("Y-m-d");
		$hora = date("H:i");
		$sql = "UPDATE tbdcoletas SET COLETADO = '1' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$sql = "UPDATE tbdcoletas SET DATACOLETADO = '$data' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$sql = "UPDATE tbdcoletas SET HORACOLETADO = '$hora' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}

	function addInfo($id, $num, $vol, $pes, $alt, $lar, $com, $chave, $adc, $nota, $lacre){

		$id = removeCaracteresSQL($id);
		$num = removeCaracteresSQL($num);
		$vol = removeCaracteresSQL($vol);
		$pes = removeCaracteresSQL($pes);
		$alt = removeCaracteresSQL($alt);
		$lar = removeCaracteresSQL($lar);
		$com = removeCaracteresSQL($com);
		$chave = removeCaracteresSQL($chave);
		$adc = removeCaracteresSQL($adc);
		$lacre = removeCaracteresSQL($lacre);

		$conn = $this->banco();
		$_SESSION['nota'] = $num;

   $local = "";

		$data = date("Y-m-d");
		$hora = date("H:i");

		$sql = "UPDATE tbdcoletas SET DATADOCUMENTADO = '$data' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$sql = "UPDATE tbdcoletas SET HORADOCUMENTADO = '$hora' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);

		$sql = "SELECT * FROM tbdnf WHERE IDCOLETA = '$id' AND NUMERONOTA = '$num'";
		$sql = $conn->query($sql) or die($conn->error);
		$dado = $sql->fetch_array();
		if(is_array($dado)){
			$id2 = $dado['IDREGISTRO'];

      $dir = "./../uploads/pdfNotas/";
			$new_name = $nota['name'];
			if(move_uploaded_file($nota['tmp_name'], $dir.$new_name)){
				$local = $dir.$new_name;
			}

			$sql = "INSERT INTO tbddadosnf(IDNF, ALTURA, LARGURA, COMPRIMENTO, PESOREAL, QUANTIDADE, CHAVEDANOTA, DADOSADICIONAIS, LOCALPDF, NUMEROLACRE)
			VALUES('$id2', '$alt', '$lar', '$com', '$pes', '$vol', '$chave', '$adc', '$local', '$lacre')";
			$sql = $conn->query($sql) or die($conn->error);

    $sql = "UPDATE tbdcoletas SET DOCUMENTADO = '1' WHERE IDREGISTRO = '$id'";
    $sql = $conn->query($sql) or die($conn->error);

			$sql = "UPDATE tbdcoletas SET DATADOCUMENTADO = '$data' WHERE IDREGISTRO = '$id'";
			$sql = $conn->query($sql) or die($conn->error);
			$sql = "UPDATE tbdcoletas SET HORADOCUMENTADO = '$hora' WHERE IDREGISTRO = '$id'";
			$sql = $conn->query($sql) or die($conn->error);
			
			?>
			<script type="text/javascript">
				window.location.href = "confirmaNota.php";
			</script>
			<?php

		}else{
			$sql = "INSERT INTO tbdnf(IDCOLETA, NUMERONOTA) VALUES('$id', '$num')";
			$sql = $conn->query($sql) or die($conn->error);

			$sql = "SELECT * FROM tbdnf WHERE IDCOLETA = '$id' AND NUMERONOTA = '$num'";
			$sql = $conn->query($sql) or die($conn->error);
			$dado = $sql->fetch_array();
			$id2 = $dado['IDREGISTRO'];

      $dir = "./../uploads/pdfNotas/";
			$new_name = $nota['name'];
			if(move_uploaded_file($nota['tmp_name'], $dir.$new_name)){
				$local = $dir.$new_name;
			}

			$sql = "INSERT INTO tbddadosnf(IDNF, ALTURA, LARGURA, COMPRIMENTO, PESOREAL, QUANTIDADE, CHAVEDANOTA, DADOSADICIONAIS, LOCALPDF, NUMEROLACRE)
			VALUES('$id2', '$alt', '$lar','$com', '$pes', '$vol', '$chave', '$adc', '$local', '$lacre')";
			$sql = $conn->query($sql) or die($conn->error);

			$sql = "UPDATE tbdcoletas SET DOCUMENTADO = '1' WHERE IDREGISTRO = '$id'";
			$sql = $conn->query($sql) or die($conn->error);

			$sql = "UPDATE tbdcoletas SET DATADOCUMENTADO = '$data' WHERE IDREGISTRO = '$id'";
			$sql = $conn->query($sql) or die($conn->error);
			$sql = "UPDATE tbdcoletas SET HORADOCUMENTADO = '$hora' WHERE IDREGISTRO = '$id'";
			$sql = $conn->query($sql) or die($conn->error);
			
			?>
			<script type="text/javascript">
				window.location.href = "confirmaNota.php";
			</script>
			<?php
  }
	}

	function addEmbarque($id, $val, $transferidor){

		$id = removeCaracteresSQL($id);
		$val = removeCaracteresSQL($val);
		$transferidor = removeCaracteresSQL($transferidor);

		$conn = $this->banco();
		$data = date("Y-m-d");
		$hora = date("H:i");
		$sql = "UPDATE tbdcoletas SET EMBARQUE = '1' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);

		$sql = "INSERT INTO tbdembarque(IDCOLETA, NUMEROEMBARQUE, TRANSFERIDOR) VALUES('$id', '$val',
		'$transferidor')";
		$sql = $conn->query($sql) or die($conn->error);

		$sql = "UPDATE tbdcoletas SET DATAEMBARQUE = '$data' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$sql = "UPDATE tbdcoletas SET HORAEMBARQUE = '$hora' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}

	function anexarCTE($file, $id){

		$id = removeCaracteresSQL($id);

		$conn = $this->banco();
		$qtd = count($file);
		for($i = 0; $i < $qtd; $i++){
			$dir = "./../uploads/cte/";
			$new_name = $file['name'][$i];
			if(move_uploaded_file($file['tmp_name'][$i], $dir.$new_name)){
				$local = $dir.$new_name;
				$sql = "INSERT INTO tbdcte(CTE,IDCOLETA,NOME) VALUES('$local', '$id', '$new_name')";
				$sql = $conn->query($sql) or die($conn->error);
			}
		}

		$sql = "SELECT * FROM tbdautorizacao WHERE IDCOLETA = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$dado = $sql->fetch_array();
		if(is_array($dado)){
				$data = date("Y-m-d");
				$hora = date("H:i");
				$sql = "UPDATE tbdcoletas SET EMITIDO = '1' WHERE IDREGISTRO = '$id'";
				$sql = $conn->query($sql) or die($conn->error);
				$sql = "UPDATE tbdcoletas SET DATAEMITIDO = '$data' WHERE IDREGISTRO = '$id'";
				$sql = $conn->query($sql) or die($conn->error);
				$sql = "UPDATE tbdcoletas SET HORAEMITIDO = '$hora' WHERE IDREGISTRO = '$id'";
				$sql = $conn->query($sql) or die($conn->error);
		}
	}

	function anexarAutorizacao($file, $id){

		$id = removeCaracteresSQL($id);

		$conn = $this->banco();
		$qtd = count($file);
		for($i = 0; $i < $qtd; $i++){
			$dir = "./../uploads/autorizacao/";
			$new_name = $file['name'][$i];
			if(move_uploaded_file($file['tmp_name'][$i], $dir.$new_name)){
				$local = $dir.$new_name;
				$sql = "INSERT INTO tbdautorizacao(AUTORIZACAO,IDCOLETA, NOME) VALUES('$local', '$id', '$new_name')";
				$sql = $conn->query($sql) or die($conn->error);
			}
		}

		$sql = "SELECT * FROM tbdcte WHERE IDCOLETA = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$dado = $sql->fetch_array();
		if(is_array($dado)){
				$data = date("Y-m-d");
				$hora = date("H:i");
				$sql = "UPDATE tbdcoletas SET EMITIDO = '1' WHERE IDREGISTRO = '$id'";
				$sql = $conn->query($sql) or die($conn->error);
				$sql = "UPDATE tbdcoletas SET DATAEMITIDO = '$data' WHERE IDREGISTRO = '$id'";
				$sql = $conn->query($sql) or die($conn->error);
				$sql = "UPDATE tbdcoletas SET HORAEMITIDO = '$hora' WHERE IDREGISTRO = '$id'";
				$sql = $conn->query($sql) or die($conn->error);
		}

	}

	function anexarNotasRetirada($file, $id){

		$id = removeCaracteresSQL($id);

		$conn = $this->banco();
		$qtd = count($file);
		for($i = 0; $i < $qtd; $i++){
			$dir = "./../uploads/notasRetirada/";
			$new_name = $file['name'][$i];
			if(move_uploaded_file($file['tmp_name'][$i], $dir.$new_name)){
				$local = $dir.$new_name;
				$sql = "INSERT INTO tbdnotasretirada(LOCALNOTARETIRADA,IDCOLETA, NOME) VALUES('$local', '$id', '$new_name')";
				$sql = $conn->query($sql) or die($conn->error);
			}
		}
		$sql = "UPDATE tbdcoletas SET NOTASRETIRADA = '1' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}

	function anexarMemorando($file, $id){

		$id = removeCaracteresSQL($id);

		$conn = $this->banco();
		$qtd = count($file);
		for($i = 0; $i < $qtd; $i++){
			$dir = "./../uploads/memorandos/";
			$new_name = $file['name'][$i];
			if(move_uploaded_file($file['tmp_name'][$i], $dir.$new_name)){
				$local = $dir.$new_name;
				$sql = "INSERT INTO tbdmemorando(LOCALMEMORANDO,IDCOLETA, NOME) VALUES('$local', '$id', '$new_name')";
				$sql = $conn->query($sql) or die($conn->error);
			}
		}
		$sql = "UPDATE tbdcoletas SET MEMORANDO = '1' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}

	function concluidoOperacao($id){

		$id = removeCaracteresSQL($id);
		
		$conn = $this->banco();
		$sql = "UPDATE tbdcoletas SET CTE = '1' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}

	function buscarColetaData($data, $data2){
		$conn = $this->banco();
		$lista = array();
		$sql = "SELECT * FROM tbdcoletas WHERE DATALIMITE >= '$data' AND DATALIMITE <= '$data2'";
		$sql = $conn->query($sql) or die($conn->error);
		while($dado = $sql->fetch_array()){
			array_push($lista, $dado);
		}

		return $lista;

	}

}
?>
