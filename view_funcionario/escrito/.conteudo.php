<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Etapa = new Etapa();

$servico_id = $_REQUEST["servico_id"];
$Servico = new Servico($_REQUEST["servico_id"] );

$ondeAtualizar = "#div_servico";
$atualizar = CAM_VIEW."servico/conteudo.php?servico_id=".$servico_id;

$idTabela = "tb_etapa";
Html::set_idTabela($idTabela);

?>

<fieldset>
  <legend>Conteúdoaa</legend>
  
  <div class="lista">
    <?php //IMPRIMIR TABELA   
    Html::set_colunas(array("Etapaaa", ""));
    echo $Etapa -> tabelaEtapa_html($Servico, $atualizar, $ondeAtualizar);
    ?>
  </div>
  
  <script>
  tabelaDataTable('<?php echo $idTabela?>', 'simples');
  </script>
            
</fieldset>