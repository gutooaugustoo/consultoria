<div id="timer"></div>

<div class="linha-inteira">
  <p><b><?php echo $Escrito_pergunta -> get_ordemEscrito_pergunta().") ". $Pergunta -> get_tituloPergunta(); ?></b></p>       
  <?php if( $Pergunta->get_enunciadoPergunta() ) echo "<div class=\"textoAux\" >".$Pergunta->get_enunciadoPergunta()."</div>" ?>
</div>
  
<div id="divRespostas" class="validate esquerda">
  <?php echo $Opcao_resp -> montarRespostas_html($Pergunta -> get_idPergunta()); ?>
</div>
 
<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
  
  <input type="hidden" name="tipoPergunta" value="<?php echo $Pergunta->get_tipoPergunta_idPergunta()?>" />
  <input type="hidden" name="escrito_pergunta_id" value="<?php echo $Escrito_pergunta->get_idEscrito_pergunta()?>" />
  <input type="hidden" name="candidato_escrito_id" value="<?php echo $candidato_escrito_id?>" />
  
  <div id="chooses" class="esquerda" >
    <p><label>Itens seleciondos:</label></p>     
    <div class="esquerda" ></div>
    <div class="direita" ></div>
  </div>
    
  <div class="linha-inteira">
    <p>
      <button class="button blue" onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')">Salvar resposta</button>
    </p>
  </div>
  
</form>

<script>

  var check = '#divRespostas .sortable input[type=checkbox]';		
	var check2 = '#divRespostas .sortable2 input[type=checkbox]';
	var c = 0;
	
	$('body').off('click', check).on('click', check, function(){   
    
    var o = $(this);
    var id = o.attr('id');
    
    $(check).each(function() {    
      if( o.is(':checked') ){        
        if( $(this).attr('id') != id ) $(this).attr('disabled', true);
      }else{
        $(this).attr('disabled', false)    
      }      
    });
    
    $(check2).each(function() {    
      if( o.is(':checked') ){        
        $(this).attr('disabled', false);
      }else{
        $(this).attr({'disabled':true, 'checked':false});    
      }      
    });
         
  });
  
	$('body').off('click', check2).on('click', check2, function(){   
    
    var o = $(this);
    var o_check = $(check+':checked');
    var id = o.attr('id');
        
    var html1 = o_check.find('~span');
    var html2 = o.find('~span');
      
    var divBase1 = $('<div>'+(++c)+')  </div>').addClass('destaca_verde').append(html1);        
    var divBase2 = $('<div>'+(c)+')  </div>').addClass('destaca_verde').append(html2);
    
    //var imgSeta = '<img src="<?php echo CAM_IMG?>seta.png" />';
		//var divAdd1 = $('<div></div>').html(imgSeta);

		$('div#chooses .esquerda').append(divBase1);
		$('div#chooses .direita').append(divBase2);

		$(check2).each(function() {
		  $(this).attr('disabled', true);
		});
		
		$(check).each(function() {
		  $(this).attr('disabled', false);
		});

		o.parent().remove();
		o_check.parent().remove();

	});

	$(check2).each(function() {
	  $(this).attr('disabled', true);
	});

	/*$(check).first().click();	
	$(check2).first().click();
	
	$(check).first().click();
  $(check2).first().click();
  
  $(check).first().click();
  $(check2).first().click();*/
		
</script> 
