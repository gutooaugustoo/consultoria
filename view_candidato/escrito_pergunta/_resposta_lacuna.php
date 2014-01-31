<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
  
  <div class="menu_interno" id="timer" style="font-size: 16px"></div>
  
  <div class="linha-inteira">
    <p><?php echo $Pergunta -> get_tituloPergunta(); ?></p>       
  </div>
    
  <div id="divRespostas" class="linha-inteira">
    <p><?php echo $Opcao_resp -> montarRespostas_html($Pergunta); ?></p>
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
	
