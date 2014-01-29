<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$servico_candidato_id = $_SESSION['servico_candidato_id'];
$escrito_id = $_REQUEST["escrito_id"];

$where = " WHERE excluido = 0 AND servico_candidato_id = ".Uteis::escapeRequest($servico_candidato_id)." AND escrito_id = ".Uteis::escapeRequest($escrito_id);
$Candidato_escrito = new Candidato_escrito($where);
if( $Candidato_escrito->get_idCandidato_escrito() ){
  if( $Candidato_escrito->get_finalizadoCandidato_escrito() ){
    Uteis::alertJava("Esse item foi finalizado e não está mais acessível");
    Uteis::fecharNivel();
  }
}else{  

  $post = array(
    "escrito_id" => $escrito_id,
    "servico_candidato_id" => $servico_candidato_id,
  );
  $rs = $Candidato_escrito -> cadastrarCandidato_escrito("", $post);
  if( $rs[0] == false ){
    Uteis::alertJava("Não foi possível iniciar o teste");
    Uteis::fecharNivel();
  }else{
    $Candidato_escrito->__construct($rs[0]);
  }
  
}

?>

<div id="cadastro_candidato_escrito" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_candidato_escrito" divExibir="div_candidato_escrito" class="aba_interna ativa" >
			Avaliação escrita
		</div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_candidato_escrito" class="div_aba_interna">
			<?php include_once 'explicacao.php';?>
		</div>
	</div>
</div>

