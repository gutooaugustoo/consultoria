<?php
class Servico_candidato extends Servico_candidato_m {

  //CONSTRUTOR
  function __construct($idServico_candidato = "") {
    parent::__construct($idServico_candidato);
  }

  function __destruct() {
    parent::__destruct();
  }

  //GERAR ELEMENTOS
  function selectServico_candidato_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
    $where .= " AND S.excluido = 0";
    $campos = array("S.id", "S. AS legenda");
    $array = $this -> selectServico_candidato($where, $campos);
    return Html::select($nomeId, $idAtual, $array);
  }

  /*function selectMultipleServico_candidato_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
   $where .= " AND S.excluido = 0";
   $campos = array("S.id", "S. AS legenda");
   $array = $this -> selectServico_candidato($where, $campos);
   return Html::selectMultiple($nomeId, $idAtual, $array);
   }*/

  /*function checkBoxServico_candidato_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
   $where .= " AND S.excluido = 0";
   $campos = array("id", " AS legenda");
   $array = $this -> selectServico_candidato($where, $campos);
   return Html::selectMultiple($nomeId, $idAtual, $array);
   }*/

  function tabela_areaCandidato_html($servico_candidato_id, $caminho, $atualizar, $ondeAtualizar) {
    
    $this->__construct($servico_candidato_id);    
    $Servico = new Servico( $this->get_servico_idServico_candidato() );
    
    $etapas = array();        
    if ( $Servico -> get_temOralServico() ) $etapas[] = "oral";
    if ( $Servico -> get_temRedacaoServico() ) $etapas[] = "redacao";
    if ( $Servico -> get_temEscritoServico() ) $etapas[] = "escrito"; 
        
    $linhas = array();
    $Etapa = new Etapa();
    $where = " WHERE servico_id = ".$Servico->get_idServico()." AND excluido = 0";
     
    foreach ($etapas as $key_etapas => $value_etapas) {
      
      switch ($value_etapas) {
          
        case 'oral':
          $descricao = "Avaliação oral";
          
          $Oral = new Oral($where);
          $etapa = $Oral->get_etapa_idOral();
          
          $where_oral = " WHERE servico_candidato_id = ".$this -> get_idServico_candidato(). " AND oral_id = ".$Oral->get_idOral();
          $Candidato_oral = new Candidato_oral($where_oral);
          $status = $Candidato_oral->get_finalizadoCandidato_oral();
          
          $onclick = "";    
          
          break;
        
        case 'redacao':
          $descricao = "Redação";
          
          $Redacao = new Redacao($where);
          $etapa = $Redacao->get_etapa_idRedacao();   
          
          $where_redacao = " WHERE servico_candidato_id = ".$this -> get_idServico_candidato(). " AND redacao_id = ".$Redacao->get_idRedacao();
          $Candidato_redacao = new Candidato_redacao($where_redacao);                 
          $status = $Candidato_redacao->get_finalizadoCandidato_redacao();
          
          $onclick = "";
          
          break;
        
        case 'escrito':
          $descricao = "Avaliação escrita";
          
          $Escrito = new Escrito($where);                   
          $etapa = $Escrito->get_etapa_idEscrito();
          
          $where_escrito = " WHERE servico_candidato_id = ".$this -> get_idServico_candidato(). " AND escrito_id = ".$Escrito->get_idEscrito();
          if( $Escrito->get_randomicoEscrito() ){
            $Candidato_escrito_randomica = new Candidato_escrito_randomica($where_escrito);
            $status = $Candidato_escrito_randomica->get_finalizadoCandidato_escrito_randomica();
            
            $onclick = "";                
          }else{
            $Candidato_escrito = new Candidato_escrito($where_escrito);
            $status = $Candidato_escrito->get_finalizadoCandidato_escrito();                        
            $onclick = CAM_VIEW . "candidato_escrito/abas.php?escrito_id=".$Escrito->get_idEscrito();
          }
          
          break;
                    
        default:
          break 2;              
      }
            
      $Etapa->__construct($etapa);
      $botao = "<img src=\"" . CAM_IMG . "prova.png\" title=\"Iniciar $descricao\" onclick=\"abrirNivelPagina(this, '$onclick', '$atualizar', '$ondeAtualizar')\" 
      id=\"bt_$value_etapas\" >";
            
      $colunas = array();      
      $colunas[] = $Etapa->get_etapaEtapa();
      $colunas[] = $descricao;       
      $colunas[] = array(Uteis::exibirStatus($status));
      $colunas[] = array($botao);
               
      $linhas[] = $colunas;
      
    }   
    
    //TESTE ORAL
   /* if ( $Servico -> get_temOralServico() ) {
          
      $Candidato_oral = new Candidato_oral();
      $where = " WHERE CO.excluido = 0 AND O.video = 1 AND S.id = " . Uteis::escapeRequest($idServico) . " AND SC.candidato_id = " . Uteis::escapeRequest($idCandidato);    
      $rs = $Candidato_oral -> selectCandidato_oralJoin($where, array("CO.id", "CO.finalizado", "SA.avaliador_id"));
      
      if ( $rs ) {
        $Avaliador = new Avaliador( $rs[0]['avaliador_id'] );        
        $colunas[] = $Avaliador->get_nomePessoa();
        $colunas[] = Uteis::exibirStatus($rs[0]['finalizado']);        
      } else {       
        $colunas[] = "Agendar";
        $colunas[] = "";      
      }
      
    }
    */
    return Html::montarColunas($linhas);
    
  }

  function tabelaServico_candidato_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false) {

    $array = $this -> selectServico_candidato($where, array("S.id"));

    if ($array) {

      $cont = 0;
      $linhas = array();

      foreach ($array as $iten) {

        $colunas = array();

        //CARREGAR VALORES
        $this -> __construct($iten['id']);

        $Candidato = new Candidato($this -> get_candidato_idServico_candidato());
        $colunas[] = $Candidato -> get_nomePessoa();
        $colunas[] = $this -> get_dataValidadeServico_candidato();

        $ordem = ($apenasLinha !== false) ? $apenasLinha : $cont++;
        $urlAux = "&ordem=" . $ordem . "&tabela=" . Html::get_idTabela();
        $atualizarFinal = $atualizar . $urlAux . "&tr=1&idServico_candidato=" . $this -> get_idServico_candidato();

        $editar = "<img src=\"" . CAM_IMG . "editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '" . $caminho . "abas.php?idServico_candidato=" . $this -> get_idServico_candidato() . "', '$atualizarFinal', '$ondeAtualizar')\" >";

        $deletar = "<img src=\"" . CAM_IMG . "excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('" . $caminho . "acao.php?" . $urlAux . "', '" . $this -> get_idServico_candidato() . "', '$atualizarFinal', '$ondeAtualizar')\">";

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
  function cadastrarServico_candidato($idServico_candidato, $post = array()) {

    //CARREGAR DO POST
    $servico_id = ($post['servico_id']);
    if ($servico_id == '')
      return array(false, MSG_OBRIGAT . " Servico");

    $candidato_id = ($post['candidato_id']);
    if ($candidato_id == '')
      return array(false, MSG_OBRIGAT . " Candato");

    $dataValidade = ($post['dataValidade']);
    if ($dataValidade == '')
      return array(false, MSG_OBRIGAT . " Data Validade");

    $where = " WHERE excluido = 0 AND candidato_id = " . Uteis::escapeRequest($candidato_id) . " AND servico_id = " . Uteis::escapeRequest($servico_id);
    if ($idServico_candidato)
      $where .= " AND id NOT IN (" . Uteis::escapeRequest($idServico_candidato) . ") ";
    $rs = $this -> selectServico_candidato($where, array("id"));
    if ($rs)
      return array(false, "Esse candidato já está vinculado a este serviço");

    //SETAR
    $this -> set_servico_idServico_candidato($servico_id) -> set_candidato_idServico_candidato($candidato_id) -> set_dataValidadeServico_candidato($dataValidade);

    if ($idServico_candidato) {
      $this -> set_idServico_candidato($idServico_candidato);
      return ($this -> updateServico_candidato());
    } else {
      return ($this -> insertServico_candidato());
    }

  }

  function deletarServico_candidato($idServico_candidato) {
    $this -> set_idServico_candidato($idServico_candidato);
    return ($this -> deleteServico_candidato());
  }

}
