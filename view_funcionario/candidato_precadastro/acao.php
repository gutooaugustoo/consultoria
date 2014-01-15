<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Candidato_precadastro = new Candidato_precadastro();

$arrayRetorno = array();

if ($_REQUEST['acao'] == "deletar") {

  $emailCandidato_precadastro = $_REQUEST['id'];

  $rs = $Candidato_precadastro -> deletarCandidato_precadastro($emailCandidato_precadastro);

  if ($rs[0] != false) {

    $arrayRetorno['tabela'] = $_REQUEST['tabela'];
    $arrayRetorno['ordem'] = $_REQUEST['ordem'];
    $arrayRetorno['mensagem'] = $rs[1];
  }

} elseif ($_REQUEST['acao'] == "cadastrar") {

  $servico_id = $_REQUEST['servico_id'];

  $pasta = "candidato_csv";
  $upload = Uteis::uploadFile($_FILES, "csvFile", array(".csv"), $pasta);

  if ( !$upload[0] ) {
    $arrayRetorno['mensagem'] = $upload[1];
  } else {
    
    $Candidato_precadastro = new Candidato_precadastro();
    
    $cont = 0;
    $nomeArquivo = CAM_UP_ROOT . $pasta . "/" . $upload[1];
    $arquivo = fopen($nomeArquivo, "r");
      
    while (($linha = fgetcsv($arquivo, 1000, ";")) !== FALSE) {
      //Uteis::pr($linha);
      $email = $linha[1];
      $nome = $linha[0];
      if( Uteis::validarEmail($email) && $nome != "") {                  
        $rs = $Candidato_precadastro -> cadastrarCandidato_precadastro($email, array("servico_id" => $servico_id, "nome" => $nome));        
        if( $rs[0] != false ) $cont++;        
      }
    }

    $arrayRetorno['mensagem'] = "Pré-cadastro realizado com sucesso.<br />
    <small>$cont candidatos cadastrados</small>";
    $arrayRetorno['mudarAba'] = "#aba_servico-precadastro";
  
  }

}

echo json_encode($arrayRetorno);
