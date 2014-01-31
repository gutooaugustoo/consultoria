<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$servico_candidato_id = $_SESSION['servico_candidato_id'];
$escrito_id = Uteis::escapeRequest($_REQUEST["escrito_id"]);
$candidato_escrito_id = Uteis::escapeRequest($_REQUEST["candidato_escrito_id"]);

$nomeTable = "escrito_pergunta";
$acao = CAM_VIEW . "escrito_pergunta/acao.php";

$where = " WHERE E.excluido = 0 AND E.escrito_id = " . $escrito_id . "  
AND E.id NOT IN( SELECT PV.escrito_pergunta_id FROM perguntaVisualizada AS PV WHERE PV.escrito_pergunta_id = E.id )
ORDER BY ordem ASC ";

$Escrito_pergunta = new Escrito_pergunta($where);

if ($Escrito_pergunta -> get_idEscrito_pergunta()) {
  $where = " WHERE excluido = 0 AND escrito_pergunta_id = " . $Escrito_pergunta -> get_idEscrito_pergunta() . " AND candidato_escrito_id = " . $candidato_escrito_id;
  $Perguntavisualizada = new Perguntavisualizada($where);
  if ($Perguntavisualizada -> get_idPerguntavisualizada()) {
    Uteis::alertJava("Essa questão não está mais disponível para visualização");
    Uteis::fecharNivel();
  }
} else {
  $Candidato_escrito  = new Candidato_escrito($candidato_escrito_id);
  $Candidato_escrito->updateCampoCandidato_escrito(array("finalizado"=>"1"));
  Uteis::alertJava("Prova finalizada");
  Uteis::fecharNivel();
  exit;
}

$Pergunta = new Pergunta($Escrito_pergunta -> get_pergunta_idEscrito_pergunta());

$Opcao_resp = $Pergunta -> ver_objetoResposta();
$temResposta = $Pergunta -> ver_temRespostaCadastrada($Escrito_pergunta -> get_idEscrito_pergunta(), $candidato_escrito_id);
$include_reposta = $Pergunta -> ver_includeResposta();

if ($temResposta) Uteis::alertJava('Ja tem resposta');

echo "<div style=\"padding:1em;\">";
include_once $include_reposta;
echo "<div>";

if ($Pergunta -> get_tempoRespostaPergunta(false))
  Uteis::timer("#timer", $Pergunta -> get_tempoRespostaPergunta(false));

$Perguntavisualizada -> marcarPergunta(
  array(
    "candidato_escrito_id" => $candidato_escrito_id, 
    "escrito_pergunta_id" => $Escrito_pergunta -> get_idEscrito_pergunta()
  )
);
?>

