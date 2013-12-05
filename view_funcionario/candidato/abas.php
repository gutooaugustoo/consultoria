<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idCandidato = $_REQUEST["idCandidato"];
$url = "?pessoa_id=".$idCandidato;
?>

<div id="cadastro_candidato" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_candidato" divExibir="divLista_res" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."candidato/form.php?idCandidato=".$idCandidato?>' , '#divLista_res')" >
			Candidato
		</div>
		<?php if( $idCandidato ) {
		?>
		<div id="abaLista_telefone" divExibir="divLista_res" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."telefone/lista.php".$url?>' , '#divLista_res')" >
			Telefone
		</div>

		<div id="abaLista_enderecovirtual" divExibir="divLista_res" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."enderecovirtual/lista.php".$url?>' , '#divLista_res')" >
			Endereço Virtual
		</div>

		<div id="aba_endereco" divExibir="divLista_res" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."endereco/lista.php".$url?>' , '#divLista_res')" >
			Endereço
		</div>

		<?php } ?>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="divLista_res" class="div_aba_interna">
			<?php
			include "form.php";
			?>
		</div>
	</div>
</div>
