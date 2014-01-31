<p><b><?php echo $Escrito_pergunta -> get_ordemEscrito_pergunta() . ") " . $Pergunta -> get_tituloPergunta(); ?></b></p> 

<div class="linha-inteira textoAux" >       
  <?php if( $Pergunta->get_enunciadoPergunta() ) echo "<p>".$Pergunta->get_enunciadoPergunta()."</p>" ?>
</div>

<div id="divRespostas" class="linha-inteira textoAux">

<?php
if( 1 ){
  $Perguntavisualizada -> marcarPergunta(
    array(
      "candidato_escrito_id" => $candidato_escrito_id, 
      "escrito_pergunta_id" => $Escrito_pergunta -> get_idEscrito_pergunta()
    )
  );
}

$where_ep = " WHERE E.excluido = 0 AND E.escrito_id = " . $escrito_id . "  
AND E.id <> ".$Escrito_pergunta -> get_idEscrito_pergunta()." 
AND E.id NOT IN( 
  SELECT PV.escrito_pergunta_id FROM perguntaVisualizada AS PV WHERE PV.escrito_pergunta_id = E.id )
ORDER BY ordem ASC ";
$Escrito_pergunta = new Escrito_pergunta($where_ep);

$Pergunta->__construct($Escrito_pergunta -> get_pergunta_idEscrito_pergunta());

$Opcao_resp = $Pergunta -> ver_objetoResposta();

include_once $Pergunta -> ver_includeResposta();

?>

</div>

