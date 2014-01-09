<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$idRedacao = $_REQUEST["idRedacao"];

$servico_id = $_REQUEST["servico_id"];
$etapa_id = $_REQUEST["etapa_id"];

$url = "&servico_id=".$servico_id."&etapa_id=".$etapa_id."&redacao_id=".$idRedacao;
?>

<div id="cadastro_redacao" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_redacao" divExibir="div_redacao" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."redacao/form.php?idRedacao=".$idRedacao.$url?>' , '#div_redacao')" >Redação</div>
		
		<?php if( $idRedacao ){    ?>

      <div id="aba_redacao" divExibir="div_redacao" class="aba_interna"
      onclick="carregarModulo('<?php echo CAM_VIEW."redacao_temaredacao/lista.php?".$url?>' , '#div_redacao')" >
        Temas
      </div>
      
      <div id="aba_redacao" divExibir="div_redacao" class="aba_interna"
      onclick="carregarModulo('<?php echo CAM_VIEW."redacao_itemavaliar/lista.php?".$url?>' , '#div_redacao')" >
        Itens a avaliar
      </div>
    
    <?php }?>
    
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_redacao" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
