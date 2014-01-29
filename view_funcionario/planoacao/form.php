<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Planoacao = new Planoacao();
if( $idPlanoacao = $_REQUEST["idPlanoacao"] ){
  $Planoacao->__construct($idPlanoacao);
}else{
  //$Planoacao->set_($_REQUEST[""]);
}

$nomeTable = "planoacao";
$acao = CAM_VIEW."planoacao/acao.php";
?>
<fieldset>
	<legend>Plano de ação</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idPlanoacao" name="idPlanoacao" value="<?php echo $Planoacao -> get_idPlanoacao() ?>" />
		
				<p>
				<label>Tipo:</label>
				<!--<input type="text" name="tipo" id="tipo" value="<?php echo $Planoacao -> get_tipoPlanoacao()?>" class="required numeric" />-->
				<?php 
				$array[] = array("id" => "1", "legenda" => "Escrito");
        $array[] = array("id" => "2", "legenda" => "Redação");
        $array[] = array("id" => "3", "legenda" => "Oral");        
        echo Html::select("tipo", $Planoacao -> get_tipoPlanoacao(), $array);
        ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   												
				<p>
				<label>Plano:</label>
				<input type="text" name="plano" id="plano" value="<?php echo $Planoacao -> get_planoPlanoacao()?>" class="required textoGrande" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
			</div>
			
			<div class="linha-inteira">
				<p><button class="button blue" 
				onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Enviar</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>
<script>ativarForm();</script> 