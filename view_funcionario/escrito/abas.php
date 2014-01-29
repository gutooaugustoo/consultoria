<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$idEscrito = $_REQUEST["idEscrito"];

$servico_id = $_REQUEST["servico_id"];
$etapa_id = $_REQUEST["etapa_id"];

$url = "&servico_id=".$servico_id."&etapa_id=".$etapa_id."&escrito_id=".$idEscrito;
?>

<div id="cadastro_escrito" class="">
	<div class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		
		<div id="aba_escrito" divExibir="div_escrito" class="aba_interna ativa"
		onclick="carregarModulo('<?php echo CAM_VIEW."escrito/form.php?idEscrito=".$idEscrito.$url?>' , '#div_escrito')" >Escrito</div>
		
		<?php if( $idEscrito ){ 
		  
		  $Escrito = new Escrito($idEscrito);
		  if( $Escrito->get_randomicoEscrito() ){
		    $caminhoEscrito = "escrito_pergunta_randomica";
		  }else{
		    $caminhoEscrito = "escrito_pergunta";
		  }
		  ?>

      <div id="aba_redacao" divExibir="div_redacao" class="aba_interna"
      onclick="carregarModulo('<?php echo CAM_VIEW."peso_nivel/lista.php?".$url?>' , '#div_escrito')" >        
      Peso do teste</div>
      
      <div id="aba_redacao" divExibir="div_redacao" class="aba_interna"
      onclick="carregarModulo('<?php echo CAM_VIEW.$caminhoEscrito."/lista.php?".$url?>' , '#div_escrito')" >        
      Perguntas</div>
            
    <?php }?>
    
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_escrito" class="div_aba_interna">			
			<?php include "form.php"; ?>						
		</div>
	</div>
</div>
