<?php
function verificaEstagio($dado){
  $volta = array('estagio' => "SOLICITADO", 'valor' => 17,
   'class' => "progress-bar progress-bar-striped progress-bar-animated", 'soli' => "green"
   , 'ace' => "white", 'col' => "white", 'doc' => "white", 'emi' => "white", 'emb' => "white"
   , 'con' => "disabled"
 );
  if ($dado['ACEITA'] != 0) {
    $volta['estagio'] = "ACEITO";
    $volta['valor'] = $volta['valor']+17;
    $volta['ace'] = "green";
  }
  if ($dado['COLETADO'] != 0) {
    $volta['estagio'] = "COLETADO";
    $volta['valor'] = $volta['valor']+17;
    $volta['col'] = "green";
  }
  if ($dado['DOCUMENTADO'] != 0) {
    $volta['estagio'] = "DOCUMENTADO";
    $volta['valor'] = $volta['valor']+17;
    $volta['doc'] = "green";
  }
  if ($dado['EMITIDO'] != 0) {
    $volta['estagio'] = "EMITIDO";
    $volta['valor'] = $volta['valor']+17;
    $volta['emi'] = "green";
  }
  if ($dado['EMBARQUE'] != 0) {
    $volta['estagio'] = "EMBARCADO";
    $volta['valor'] = $volta['valor']+15;
    $volta['class'] = "progress-bar progress-bar-striped bg-success";
    $volta['emb'] = "green";
    $volta['con'] = "";
  }
return($volta);

}

 ?>
