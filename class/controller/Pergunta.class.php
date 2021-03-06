<?php
class Pergunta extends Pergunta_m {

  //CONSTRUTOR
  function __construct($idPergunta = "") {
    parent::__construct($idPergunta);
  }

  function __destruct() {
    parent::__destruct();
  }

  //GERAR ELEMENTOS
  function selectPergunta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
    $where .= " AND P.excluido = 0";
    $campos = array("id", "titulo AS legenda");
    $array = $this -> selectPergunta($where, $campos);
    return Html::select($nomeId, $idAtual, $array);
  }

  function selectMultiplePergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
    $where .= " AND P.excluido = 0";
    $campos = array("id", "titulo AS legenda");
    $array = $this -> selectPergunta($where, $campos);
    return Html::selectMultiple($nomeId, $idAtual, $array);
  }

  /*function checkBoxPergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
   $where .= " AND P.excluido = 0";
   $campos = array("id", "titulo AS legenda");
   $array = $this -> selectPergunta($where, $campos);
   return Html::selectMultiple($nomeId, $idAtual, $array);
   }*/

  function tabelaPergunta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false) {

    $array = $this -> selectPergunta($where, array("P.id"));

    if ($array) {

      $cont = 0;
      $linha = array();

      foreach ($array as $iten) {

        $colunas = array();

        //CARREGAR VALORES
        $this -> __construct($iten['id']);

        $colunas[] = $this -> get_tituloPergunta();
        $Idioma = new Idioma($this -> get_idioma_idPergunta());
        $colunas[] = $Idioma -> get_nomeIdioma();
        $Nivelpergunta = new Nivelpergunta($this -> get_nivelPergunta_idPergunta());
        $colunas[] = $Nivelpergunta -> get_nomeNivelpergunta();
        $Categoriapergunta = new Categoriapergunta($this -> get_categoriaPergunta_idPergunta());
        $colunas[] = $Categoriapergunta -> get_nomeCategoriapergunta();
        if ($this -> get_empresa_idPergunta()) {
          $Empresa = new Empresa($this -> get_empresa_idPergunta());
          $colunas[] = $Empresa -> get_nomeFantasiaEmpresa();
        } else {
          $colunas[] = "Todas";
        }
        $colunas[] = $this -> get_inativoPergunta(true);

        $ordem = ($apenasLinha !== false) ? $apenasLinha : $cont++;
        $urlAux = "&ordem=" . $ordem . "&tabela=" . Html::get_idTabela();
        $atualizarFinal = $atualizar . $urlAux . "&tr=1&idPergunta=" . $this -> get_idPergunta();

        $editar = "<img src=\"" . CAM_IMG . "editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '" . $caminho . "abas.php?idPergunta=" . $this -> get_idPergunta() . "', '$atualizarFinal', '$ondeAtualizar')\" >";

        $deletar = "<img src=\"" . CAM_IMG . "excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('" . $caminho . "acao.php?" . $urlAux . "', '" . $this -> get_idPergunta() . "', '$atualizarFinal', '$ondeAtualizar')\">";

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

  function tabelaPerguntaAgrupamento_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false) {

    $array = $this -> selectPergunta($where, array("P.id"));

    if ($array) {

      $cont = 0;
      $linha = array();

      foreach ($array as $iten) {

        $colunas = array();

        //CARREGAR VALORES
        $this -> __construct($iten['id']);

        $Tipopergunta = new Tipopergunta($this -> get_tipoPergunta_idPergunta());
        $colunas[] = $Tipopergunta -> get_descricaoTipopergunta();
        $colunas[] = $this -> get_tituloPergunta();
        $colunas[] = $this -> get_inativoPergunta(true);

        $ordem = ($apenasLinha !== false) ? $apenasLinha : $cont++;
        $urlAux = "&ordem=" . $ordem . "&tabela=" . Html::get_idTabela();
        $atualizarFinal = $atualizar . $urlAux . "&tr=1&idPergunta=" . $this -> get_idPergunta();

        $editar = "<img src=\"" . CAM_IMG . "editar.png\" title=\"Editar registro\" 
        onclick=\"abrirNivelPagina(this, '" . $caminho . "abas.php?idPergunta=" . $this -> get_idPergunta() . "', '$atualizarFinal', '$ondeAtualizar')\" >";

        $deletar = "<img src=\"" . CAM_IMG . "excluir.png\" title=\"Excluir registro\" 
        onclick=\"deletaRegistro('" . $caminho . "acao.php?" . $urlAux . "', '" . $this -> get_idPergunta() . "', '$atualizarFinal', '$ondeAtualizar')\">";

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
  function cadastrarPergunta($idPergunta, $post = array()) {

    //CARREGAR DO POST
    $tipoPergunta_id = ($post['tipoPergunta_id']);
    if ($tipoPergunta_id == '')
      return array(false, MSG_OBRIGAT . " Tipo Pergunta");

    $pergunta_id = ($post['pergunta_id']);

    $empresa_id = ($post['empresa_id']);

    $idioma_id = ($post['idioma_id']);
    if ($idioma_id == '')
      return array(false, MSG_OBRIGAT . " Idioma");

    $nivelPergunta_id = ($post['nivelPergunta_id']);
    if ($nivelPergunta_id == '')
      return array(false, MSG_OBRIGAT . " Nivel Pergunta");

    $categoriaPergunta_id = ($post['categoriaPergunta_id']);
    if ($categoriaPergunta_id == '')
      return array(false, MSG_OBRIGAT . " Categoria Pergunta");

    $titulo = ($post['titulo']);
    if ($titulo == '')
      return array(false, MSG_OBRIGAT . " Titulo");

    $enunciado = ($post['enunciado']);
    if ($tipoPergunta_id == '4' && $enunciado == '')
      return array(false, MSG_OBRIGAT . " Complemento da questão");

    if ($tipoPergunta_id == "5") {
      $tempoResposta = "0";
    } else {
      $tempoResposta = ($post['tempoResposta']);
    }
    if ($tempoResposta == '')
      return array(false, MSG_OBRIGAT . " Tempo Resposta");

    $inativo = ($post['inativo']);

    //SETAR
    $this -> set_tipoPergunta_idPergunta($tipoPergunta_id) -> set_pergunta_idPergunta($pergunta_id) -> set_empresa_idPergunta($empresa_id) -> set_idioma_idPergunta($idioma_id) -> set_nivelPergunta_idPergunta($nivelPergunta_id) -> set_categoriaPergunta_idPergunta($categoriaPergunta_id) -> set_tituloPergunta($titulo) -> set_enunciadoPergunta($enunciado) -> set_tempoRespostaPergunta($tempoResposta) -> set_inativoPergunta($inativo);

    if ($idPergunta) {
      $this -> set_idPergunta($idPergunta);
      return ($this -> updatePergunta());
    } else {
      return ($this -> insertPergunta());
    }

  }

  function deletarPergunta($idPergunta) {
    $this -> set_idPergunta($idPergunta);
    return ($this -> deletePergunta());
  }

  function ver_objetoResposta() {
    switch ($this->get_tipoPergunta_idPergunta()) {
      //ALTERNATIVAS
      case '1' :
        return new Resp_alternativacorreta();
        break;
      //VERDADEIRO FALSO
      case '2' :
        return new Resp_verdadeirofalso();
        break;
      //ASSOCIAÇÃO
      case '3' :
        return new Resp_associeresposta();
        break;
      //PREENCHER LACUNA
      case '4' :
        return new Resp_preenchelacuna();
        break;
    }
  }

  function ver_temRespostaCadastrada($escrito_pergunta_id, $candidato_escrito_id) {
    $where_resp = " WHERE excluido = 0 AND escrito_pergunta_id = " . $escrito_pergunta_id . " AND candidato_escrito_id = " . $candidato_escrito_id;
    switch ($this->get_tipoPergunta_idPergunta()) {
      //ALTERNATIVAS
      case '1' :
        $Resposta = new Resposta_escrito_alternativacorreta($where_resp);
        return $Resposta -> get_idResposta_escrito_alternativacorreta();
        break;
      //VERDADEIRO FALSO
      case '2' :
        $Resposta = new Resposta_escrito_verdadeirofalso($where_resp);
        return $Resposta -> get_idResposta_escrito_verdadeirofalso();
        break;
      //ASSOCIAÇÃO
      case '3' :
        $Resposta = new Resposta_escrito_associeresposta($where_resp);
        return $Resposta -> get_idResposta_escrito_associeresposta();
        break;
      //PREENCHER LACUNA
      case '4' :
        $Resposta = new Resposta_escrito_preenchelacuna($where_resp);
        return $Resposta -> get_idResposta_escrito_preenchelacuna();
        break;
      //INTERPRETAÇÃO DE TEXTO
      case '5' :
        $temResposta = false;
        break;
    }
  }
  
  function ver_includeResposta() {
    switch ($this->get_tipoPergunta_idPergunta()) {
      //ALTERNATIVAS
      case '1' :        
        return '_resposta.php';
        break;
      //VERDADEIRO FALSO
      case '2' :
        return '_resposta.php';
        break;
      //ASSOCIAÇÃO
      case '3' :
        return '_resposta_associa.php';
        break;
      //PREENCHER LACUNA
      case '4' :
        return '_resposta_lacuna.php';
        break;
      //INTERPRETAÇÃO DE TEXTO
      case '5' :
        return '_form_interpretacao.php';
        break;
    }
  }
    
  function verificarGrupoQuestoes(){
      
    $where = " WHERE P.excluido = 0 AND P.id NOT IN(
      SELECT EP.pergunta_id FROM perguntaVisualizada AS PV
      INNER JOIN escrito_pergunta AS EP ON EP.id = PV.escrito_pergunta_id
      WHERE EP.pergunta_id = P.id 
    ) AND P.pergunta_id = ".$this->get_idPergunta();
    $rs = $this->selectPergunta($where, array("id"));
    return count($rs);
  }
  
}
