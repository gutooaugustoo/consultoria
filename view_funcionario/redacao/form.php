<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Redacao = new Redacao();
if ($idRedacao = $_REQUEST["idRedacao"]) {
  $Redacao -> __construct($idRedacao);
} else {
  $Redacao -> set_servico_idRedacao($_REQUEST["servico_id"]);
  $Redacao -> set_etapa_idRedacao($_REQUEST["etapa_id"]);
}

$nomeTable = "redacao";
$acao = CAM_VIEW . "redacao/acao.php";
?>
<fieldset>
	<legend>
		Redação
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idRedacao" name="idRedacao" value="<?php echo $Redacao -> get_idRedacao() ?>" />
				<input type="hidden" id="servico_id" name="servico_id" value="<?php echo $Redacao -> get_servico_idRedacao() ?>" />

				<p>
					<label>Etapa:</label>
					<?php $Etapa = new Etapa($Redacao -> get_etapa_idRedacao());
            echo $Etapa -> get_etapaEtapa();
					?>
					<input type="hidden" id="etapa_id" name="etapa_id" value="<?php echo $Redacao-> get_etapa_idRedacao()?>" />

					<?php /*$Etapa = new Etapa();
   Html::set_cssClass(array("required"));
   echo $Etapa -> selectEtapa_html('etapa_id', $Redacao -> get_etapa_idRedacao()); */
					?>
					<!--<span class="placeholder" >Campo obrigatório</span>-->

				</p>

				<p>
					<label>Tempo para finalizar a redação (mm:ss):</label>
					<input type="text" name="tempoParaFinalizacao" id="tempoParaFinalizacao" value="<?php echo $Redacao -> get_tempoParaFinalizacaoRedacao()?>" class="required hora" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Minimo linhas:</label>
					<input type="text" name="minimoLinhas" id="minimoLinhas" value="<?php echo $Redacao -> get_minimoLinhasRedacao()?>" class="required numeric" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Maximo linhas:</label>
					<input type="text" name="maximoLinhas" id="maximoLinhas" value="<?php echo $Redacao -> get_maximoLinhasRedacao()?>" class="numeric" />
					<span class="placeholder" ></span>
				</p>

				<p>
					<label for="temPlanoAcao" >
						<input type="checkbox" name="temPlanoAcao" id="temPlanoAcao" value="1" class=""
						<?php echo Uteis::verificaChecked( $Redacao->get_temPlanoAcaoRedacao() )?>
						/>
						Haverá <b>plano de açao</b></label>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

			</div>

			<div class="linha-inteira">
				<p>
					<button class="button blue"
					onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >
						Enviar
					</button>
				</p>
			</div>
		</form>

	</div>
</fieldset>
<script>ativarForm();</script>
