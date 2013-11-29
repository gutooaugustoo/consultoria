<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idEstadocivil = $_REQUEST["idEstadocivil"];

$Estadocivil = new Estadocivil($idEstadocivil);

$nomeTable = "estadocivil";
$legendForm = "Estadocivil";
$acao = CAM_VIEW."estadocivil/acao.php";
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
						
						<input type="hidden" id="idEstadocivil" name="idEstadocivil" value="<?php echo $Estadocivil -> get_idEstadocivil() ?>" />
		
						<p>
						<label>Nome:</label>
						<input type="text" name="nome" id="nome" value="<?php echo $Estadocivil -> get_nomeEstadocivil()?>" class="required" />
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
