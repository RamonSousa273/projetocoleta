<?php
include_once("preventivo.php");

 class Ban
 {
   function banco(){
   $servidor = "localhost";
   $usuario = "root";
   $senha = "";
   $dbname = "coletareversa";
   //Criar a conexao
   $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

   if(!$conn){
       die("Falha na conexao: " . mysqli_connect_error());
   }else{
       //echo "Conexao realizada com sucesso";
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
    $lac = $this->lacre;
    $dLim = $this->dataLim;
    $hLIm = $this->horaLim;
    $obs = $this->observacao;
    $horaSo = date("H:i");
    $dataSo = date("Y-m-d");

    $pdf = $this->pdfColeta;
    $nome = $pdf['name'];
    $dir = "./../uploads/";

    if (move_uploaded_file($pdf['tmp_name'],$dir.$nome)) {
      $dir = $dir.$nome;
    }else{
      $dir = "Falha";
    }

    $conn = $this->banco();

    $sql = "INSERT INTO tbdcoletas(NUMEROCOLETA, CLIENTE, HORAINI, HORAFIM,
    DATASOLICITACAO, HORASOLICITACAO, LACRE, OBSERVACAO, DATALIMITE,
    HORALIMITE, AGENTE, PDFCOLETA, VISIVEL, PDFNOME)
    VALUES('$nColeta', '$cli', '$hIni', '$hFim', '$dataSo', '$horaSo',
      '$lac', '$obs', '$dLim', '$hLIm', '$age', '$dir', '1', '$nome')
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

  function setCte($files, $id){
    $conn = $this->banco();
    $dir = "./../uploads";
    $j = count($files);
    $c = 0;
    for ($i=0; $i < $j ; $i++) {
      $name = $files['name'];
      if (move_uploaded_file($files[$j]['tmp_name'],$dir.$name)) {
        $local = $dir.$name;
        $sql = "INSERT INTO tbdcte(CTE, IDCOLETA, NOME) VALUES('$local', '$id', $name)";
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

  function getCte($id){

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
    $conn = $this->banco();
    $dir = "./../uploads";
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
		$conn = $this->banco();
		$sql = "UPDATE tbdcoletas SET VISIVEL = '0' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}

	function getDados($id){
		$conn = $this->banco();
		$sql = "SELECT * FROM tbdcoletas WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$dado = $sql->fetch_array();
		return $dado;
	}
	
	function aceitar($id){
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
	
	function addInfo($id, $num, $vol, $pes, $alt, $lar, $com){
		$conn = $this->banco();
		$_SESSION['nota'] = $num;

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

			$sql = "INSERT INTO tbddadosnf(IDNF, ALTURA, LARGURA, COMPRIMENTO, PESOREAL, QUANTIDADE)
			VALUES('$id2', '$alt', '$lar', '$com', '$pes', '$vol')";
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

			$sql = "INSERT INTO tbddadosnf(IDNF, ALTURA, LARGURA, COMPRIMENTO, PESOREAL, QUANTIDADE)
			VALUES('$id2', '$alt', '$lar','$com', '$pes', '$vol')";
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
	
	function addEmbarque($id, $val, $cte, $transferidor){
		$conn = $this->banco();
		$data = date("Y-m-d");
		$hora = date("H:i");
		$sql = "UPDATE tbdcoletas SET EMBARQUE = '1' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		
		$sql = "INSERT INTO tbdembarque(IDCOLETA, CTE, NUMEROEMBARQUE, TRANSFERIDOR) VALUES('$id', '$cte', '$val', 
		'$transferidor')";
		$sql = $conn->query($sql) or die($conn->error);
		
		$sql = "UPDATE tbdcoletas SET DATAEMBARQUE = '$data' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
		$sql = "UPDATE tbdcoletas SET HORAEMBARQUE = '$hora' WHERE IDREGISTRO = '$id'";
		$sql = $conn->query($sql) or die($conn->error);
	}
	
	
}
?>
