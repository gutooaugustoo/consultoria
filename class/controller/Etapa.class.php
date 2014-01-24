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

  function tabelaEtapa_html($Servico, $atualizar = "", $ondeAtualizar = "") {

    $etapasCadastradas = array();
    $etapasCadastradas_id = array();

    if ($Servico -> get_temEscritoServico()) {
      $Escrito = new Escrito();
      $rs = $Escrito -> selectEscrito(" WHERE excluido = 0 AND servico_id = " . $Servico -> get_idServico());
      $etapasCadastradas["escrito"] = $rs[0]['etapa_id'];
      $etapasCadastradas_id["escrito"] = $rs[0]['id'];
    }

    if ($Servico -> get_temRedacaoServico()) {
      $Redacao = new Redacao();
      $rs = $Redacao -> selectRedacao(" WHERE excluido = 0 AND servico_id = " . $Servico -> get_idServico());
      $etapasCadastradas["redacao"] = $rs[0]['etapa_id'];
      $etapasCadastradas_id["redacao"] = $rs[0]['id'];
    }
    
    if ($Servico -> get_temOralServico()) {
      $Oral = new Oral();
      $rs = $Oral -> selectOral(" WHERE excluido = 0 AND servico_id = " . $Servico -> get_idServico());
      $etapasCadastradas["oral"] = $rs[0]['etapa_id'];
      $etapasCadastradas_id["oral"] = $rs[0]['id'];      
    }

    $where = " ORDER BY id ASC";
    $arrTodasEtapas = $this -> selectEtapa($where, array("E.id"));

    if ($arrTodasEtapas) {

      $cont = 0;
      $linha = array();
      $parar = false;
      $count_etapasCadastradas = count($etapasCadastradas);
      
      foreach ($arrTodasEtapas as $key_arrTodasEtapas => $iten_arrTodasEtapas) {

        $colunas = array();
        $botaoEtapa = "";
        
        if ($parar || $count_etapasCadastradas == $key_arrTodasEtapas) break;

        //CARREGAR VALORES
        $this -> __construct($iten_arrTodasEtapas['id']);

        $colunas[] = $this -> get_etapaEtapa();
        $etapaAtual = array_search($this -> get_idEtapa(), $etapasCadastradas);
        
        switch ( $etapaAtual ) {
          case 'escrito' || 'oral' || 'redacao' :
           
            $botaoEtapa = "<img src=\"".CAM_IMG."editar.png\" 
            onclick=\"abrirNivelPagina(this, '" . CAM_VIEW . $etapaAtual . "/abas.php?id" . ucfirst($etapaAtual) . "=".$etapasCadastradas_id[$etapaAtual]."', '$atualizar', '$ondeAtualizar')\" >              
             ".ucfirst($etapaAtual);
            unset($etapasCadastradas[$etapaAtual]);
            break;

          default :
           
            foreach ($etapasCadastradas as $key_etapasCadastradas => $iten_etapasCadastradas) {
              $botaoEtapa .= "<button class=\"button gray\" 
              onclick=\"abrirNivelPagina(this, '" . CAM_VIEW . $key_etapasCadastradas . "/abas.php?servico_id=".$Servico -> get_idServico()."&etapa_id=" . $this -> get_idEtapa() . "', '$atualizar', '$ondeAtualizar')\" >
                " . ucfirst($key_etapasCadastradas) . "
              </button>";
            }
            
            $parar = true;
            break;
        }
        
        $colunas[] = $botaoEtapa;

         /*$deletar = "<img src=\"" . CAM_IMG . "excluir.png\" title=\"Excluir registro\"
         onclick=\"deletaRegistro('" . $caminho . "acao.php?" . $urlAux . "', '" . $this -> get_idEtapa() . "', '$atualizarFinal', '$ondeAtualizar')\">";*/

        $linhas[] = $colunas;

      }

    }

    /*if ($Servico -> get_temResultadoFinalServico()) {

      $colunas = array();

      $colunas[] = "Resultado final";
      $colunas[] = "";

      $linhas[] = $colunas;

    }*/

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
