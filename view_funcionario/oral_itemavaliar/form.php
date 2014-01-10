<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Oral_itemavaliar = new Oral_itemavaliar();
if( $idOral_itemavaliar = $_REQUEST["idOral_itemavaliar"] ){
  $Oral_itemavaliar->__construct($idOral_itemavaliar);
}else{
  $Oral_itemavaliar->set_oral_idOral_itemavaliar($_REQUEST["oral_id"]);
}

$nomeTable = "oral_itemavaliar";
$acao = CAM_VIEW."oral_itemavaliar/acao.php";
?>
<fieldset>
	<legend>Item avaliar</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idOral_itemavaliar" name="idOral_itemavaliar" value="<?php echo $Oral_itemavaliar -> get_idOral_itemavaliar() ?>" />
		    <input type="hidden" id="oral_id" name="oral_id" value="<?php echo $Oral_itemavaliar -> get_oral_idOral_itemavaliar() ?>" />
		
				<p>
				<label>Item avaliar:</label>
				<?php $Itemavaliaroral = new Itemavaliaroral();
				Html::set_cssClass(array("required"));
				echo $Itemavaliaroral -> selectItemavaliaroral_html('itemAvaliarOral_id', $Oral_itemavaliar -> get_itemAvaliarOral_idOral_itemavaliar()); ?>
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
				<p><label for="obsTem" >
				<input type="checkbox" name="obsTem" id="obsTem" value="1" class="" onclick="mostrar_obsObrigatrio()"
				<?php echo Uteis::verificaChecked($Oral_itemavaliar -> get_obsTemOral_itemavaliar())?> />
				Haverá o campo <b>observação</b> para o avaliador preencher</label>
				<span class="placeholder" ></span></p>
		
				<p class="off" id="lbl_obsObrigatotia"><label for="obsObrigatotia" >
				<input type="checkbox" name="obsObrigatotia" id="obsObrigatotia" value="1" class=""
				<?php echo Uteis::verificaChecked($Oral_itemavaliar -> get_obsObrigatotiaOral_itemavaliar())?> />
				O campo observação será <b>obrigatório</b></label>
				<span class="placeholder" ></span></p>
		
			</div>
			
			<div class="linha-inteira">
				<p><button class="button blue" 
				onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Enviar</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>
<script>
mostrar_obsObrigatrio();
ativarForm();
  
function mostrar_obsObrigatrio(){
  var o = $('#formCad_<?php echo $nomeTable ?> #lbl_obsObrigatotia');
  if( $('#formCad_<?php echo $nomeTable ?> #obsTem').is(":checked") ){
    o.show();
  }else{
    o.hide();
  }
}

</script> 