<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Teste = new Teste();
if( $idTeste = $_REQUEST["idTeste"] ){
  $Teste->__construct($idTeste);
}else{
  //$Teste->set_($_REQUEST[""]);
}

$nomeTable = "teste";
$acao = CAM_VIEW."teste/acao.php";
?>
<fieldset>
	<legend>Teste</legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idTeste" name="idTeste" value="<?php echo $Teste -> get_idTeste() ?>" />
		
				<p>
				<label>Campo String:</label>
				<input type="text" name="campoString" id="campoString" value="<?php echo $Teste -> get_campoStringTeste()?>" class="required" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Campo Text:</label>
				<textarea name="campoText" id="campoText" cols="60" rows="4" class="required" ><?php echo $Teste -> get_campoTextTeste()?></textarea>
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Campo Int:</label>
				<input type="text" name="campoInt" id="campoInt" value="<?php echo $Teste -> get_campoIntTeste()?>" class="required numeric" />
				<span class="placeholder" >Campo obrigatório</span></p>
		   									
			</div>
			
			<div class="direita">
				
				<p><label for="campoBool" >
				<input type="checkbox" name="campoBool" id="campoBool" value="1" class=""
				<?php echo Uteis::verificaChecked($Teste -> get_campoBoolTeste())?> />
				Campo Bool</label>
				<p>
				<label>Campo Date:</label>
				<input type="text" name="campoDate" id="campoDate" value="<?php echo $Teste -> get_campoDateTeste()?>" class="required data" />
				<span class="placeholder" >Campo obrigatório</span></p>
		
				<p>
				<label>Campo Double:</label>
				<input type="text" name="campoDouble" id="campoDouble" value="<?php echo $Teste -> get_campoDoubleTeste()?>" class="required numeric" />
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