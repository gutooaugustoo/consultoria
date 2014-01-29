<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$idEmpresa = $_REQUEST["idEmpresa"];
$url = "?empresa_id=".$idEmpresa;
?>

<div id="cadastro_empresa" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_empresa" divExibir="divLista_res" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."empresa/form.php?idEmpresa=".$idEmpresa?>' , '#divLista_res')" >
			Empresa
		</div>

		<?php if( $idEmpresa ) {
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
		
		<div id="aba_endereco" divExibir="divLista_res" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."gestor/lista.php".$url?>' , '#divLista_res')" >
			Gestor
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
