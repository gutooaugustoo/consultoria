<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$Servico_avaliador = new Servico_avaliador();
if ($idServico_avaliador = $_REQUEST["idServico_avaliador"]) {
  $Servico_avaliador -> __construct($idServico_avaliador);
} else {
  $Servico_avaliador -> set_servico_idServico_avaliador($_REQUEST["servico_id"]);
}

$nomeTable = "servico_avaliador";
$acao = CAM_VIEW . "servico_avaliador/acao.php";
?>
<fieldset>
  <legend>
    Avaliador vínculado ao serviço
  </legend>

  <img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
  onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

  <div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

    <form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

      <input type="hidden" id="acao" name="acao" value="cadastrar" />

      <div class="esquerda">

        <input type="hidden" id="idServico_avaliador" name="idServico_avaliador" value="<?php echo $Servico_avaliador -> get_idServico_avaliador() ?>" />
        <input type="hidden" id="servico_id" name="servico_id" value="<?php echo $Servico_avaliador -> get_servico_idServico_avaliador() ?>" />

        <p>
          <label>Avaliador:</label>
          <?php $Avaliador = new Avaliador();
            Html::set_cssClass(array("required"));
            echo $Avaliador -> selectAvaliador_html('avaliador_id', $Servico_avaliador -> get_avaliador_idServico_avaliador());
          ?>
          <span class="placeholder" >Campo obrigatório</span>
        </p>
        
        <p>
        <label>Valor (R$):</label>
        <input type="text" name="valor" id="valor" value="<?php echo $Servico_avaliador -> get_valorServico_avaliador()?>" class="required numeric" />
        <span class="placeholder" >Campo obrigatório</span></p>
    
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