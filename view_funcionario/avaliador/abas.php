<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$idAvaliador = $_REQUEST["idAvaliador"];
$url = "?pessoa_id=".$idAvaliador;
?>

<div id="cadastro_avaliador" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="abaLista_avaliador" divExibir="divLista_res" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."avaliador/form.php?idAvaliador=".$idAvaliador?>' , '#divLista_res')" >
			Avaliador
		</div>
		<?php if( $idAvaliador ) {
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