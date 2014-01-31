<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$servico_candidato_id = $_SESSION['servico_candidato_id'];
$escrito_id = $_REQUEST["escrito_id"];
$candidato_escrito_id = $_REQUEST["candidato_escrito_id"];

$nomeTable = "escrito_pergunta";
$acao = CAM_VIEW . "escrito_pergunta/acao.php";

$where = " WHERE E.escrito_id = " . Uteis::escapeRequest($escrito_id) . " AND E.excluido = 0 
AND E.id NOT IN( 
  SELECT PV.escrito_pergunta_id FROM perguntaVisualizada AS PV WHERE PV.escrito_pergunta_id = E.id
)
ORDER BY ordem ASC ";
$Escrito_pergunta = new Escrito_pergunta($where);

if( $Escrito_pergunta -> get_idEscrito_pergunta() ){
  $where = " WHERE excluido = 0 AND escrito_pergunta_id = " . $Escrito_pergunta -> get_idEscrito_pergunta() . " AND candidato_escrito_id = " . Uteis::escapeRequest($candidato_escrito_id);
  $Perguntavisualizada = new Perguntavisualizada($where);
  if ($Perguntavisualizada -> get_idPerguntavisualizada()) {
    Uteis::alertJava("Essa questão não está mais disponível para visualização");
    Uteis::fecharNivel();
  }
}else{
  Uteis::alertJava("Prova finalizada");exit;
  Uteis::fecharNivel();
}
$Pergunta = new Pergunta($Escrito_pergunta -> get_pergunta_idEscrito_pergunta());

$where_resp = " WHERE excluido = 0 AND escrito_pergunta_id = " . $Escrito_pergunta -> get_idEscrito_pergunta() . " AND candidato_escrito_id = " . Uteis::escapeRequest($candidato_escrito_id);
$temResposta = false;

if ($temResposta)
  Uteis::alertJava('Ja tem resposta');

Uteis::timer("#formCad_$nomeTable #timer", Uteis::gravarHoras($Pergunta -> get_tempoRespostaPergunta()));
?>
<fieldset>
	<legend>
		<?php echo $Escrito_pergunta -> get_ordemEscrito_pergunta(); ?>ª
		questão
	</legend>

	<?php
  switch ($Pergunta->get_tipoPergunta_idPergunta()) {
    case '1' :
      $Opcao_resp = new Resp_alternativacorreta();
      $Resposta = new Resposta_escrito_alternativacorreta($where_resp);
      $temResposta = $Resposta -> get_idResposta_escrito_alternativacorreta();
      include_once '_resposta.php';
      break;

    case '2' :
      $Opcao_resp = new Resp_verdadeirofalso();
      $Resposta = new Resposta_escrito_verdadeirofalso($where_resp);
      $temResposta = $Resposta -> get_idResposta_escrito_verdadeirofalso();
      include_once '_resposta.php';
      break;

    case '3' :
      $Opcao_resp = new Resp_associeresposta();
      $Resposta = new Resposta_escrito_associeresposta($where_resp);
      $temResposta = $Resposta -> get_idResposta_escrito_associeresposta();
      include_once '_resposta_associa.php';
    break;

    case '4' :
      $Opcao_resp = new Resp_preenchelacuna();
      $Resposta = new Resposta_escrito_lacuna($where_resp);
      $temResposta = $Resposta -> get_idResposta_escrito_lacuna();
      include_once '_resposta_lacuna.php';
      break;

    case '5' :
      //
      break;
  }
	?>
</fieldset>

<?php
exit ;
if (!$Perguntavisualizada -> get_idPerguntavisualizada()) {
  $post = array("candidato_escrito_id" => $candidato_escrito_id, "escrito_pergunta_id" => $Escrito_pergunta -> get_idEscrito_pergunta(), );
  $rs = $Perguntavisualizada -> cadastrarPerguntavisualizada("", $post);
  
  if ($rs[0] == false) {
    Uteis::fecharNivel();
    Uteis::alertJava("Não é possível responder essa questão");
  }
}
?>

