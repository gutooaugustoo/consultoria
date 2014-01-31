<?php
class Resp_associeresposta extends Resp_associeresposta_m {

  //CONSTRUTOR
  function __construct($idResp_associeresposta = "") {
    parent::__construct($idResp_associeresposta);
  }

  function __destruct() {
    parent::__destruct();
  }

  //GERAR ELEMENTOS
  function selectResp_associeresposta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
    $where .= " AND R.excluido = 0";
    $campos = array("id", "descResposta AS legenda");
    $array = $this -> selectResp_associeresposta($where, $campos);
    return Html::select($nomeId, $idAtual, $array);
  }

  function selectMultipleResp_associeresposta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
    $where .= " AND R.excluido = 0";
    $campos = array("id", "descResposta AS legenda");
    $array = $this -> selectResp_associeresposta($where, $campos);
    return Html::selectMultiple($nomeId, $idAtual, $array);
  }

  /*function checkBoxResp_associeresposta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
   $where .= " AND R.excluido = 0";
   $campos = array("id", "descResposta AS legenda");
   $array = $this -> selectResp_associeresposta($where, $campos);
   return Html::selectMultiple($nomeId, $idAtual, $array);
   }*/

  function tabelaResp_associeresposta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false) {

    $array = $this -> selectResp_associeresposta($where, array("R.id"));

    if ($array) {

      $cont = 0;
      $linha = array();

      foreach ($array as $iten) {

        $colunas = array();

        //CARREGAR VALORES
        $this -> __construct($iten['id']);

        $colunas[] = $this -> get_descPerguntaResp_associeresposta();
        $colunas[] = $this -> get_descRespostaResp_associeresposta();

        $ordem = ($apenasLinha !== false) ? $apenasLinha : $cont++;
        $urlAux = "&ordem=" . $ordem . "&tabela=" . Html::get_idTabela();
        $atualizarFinal = $atualizar . $urlAux . "&tr=1&idResp_associeresposta=" . $this -> get_idResp_associeresposta();

        $editar = "<img src=\"" . CAM_IMG . "editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '" . $caminho . "abas.php?idResp_associeresposta=" . $this -> get_idResp_associeresposta() . "', '$atualizarFinal', '$ondeAtualizar')\" >";

        $deletar = "<img src=\"" . CAM_IMG . "excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('" . $caminho . "acao.php?" . $urlAux . "', '" . $this -> get_idResp_associeresposta() . "', '$atualizarFinal', '$ondeAtualizar')\">";

        if ($apenasLinha !== false) {
          $colunas[] = implode(ICON_SEPARATOR, array($editar, $deletar));
          break;
        } else {
          $colunas[] = array($editar, $deletar);
          $linhas[] = $colunas;
        }

      }

    }

    return ($apenasLinha !== false) ? $colunas : Html::montarColunas($linhas);

  }

  //AÇÕES
  function cadastrarResp_associeresposta($idResp_associeresposta, $post = array()) {

    //CARREGAR DO POST
    $pergunta_id = ($post['pergunta_id']);
    if ($pergunta_id == '')
      return array(false, MSG_OBRIGAT . " Pergunta");

    $ordem = ($post['ordem']);

    $descPergunta = ($post['descPergunta']);
    if ($descPergunta == '')
      return array(false, MSG_OBRIGAT . " Desc Pergunta");

    $descResposta = ($post['descResposta']);
    if ($descResposta == '')
      return array(false, MSG_OBRIGAT . " Desc Resposta");

    //SETAR
    $this -> set_pergunta_idResp_associeresposta($pergunta_id) -> set_ordemResp_associeresposta($ordem) -> set_descPerguntaResp_associeresposta($descPergunta) -> set_descRespostaResp_associeresposta($descResposta);

    if ($idResp_associeresposta) {
      $this -> set_idResp_associeresposta($idResp_associeresposta);
      return ($this -> updateResp_associeresposta());
    } else {
      return ($this -> insertResp_associeresposta());
    }

  }

  function deletarResp_associeresposta($idResp_associeresposta) {
    $this -> set_idResp_associeresposta($idResp_associeresposta);
    return ($this -> deleteResp_associeresposta());
  }

  function montarRespostas_html($idPergunta) {
    
    $this -> set_pergunta_idResp_associeresposta($idPergunta);
    $where = " WHERE excluido = 0 AND pergunta_id = " . $this -> get_pergunta_idResp_associeresposta() . " ORDER BY RAND()";
    
    $rs = $this -> selectResp_associeresposta($where);    
    foreach ($rs as $key => $valor) {
      $tr[$key]["td1"] = 
        "<div class=\"destaca_azul sortable\" >
          <input type=\"checkbox\" id=\"perg".$valor['id']."\" />
          <span>" . $valor['descPergunta'] . "
            <input type=\"hidden\" id=\"perg_".$valor['id']."\" name=\"perg_".$valor['id']."\" value=\"".$valor['id']."\" />
          </span>
        </div>";
    }
    
    $rs = $this -> selectResp_associeresposta($where);    
    foreach ($rs as $key => $valor) {
      $tr[$key]["td2"] = 
        "<div class=\"destaca_bege sortable2\" >
          <input type=\"checkbox\" id=\"resp".$valor['id']."\" />
          <span>" . $valor['descResposta'] . "
            <input type=\"hidden\" id=\"resp_".$valor['id']."\" name=\"resp_".$valor['id']."\" value=\"".$valor['id']."\" />
          </span>
        </div>"; 
    }
    
    if( $tr ){
      $html .= "<div class=\"linha-inteira\" >
      <p><label>Obs.: Para associar, clique em um item da coluna azul (esquerda), e depois em um da coluna amarela (direita)</label></p>";      
      foreach ($tr as $key => $valor) {        
        $html .= "          
          <div class=\"esquerda\">".$tr[$key]["td1"]."</div>
          <div class=\"direita\">".$tr[$key]["td2"]."</div>               
        ";
      }
      $html .= "</div>    ";      
    }
       
    return $html;
        
  }

}
