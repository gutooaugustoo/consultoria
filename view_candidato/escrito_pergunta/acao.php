<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$Escrito_pergunta = new Escrito_pergunta($_REQUEST['escrito_pergunta_id']);

$arrayRetorno = array();
$gravado = false;

$candidato_escrito_id = $_REQUEST['candidato_escrito_id'];
$post = array("candidato_escrito_id" => $candidato_escrito_id, "escrito_pergunta_id" => $Escrito_pergunta -> get_idEscrito_pergunta(), );

switch ($_REQUEST['tipoPergunta']) {
  //ALTERNATIVA CORRETA
  case '1' :
    if ($resp = $_REQUEST['resp']) {
      $post["resp_alternativacorreta_id"] = $resp;
      $Resp = new Resposta_escrito_alternativacorreta();
      $rs = $Resp -> cadastrarResposta_escrito_alternativacorreta("", $post);
      if( $rs[0] != false ) {
        $gravado = true;
      }else{
        $arrayRetorno['mensagem'] = "Não foi possível gravar sua resposta.";
      }
    } else {
      $arrayRetorno['mensagem'] = "Se não quiser escolher nenhuma opção, clique em pular";
    }
    break;
  
  //VERDADEIRO OU FALSO
  case '2' :
    //VERIFICA SE PREENCHEU TUDO
    $Resp = new Resp_verdadeirofalso();    
    $rs = $Resp->selectResp_verdadeirofalso(" WHERE excluido = 0 AND pergunta_id = ".$Escrito_pergunta->get_pergunta_idEscrito_pergunta());    
    foreach ($rs as $valor) {
      $id = $valor['id'];            
      if( !$_REQUEST["resp_".$id] ) {
        $arrayRetorno['mensagem'] = "Responda todas as questões";        
        break 2; //SAIR DO FOR E DO SWITCH
      }
    }     
    //GRAVA
    $Resp = new Resposta_escrito_verdadeirofalso();
    $gravouTudo = true;   
    foreach ($rs as $valor) {
      $id = $valor['id'];   
      $post["resp_verdadeirofalso_id"] = $id;
      $post["verdadeiroFalso"] = ($_REQUEST["resp_".$id] == "V" ? "1" : "0");
      $rs = $Resp->cadastrarResposta_escrito_verdadeirofalso("", $post);
      if( $rs[0] == false ) $gravouTudo = false; 
    }
    
    if( $gravouTudo ) $gravado = true;
    
  break;

  case '3' :
    $Resp = new Resp_associeresposta();
    break;

  case '4' :
    $Resp = new Resp_preenchelacuna();
    break;

  case '5' :
    //
    break;
}

if ( $gravado ) {
  $arrayRetorno['mensagem'] = "Resposta gravada com sucesso.";
  $arrayRetorno['pagina'] = CAM_VIEW . "escrito_pergunta/form.php?escrito_id=" . $Escrito_pergunta -> get_escrito_idEscrito_pergunta() . "&candidato_escrito_id=" . $candidato_escrito_id;
  $arrayRetorno['ondeAtualizar'] = "#div_candidato_escrito";
}

echo json_encode($arrayRetorno);
