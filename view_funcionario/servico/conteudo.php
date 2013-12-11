<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Servico = new Servico($_REQUEST["servico_id"] );
  
if( $Servico->get_temEscritoServico() ){
  include_once "../escrito/lista.php"; 
}    

if( $Servico->get_temOralServico() ){
  include_once "../oral/lista.php"; 
}  

if( $Servico->get_temRedacaoServico() ){
  include_once "../redacao/lista.php"; 
}

if( $Servico->get_temResultadoFinalServico() ){
}
exit;

$Servico = new Servico();

$idTabela = "tb_itensServico";

$servico_id = $_REQUEST["servico_id"];
$url = "?servico_id=".$servico_id;

$ondeAtualizar = "div_servico";  

Html::set_idTabela($idTabela);

/*if( $_REQUEST["tr"] == "1" ){
  //ATUALIZAR APENAS A LINHA
  $idEscrito = Uteis::escapeRequest($_REQUEST["idEscrito"]);  
  $ordem = $_REQUEST["ordem"];
    
  $arrayRetorno["updateTr"] = $Escrito -> tabelaEscrito_html(" WHERE E.id = $idEscrito", $caminho, $atualizar, $ondeAtualizar, $ordem);
  $arrayRetorno["tabela"] = $idTabela;
  $arrayRetorno["ordem"] = $ordem;
  
  echo json_encode($arrayRetorno);
  exit;   
  
}*/

//FILTROS
//$where = " WHERE E.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Conteúdo</legend>
  
  <div class="lista">
    <?php //IMPRIMIR TABELA   
    Html::set_colunas(array("Etapa", ""));
    echo $Servico -> tabelaConteudo_html($servico_id);
    ?>
  </div>
  
  <script>
  tabelaDataTable('<?php echo $idTabela?>', 'simples');
  </script>
            
</fieldset>