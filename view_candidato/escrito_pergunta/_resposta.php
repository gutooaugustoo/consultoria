<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
  
  <div id="timer" ></div>
  
  <div class="linha-inteira">
    <p><b><?php echo $Escrito_pergunta -> get_ordemEscrito_pergunta().") ". $Pergunta -> get_tituloPergunta(); ?></b></p>       
    <?php if( $Pergunta->get_enunciadoPergunta() ) echo "<div class=\"textoAux\" >".$Pergunta->get_enunciadoPergunta()."</div>" ?>
  </div>
    
  <div id="divRespostas" class="linha-inteira">
    <?php echo $Opcao_resp -> montarRespostas_html($Pergunta -> get_idPergunta()); ?>
  </div>
      
  <input type="hidden" name="tipoPergunta" value="<?php echo $Pergunta->get_tipoPergunta_idPergunta()?>" />
  <input type="hidden" name="escrito_pergunta_id" value="<?php echo $Escrito_pergunta->get_idEscrito_pergunta()?>" />
  <input type="hidden" name="candidato_escrito_id" value="<?php echo $candidato_escrito_id?>" />
  
  <div class="linha-inteira">
    <p>
      <button class="button blue" onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')">Salvar resposta</button>
    </p>
  </div>
  
</form>
	
