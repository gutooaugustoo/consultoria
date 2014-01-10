<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php");

$Pergunta = new Pergunta();

if ($idPergunta = $_REQUEST["idPergunta"]) {
  $Pergunta -> __construct($idPergunta);
  $tipoPergunta_id = $Pergunta -> get_tipoPergunta_idPergunta();
  $pergunta_id = $Pergunta -> get_pergunta_idPergunta();
} else {
  $tipoPergunta_id = $_REQUEST['tipoPergunta_id'];
  $pergunta_id = $_REQUEST['pergunta_id'];
}

$url = "&tipoPergunta_id=" . $tipoPergunta_id;

$nomeTable = "pergunta";
$acao = CAM_VIEW . "pergunta/acao.php";
?>
<fieldset>
	<legend> 
	  <?php $Tipopergunta = new Tipopergunta($tipoPergunta_id);
    echo $Tipopergunta -> get_descricaoTipopergunta();
 ?></legend>
	
	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>" 
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <input type="hidden" id="acao" name="acao" value="cadastrar" />
		  <input type="hidden" id="idPergunta" name="idPergunta" value="<?php echo $Pergunta -> get_idPergunta() ?>" />
		  
		  <input type="hidden" id="tipoPergunta_id" name="tipoPergunta_id" value="<?php echo $tipoPergunta_id?>" />
		  <input type="hidden" id="pergunta_id" name="pergunta_id" value="<?php echo $pergunta_id?>" /> <!--PERGUNTA PAI-->
		  		  		
		  <div class="linha-inteira">
		  	
		  	<p>					  	
					<label>Enunciado (não numere o enunciado):</label>
					<input type="text" name="titulo" id="titulo" value="<?php echo $Pergunta -> get_tituloPergunta()?>" class="required textoGrande" />
					<span class="placeholder" >Campo obrigatório (não numere o enunciado)</span>
				</p>
						
				<p><label>Complemento:</label>	
					<textarea name="enunciado_base" id="enunciado_base" cols="100" rows="8" ><?php echo $Pergunta -> get_enunciadoPergunta()?></textarea>
					<textarea name="enunciado" id="enunciado" class="<?php echo ( $tipoPergunta_id == "4" ) ? "required" : ""?>" ></textarea>
					<span class="placeholder" >Campo obrigatório</span>								
				</p>
			</div>	
			
			<div class="esquerda">
				
				<?php //SE PERTENCER A OUTRA PERGUNTA, SEGUE A REGRA DA PERGUNTA PAI
				$Idioma = new Idioma();
        $Nivelpergunta = new Nivelpergunta();
        $Categoriapergunta = new Categoriapergunta();
        
				if( !$pergunta_id ){?>
					<p>
						<label>Idioma (em que está escrita a pergunta):</label>
						<?php
            Html::set_cssClass(array("required"));
            echo $Idioma -> selectIdioma_html('idioma_id', $Pergunta -> get_idioma_idPergunta());
						?>
						<span class="placeholder" >Campo obrigatório</span>
					</p>
	
					<p>
						<label>Nível Pergunta:</label>
						<?php
            Html::set_cssClass(array("required"));
            echo $Nivelpergunta -> selectNivelpergunta_html('nivelPergunta_id', $Pergunta -> get_nivelPergunta_idPergunta());
						?>
						<span class="placeholder" >Campo obrigatório</span>
					</p>
					<p>
						<label>Categoria Pergunta:</label>
						<?php
            Html::set_cssClass(array("required"));
            echo $Categoriapergunta -> selectCategoriapergunta_html('categoriaPergunta_id', $Pergunta -> get_categoriaPergunta_idPergunta());
						?>
						<span class="placeholder" >Campo obrigatório</span>
					</p>
				<?php }else{ 
				  $Pergunta_pai = new Pergunta($pergunta_id);?>
				  <p>
            <label>Idioma (em que está escrita a pergunta):</label>
            <input type="hidden" id="idioma_id" name="idioma_id" value="<?php echo $Pergunta_pai -> get_idioma_idPergunta() ?>" />
            <?php $Idioma -> __construct($Pergunta_pai -> get_idioma_idPergunta());
            echo $Idioma -> get_nomeIdioma(); ?>
          </p>
          <p>
            <label>Nível Pergunta:</label>
            <input type="hidden" id="nivelPergunta_id" name="nivelPergunta_id" value="<?php echo $Pergunta_pai -> get_nivelPergunta_idPergunta() ?>" />
            <?php $Nivelpergunta -> __construct( $Pergunta_pai -> get_nivelPergunta_idPergunta());
            echo $Nivelpergunta -> get_nomeNivelpergunta(); ?>
          </p>
          <p>
            <label>Categoria Pergunta:</label>
            <input type="hidden" id="categoriaPergunta_id" name="categoriaPergunta_id" value="<?php echo $Pergunta_pai -> get_categoriaPergunta_idPergunta() ?>" />
            <?php $Categoriapergunta -> __construct($Pergunta_pai -> get_categoriaPergunta_idPergunta());
            echo $Categoriapergunta -> get_nomeCategoriapergunta(); ?>
          </p>
				<?php } ?>
				
			</div>

			<div class="direita">

				<?php 
				//AGRUPAMENTO NAO PRECISA DE TEMPO
				if( $tipoPergunta_id != "5" ){?>		
				<p>
					<label>Tempo para responder (mm:ss):</label>
					<input type="text" name="tempoResposta" id="tempoResposta" value="<?php echo $Pergunta -> get_tempoRespostaPergunta()?>" class="required hora" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>
				<?php } ?>
				
				<?php //SE PERTENCER A OUTRA PERGUNTA, SEGUE A REGRA DA PERGUNTA PAI 
				if( !$Pergunta->get_pergunta_idPergunta() ){?>								
				<p>
					<label>Exclusiva para a empresa (deixe em branco caso não seja exclusiva):</label>
					<?php $Empresa = new Empresa();
            echo $Empresa -> selectEmpresa_html('empresa_id', $Pergunta -> get_empresa_idPergunta());
					?>
					<span class="placeholder" ></span>
				</p>
				<?php } ?>	
				<p>
					<label for="inativo" >
						<input type="checkbox" name="inativo" id="inativo" value="1" class=""
						<?php echo Uteis::verificaChecked($Pergunta -> get_inativoPergunta())?>
						/>
						Inativo:</label>
					<span class="placeholder" >Campo obrigatório</span>
				</p>

			</div>
			
			<div class="linha-inteira">
				<p><button class="button blue" 
				onclick="postForm_editor('enunciado', 'formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >Enviar</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>

<script>
	ativarForm();
	viraEditor('enunciado');
</script> 