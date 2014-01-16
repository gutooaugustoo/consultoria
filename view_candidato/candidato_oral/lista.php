<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Candidato_oral = new Candidato_oral();

$idTabela = "tb_candidato_oral";

$url = "?";
$caminho = CAM_VIEW."candidato_oral/";
$atualizar = CAM_VIEW."candidato_oral/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idCandidato_oral = Uteis::escapeRequest($_REQUEST["idCandidato_oral"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Candidato_oral -> tabelaCandidato_oral_html(" WHERE C.id = $idCandidato_oral", $caminho, $atualizar, $ondeAtualizar, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE C.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Candato Oral</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Servico Candato", "Servico Avaliador", ""));
		echo $Candidato_oral -> tabelaCandidato_oral_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
