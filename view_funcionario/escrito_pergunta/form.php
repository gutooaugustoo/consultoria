<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$Escrito_pergunta = new Escrito_pergunta();

if ($idEscrito_pergunta = $_REQUEST["idEscrito_pergunta"]) {
  $Escrito_pergunta -> __construct($idEscrito_pergunta);
} else {
  $tipoPergunta_id = $_REQUEST['tipoPergunta_id'];
  $Escrito_pergunta -> set_escrito_idEscrito_pergunta($_REQUEST["escrito_id"]) -> set_ordemEscrito_pergunta($Escrito_pergunta -> get_proximaOrdem());
}

$nomeTable = "escrito_pergunta";
$acao = CAM_VIEW . "escrito_pergunta/acao.php";
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
		  
		  <div class="esquerda">		  					
				
				<input type="hidden" id="idEscrito_pergunta" name="idEscrito_pergunta" value="<?php echo $Escrito_pergunta -> get_idEscrito_pergunta() ?>" />
		    <input type="hidden" id="escrito_id" name="escrito_id" value="<?php echo $Escrito_pergunta -> get_escrito_idEscrito_pergunta() ?>" />
        
        <p>
          <label>Ordem:
          <b><?php echo $Escrito_pergunta -> get_ordemEscrito_pergunta(); ?></b></label>          
        </p>
        
				<p>
				<label>Enunciado pergunta:</label>
				<?php 				            
          $Pergunta = new Pergunta();
          //PEGAR ID EMPRESA E MONTAR WHERE
          $Escrito = new Escrito($Escrito_pergunta -> get_escrito_idEscrito_pergunta());
          $Servico = new Servico($Escrito -> get_servico_idEscrito());
          $where = " WHERE (P.empresa_id IS NULL OR P.empresa_id = " . $Servico -> get_empresa_idServico() . ") 
          AND P.pergunta_id IS NULL AND P.inativo = 0 AND P.tipoPergunta_id = " . $tipoPergunta_id;
          
          Html::set_eventos(array("onchange"=>"getComplemento()"));
          Html::set_cssClass(array("required"));
          echo $Pergunta -> selectPergunta_html('pergunta_id', $Escrito_pergunta -> get_pergunta_idEscrito_pergunta(), $where);
        ?>
				<span class="placeholder" >Campo obrigatório</span></p>
				
			</div>
			
			<div class="direita" > 
			  <p>
          <label>Complemento:</label>
          <div id="complemento" ></div>
        </p>
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
ativarForm();

function getComplemento(){
  var o = $('#formCad_<?php echo $nomeTable ?> #pergunta_id');
  postForm('', '<?php echo CAM_VIEW . "escrito_pergunta/acao.php"?>', '&acao=getComplemento&onde=#formCad_<?php echo $nomeTable ?> #complemento&id='+o.val())
}
</script> 