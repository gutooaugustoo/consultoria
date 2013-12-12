<?php
class Etapa extends Etapa_m {

  //CONSTRUTOR
  function __construct($idEtapa = "") {
    parent::__construct($idEtapa);
  }

  function __destruct() {
    parent::__destruct();
  }

  //GERAR ELEMENTOS
  function selectEtapa_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
    $where .= "";
    $campos = array("E.id", "E.etapa AS legenda");
    $array = $this -> selectEtapa($where, $campos);
    return Html::select($nomeId, $idAtual, $array);
  }

  /*function selectMultipleEtapa_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
   $where .= "";
   $campos = array("E.id", "E.etapa AS legenda");
   $array = $this -> selectEtapa($where, $campos);
   return Html::selectMultiple($nomeId, $idAtual, $array);
   }*/

  /*function checkBoxEtapa_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
   $where .= "";
   $campos = array("id", "etapa AS legenda");
   $array = $this -> selectEtapa($where, $campos);
   return Html::selectMultiple($nomeId, $idAtual, $array);
   }*/

  function tabelaEtapa_html($Servico, $caminho = "", $atualizar = "", $ondeAtualizar = "") {
    
    $contaEtapas = array();
    if( $Servico->get_temEscritoServico() ) {      
      $Escrito = new Escrito();
      $rs = $Escrito->selectEscrito(" WHERE excluido = 0 AND servico_id = ".$Servico->get_idServico());
      $contaEtapas["escrito"] = $rs[0]['etapa_id'];
    }
    
    if( $Servico->get_temOralServico() ) {
      $Oral = new Oral();
      $rs = $Oral->selectOral(" WHERE excluido = 0 AND servico_id = ".$Servico->get_idServico());
      $contaEtapas["oral"] = $rs[0]['etapa_id'];
    }
    
    if( $Servico->get_temRedacaoServico() ) {
      $Redacao = new Redacao();
      $rs = $Redacao->selectRedacao(" WHERE excluido = 0 AND servico_id = ".$Servico->get_idServico());
      $contaEtapas["redacao"] = $rs[0]['etapa_id'];
    }
    
    $where = " ORDER BY id ASC";
    $array = $this -> selectEtapa($where, array("E.id"));

    if ($array) {

      $cont = 0;
      $linha = array();
            
      foreach ($array as $key => $iten) {
          
        if( count($contaEtapas) == $key ) break;        
          
        $colunas = array();

        //CARREGAR VALORES
        $this -> __construct($iten['id']);
        
        $colunas[] = $this -> get_etapaEtapa();
                
        switch ( array_search($this->get_idEtapa(), $contaEtapas) ) {
          case 'escrito':
            $coluna .= ""; 
            //break;
          case 'oral':
            $coluna .= ""; 
           // break;
          case 'redacao':
            $coluna .= ""; 
            //break;
          case '':
            $coluna .= "<button class=\"button gray\"
            onclick=\"abrirNivelPagina(this, '', '', '')\" >
              Teste escrito
            </button>";            
            //break;            
        }
        
        $colunas[] = $coluna;             
        /*$ordem = ($apenasLinha !== false) ? $apenasLinha : $cont++;
        $urlAux = "&ordem=" . $ordem . "&tabela=" . Html::get_idTabela();
        $atualizarFinal = $atualizar . $urlAux . "&tr=1&idEtapa=" . $this -> get_idEtapa();*/

        /*$editar = "<img src=\"" . CAM_IMG . "editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '" . $caminho . "abas.php?idEtapa=" . $this -> get_idEtapa() . "', '$atualizarFinal', '$ondeAtualizar')\" >";

        $deletar = "<img src=\"" . CAM_IMG . "excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('" . $caminho . "acao.php?" . $urlAux . "', '" . $this -> get_idEtapa() . "', '$atualizarFinal', '$ondeAtualizar')\">";*/
        
        $linhas[] = $colunas;
        
      }

    }
    
    if( $Servico->get_temResultadoFinalServico() ){
        
      $colunas = array();
      
      $colunas[] = "Resultado final";
      $colunas[] = "";
      
      $linhas[] = $colunas;
      
    }
    
    return Html::montarColunas($linhas);

  }

  //AÇÕES
  function cadastrarEtapa($idEtapa, $post = array()) {

    //CARREGAR DO POST
    $etapa = ($post['etapa']);
    if ($etapa == '')
      return array(false, MSG_OBRIGAT . " Etapa");

    //SETAR
    $this -> set_etapaEtapa($etapa);

    if ($idEtapa) {
      $this -> set_idEtapa($idEtapa);
      return ($this -> updateEtapa());
    } else {
      return ($this -> insertEtapa());
    }

  }

  function deletarEtapa($idEtapa) {
    $this -> set_idEtapa($idEtapa);
    return ($this -> deleteEtapa());
  }

}
