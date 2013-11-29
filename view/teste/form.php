<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idTeste = $_REQUEST["idTeste"];

$Teste = new Teste($idTeste);

$nomeTable = "teste";
$legendForm = " Teste";
$acao = CAM_VIEW."teste/acao.php";
?>

<div id="cadastro_<?php echo $nomeTable ?>" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel(nivel);" title="Fechar"></div>
	<div id="abas">
		<div id="aba_<?php echo $nomeTable ?>" divExibir="div_<?php echo $nomeTable ?>" class="aba_interna ativa"><?php echo $legendForm ?></div>
	</div>
	<div id="modulos_<?php echo $nomeTable ?>" class="conteudo_nivel">
		<div id="div_<?php echo $nomeTable ?>" class="div_aba_interna">
			<fieldset>
				<legend><?php echo $legendForm ?></legend>
				<form id="form_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
          <div class="esquerda">
          
						<input type="hidden" id="acao" name="acao" value="cadastrar" />					
						
					<input type="hidden" id="idTeste" name="idTeste" value="<?php echo $Teste->get_idTeste() ?>" />
		
					<p>
					<label> Campo String:</label>
					<input type="text" name="campoString" id="campoString" value="<?php echo $Teste->get_campoStringTeste()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span></p>
		
					<p>
					<label> Campo Text:</label>
					<textarea name="campoText" id="campoText" cols="60" rows="4" class="required" ><?php echo $Teste->get_campoTextTeste()?></textarea>
					<span class="placeholder" >Campo obrigatório</span></p>
		
					<p>
					<label> Campo Int:</label>
					<input type="text" name="campoInt" id="campoInt" value="<?php echo $Teste->get_campoIntTeste()?>" class="required numeric" />
					<span class="placeholder" >Campo obrigatório</span></p>
		
					<p><label for="campoBool" >
					<input type="checkbox" name="campoBool" id="campoBool" value="1" class=""
					<?php echo Uteis::verificaChecked($Teste->get_campoBoolTeste())?> />
					 Campo Bool:</label>
					<span class="placeholder" >Campo obrigatório</span></p>
		
					<p>
					<label> Campo Date:</label>
					<input type="text" name="campoDate" id="campoDate" value="<?php echo $Teste->get_campoDateTeste()?>" class="required data" />
					<span class="placeholder" >Campo obrigatório</span></p>
		
					<p>
					<label> Campo Double:</label>
					<input type="text" name="campoDouble" id="campoDouble" value="<?php echo $Teste->get_campoDoubleTeste()?>" class="required numeric" />
					<span class="placeholder" >Campo obrigatório</span></p>
		   					
						<p><button class="button blue" 
						onclick="postForm('form_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Enviar</button>
						</p>
					</div>
				</form>
			</fieldset>			
		</div>
	</div>
</div>
<script>ativarForm();</script> 
