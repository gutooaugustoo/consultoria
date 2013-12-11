<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

if ($idPergunta = $_REQUEST["idPergunta"]) {
	$Pergunta = new Pergunta($idPergunta);
	$tipoPergunta_id = $Pergunta -> get_tipoPergunta_idPergunta();
} else {
	$tipoPergunta_id = $_REQUEST['tipoPergunta_id'];
}

$Tipopergunta = new Tipopergunta($tipoPergunta_id);
$url = "&tipoPergunta_id=" . $tipoPergunta_id;
?>

<div id="cadastro_pergunta" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_pergunta" divExibir="div_pergunta" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."pergunta/form.php?idPergunta=".$idPergunta.$url?>' , '#div_pergunta')" >Pergunta - <?php echo $Tipopergunta -> get_descricaoTipopergunta(); ?></div>
		<?php if( $idPergunta ){ 
			switch ($tipoPergunta_id) {
				case '1':
					$tipoPergunta_pasta = "resp_alternativacorreta";			
					break;
				case '2':
					$tipoPergunta_pasta = "resp_verdadeirofalso";				
					break;
				case '3':
					$tipoPergunta_pasta = "resp_associeresposta";
					break;
				case '4':
					$tipoPergunta_pasta = "resp_preenchelacuna";
					break;
				case '5':
					$tipoPergunta_pasta = "";
					break;
			}
			?>
		
			<div id="aba_pergunta" divExibir="div_pergunta" class="aba_interna"
			onclick="carregarModulo('<?php echo CAM_VIEW.$tipoPergunta_pasta."/lista.php?pergunta_id=".$idPergunta.$url?>' , '#div_pergunta')" ><?php echo $tipoPergunta_id != "5" ? "Respostas" : "Perguntas"?></div>
		
		<?php } ?>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_pergunta" class="div_aba_interna">			
			<?php
			include "form.php";
 			?>						
		</div>
	</div>
</div>
