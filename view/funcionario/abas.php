<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/admin.php");

$idFuncionario = $_REQUEST["idFuncionario"];
$url = "?pessoa_id=".$idFuncionario
?>

<div id="cadastro_funcionario" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="abaLista_funcionario" divExibir="divLista_funcionario" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."funcionario/form.php?idFuncionario=".$idFuncionario?>' , '#divLista_funcionario')" >
			Funcionario
		</div>
		<?php if( $idFuncionario ) {
		?>
		<div id="abaLista_telefone" divExibir="divLista_funcionario" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."telefone/lista.php".$url?>' , '#divLista_funcionario')" >
			Telefone
		</div>

		<div id="abaLista_enderecovirtual" divExibir="divLista_funcionario" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."enderecovirtual/lista.php".$url?>' , '#divLista_funcionario')" >
			Endereço Virtual
		</div>

		<div id="aba_endereco" divExibir="divLista_funcionario" class="aba_interna"
		onclick="carregarModulo('<?php echo CAM_VIEW."endereco/lista.php".$url?>' , '#divLista_funcionario')" >
			Endereço
		</div>

		<?php } ?>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="divLista_funcionario" class="div_aba_interna">
			<?php
			include "form.php";
			?>
		</div>
	</div>
</div>
