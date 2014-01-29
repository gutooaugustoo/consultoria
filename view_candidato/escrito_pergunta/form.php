<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/includes.php");

$servico_candidato_id = $_SESSION['servico_candidato_id'];
$escrito_id = $_REQUEST["escrito_id"];
$candidato_escrito_id = $_REQUEST["candidato_escrito_id"];

$nomeTable = "escrito_pergunta";
$acao = CAM_VIEW . "escrito_pergunta/acao.php";

$where = " WHERE E.escrito_id = " . Uteis::escapeRequest($escrito_id) . " AND E.excluido = 0 
AND E.id NOT IN( 
  SELECT PV.escrito_pergunta_id FROM perguntaVisualizada AS PV WHERE PV.escrito_pergunta_id = E.id
)
ORDER BY ordem ASC ";
$Escrito_pergunta = new Escrito_pergunta($where);

$where = " WHERE excluido = 0 AND escrito_pergunta_id = " . $Escrito_pergunta -> get_idEscrito_pergunta() . " AND candidato_escrito_id = " . Uteis::escapeRequest($candidato_escrito_id);
$Perguntavisualizada = new Perguntavisualizada($where);
if ($Perguntavisualizada -> get_idPerguntavisualizada()) {
  Uteis::alertJava("Essa questão não está mais disponível para visualização");
  Uteis::fecharNivel();
}

$Pergunta = new Pergunta($Escrito_pergunta -> get_pergunta_idEscrito_pergunta());

$where_resp = " WHERE excluido = 0 AND escrito_pergunta_id = " . $Escrito_pergunta -> get_idEscrito_pergunta() . " AND candidato_escrito_id = " . Uteis::escapeRequest($candidato_escrito_id);
$temResposta = false;

switch ($Pergunta->get_tipoPergunta_idPergunta()) {
  case '1' :
    $Opcao_resp = new Resp_alternativacorreta();
    $Resposta = new Resposta_escrito_alternativacorreta($where_resp);    
    $temResposta = $Resposta -> get_idResposta_escrito_alternativacorreta();
    break;

  case '2' :
    $Opcao_resp = new Resp_verdadeirofalso();
    $Resposta = new Resposta_escrito_verdadeirofalso($where_resp);
    $temResposta = $Resposta -> get_idResposta_escrito_verdadeirofalso();
    break;

  case '3' :
    $Opcao_resp = new Resp_associeresposta();
    $Resposta = new Resposta_escrito_associeresposta($where_resp);
    $temResposta = $Resposta -> get_idResposta_escrito_associeresposta();
    break;

  case '4' :
    $Opcao_resp = new Resp_preenchelacuna();
    break;

  case '5' :
    //
    break;
}

if ($temResposta)
  Uteis::alertJava('Ja tem resposta');

Uteis::timer("#formCad_$nomeTable #timer", Uteis::gravarHoras($Pergunta -> get_tempoRespostaPergunta()));
?>
<fieldset>
	<legend>
	  <?php echo $Escrito_pergunta -> get_ordemEscrito_pergunta(); ?>ª questão
  </legend>

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">
  	
		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >
		  
		  <div class="menu_interno" id="timer" style="font-size: 16px"></div>
		  
		  <input type="hidden" name="tipoPergunta" value="<?php echo $Pergunta->get_tipoPergunta_idPergunta()?>" />
		  <input type="hidden" name="escrito_pergunta_id" value="<?php echo $Escrito_pergunta->get_idEscrito_pergunta()?>" />
		  <input type="hidden" name="candidato_escrito_id" value="<?php echo $candidato_escrito_id?>" />
		  
		  
		 <div class="linha-inteira">
		    <p><?php echo $Pergunta -> get_tituloPergunta(); ?></p>			  
		    <?php if( $Pergunta->get_enunciadoPergunta() ) echo "<p>".$Pergunta->get_enunciadoPergunta()."</p>" ?>
			</div>
			
			<div class="linha-inteira">
			  <?php echo $Opcao_resp -> montarRespostas_html($Pergunta -> get_idPergunta()); ?>
			</div>
			
			<div class="linha-inteira">
				<p><button class="button blue" onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')">Salvar resposta</button>
				</p>
			</div>
		</form>
	
	</div>
</fieldset>
<script>

  var check =   '#formCad_<?php echo $nomeTable ?> .sortable input[type=checkbox]';		
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
  var c = 0;
	var check2 = '#formCad_<?php echo $nomeTable ?> .sortable2 input[type=checkbox]';    
	$('body').off('click', check2).on('click', check2, function(){   
    
    var o = $(this);
    var o_check = $(check+':checked');
    var id = o.attr('id');
        
    var html1 = o_check.find('~span');
    var html2 = o.find('~span');
      
    var divBase1 = $('<div>'+(++c)+')  </div>').addClass('destaca_verde').append(html1);        
    var divBase2 = $('<div>'+(c)+')  </div>').addClass('destaca_verde').append(html2);
    
    var imgSeta = '<img src="<?php echo CAM_IMG?>seta.png" />';
    var divAdd1 = $('<div>a</div>').html(imgSeta);
        
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
  
  //$(check).first().click();
  //$(check2).first().click();
  
</script> 

<?php
exit ;
if (!$Perguntavisualizada -> get_idPerguntavisualizada()) {
  $post = array("candidato_escrito_id" => $candidato_escrito_id, "escrito_pergunta_id" => $Escrito_pergunta -> get_idEscrito_pergunta(), );
  $rs = $Perguntavisualizada -> cadastrarPerguntavisualizada("", $post);

  if ($rs[0] == false) {
    Uteis::fecharNivel();
    Uteis::alertJava("Não é possível responder essa questão");
  }
}
?>


