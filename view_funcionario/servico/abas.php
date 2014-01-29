<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$idServico = $_REQUEST["idServico"];
$url = "?servico_id=" . $idServico;
?>

<div id="cadastro_servico" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_servico" divExibir="div_servico" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico/form.php?idServico=".$idServico?>' , '#div_servico')" >
			Serviço
		</div>

		<?php if( $idServico ){
		?>

		<div id="aba_servico" divExibir="div_servico" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico_gestor/lista.php".$url?>' , '#div_servico')" >
			Gestores
		</div>

		<div id="aba_servico" divExibir="div_servico" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico_avaliador/lista.php".$url?>' , '#div_servico')" >
			Avaliadores
		</div>

		<div id="aba_servico-precadastro" divExibir="div_servico" class="aba_interna"
    onclick="carregarModulo('<?php echo CAM_VIEW."candidato_precadastro/lista.php".$url?>' , '#div_servico')" >
      Pré-cadastro de candidatos
    </div>
    
    <div id="aba_servico" divExibir="div_servico" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico_candidato/lista.php".$url?>' , '#div_servico')" >
			Candidatos vinculados
		</div>

		<div id="aba_servico" divExibir="div_servico" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."servico/conteudo.php".$url?>' , '#div_servico')" >
			Conteúdo
		</div>

		<?php }?>

	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_servico" class="div_aba_interna">
			<?php
      include "form.php";
			?>
		</div>
	</div>
</div>
