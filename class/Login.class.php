<?php
class Login extends Database {

  // constructor
  function __construct() {
    parent::__construct();
  }

  function __destruct() {
    parent::__destruct();
  }

  function efetuarLogin_funcionario($documentoUnico, $senhaAcesso) {
    $Funcionario = new Funcionario();
    $where = "WHERE P.excluido = 0 AND P.inativo = 0 AND P.documento = " . Uteis::escapeRequest($documentoUnico) . " AND P.senha = " . Uteis::escapeRequest($senhaAcesso);
    $rs = $Funcionario -> selectFuncionario($where, array("F.id"));
    //Uteis::pr($rs, 1);
    if ($rs)
      $this -> efetuarLogin($rs[0]['id'], "funcionario");
    return array(false, "Login ou senha inválidos");
  }

  function efetuarLogin_candidato($documentoUnico, $senhaAcesso, $hash) {
   
    if (!$hash) {
      return array(false, "O link utilizado é inválido");
    } else {      
      $Servico_candidato = new Servico_candidato();
      $where = " WHERE P.excluido = 0 AND P.inativo = 0 AND P.documento = " . Uteis::escapeRequest($documentoUnico) . " AND P.senha = " . Uteis::escapeRequest($senhaAcesso)." 
      AND S.hash = " . Uteis::escapeRequest($hash)." AND S.excluido = 0 AND SC.excluido = 0  AND ( S.dataValidade >= CURDATE() OR SC.dataValidade >= CURDATE() )"; 
      $rs = $Servico_candidato -> selectServico_candidatoJoin($where, array("SC.id AS servico_candidato_id", "C.id AS idCandidato"));

      if ($rs) {
        $this -> efetuarLogin($rs[0]['idCandidato'], "candidato", array("servico_candidato_id" => $rs[0]['servico_candidato_id']));
      } else {
        //return array(false, "Usuário sem permisão para acessar o link");
        return array(false, "Login ou senha inválidos");
      }

    }
  }

  function efetuarLogin_gestor($documentoUnico, $senhaAcesso) {
    $Gestor = new Gestor();
    $where = "WHERE P.excluido = 0 AND P.inativo = 0 AND P.documento = " . Uteis::escapeRequest($documentoUnico) . " AND P.senha = " . Uteis::escapeRequest($senhaAcesso);
    $rs = $Gestor -> selectGestor($where, array("G.id"));
    //Uteis::pr($rs, 1);
    if ($rs)
      $this -> efetuarLogin($rs[0]['id'], "gestor");
    return array(false, "Login ou senha inválidos");
  }

  function efetuarLogin_avaliador($documentoUnico, $senhaAcesso) {
    $Avaliador = new Avaliador();
    $where = "WHERE P.excluido = 0 AND P.inativo = 0 AND P.documento = " . Uteis::escapeRequest($documentoUnico) . " AND P.senha = " . Uteis::escapeRequest($senhaAcesso);
    $rs = $Avaliador -> selectAvaliador($where, array("A.id"));
    //Uteis::pr($rs, 1);
    if ($rs)
      $this -> efetuarLogin($rs[0]['id'], "avaliador");
    return array(false, "Login ou senha inválidos");
  }

  function efetuarLogin($id, $session, $add_session = array()) {

    $this -> efetuarLogoff(false);

    $_SESSION['logado'] = $session;
    $_SESSION['id' . ucfirst($session)] = $id;

    foreach ($add_session as $key => $value)
      $_SESSION[$key] = $value;

    header("Location:" . CAM_ROOT . "/");
    return true;

  }

  function efetuarLogoff($redireciona = true) {

    foreach ($_SESSION as $key => $value)
      unset($_SESSION[$key]);

    if ($redireciona == true) {
      session_destroy();
      header("Location:" . CAM_ROOT . "/");
    }

  }

  function verificarLogin() {
    if ($_SESSION['logado'] && $_SESSION['id' . ucfirst($_SESSION['logado'])]) {
      return true;
    } else {
      return false;
    }
  }

}
?>