<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Candidato = new Candidato();

$idTabela = "tb_candidato";
$campos = array("C.id", );

$url = "?";
$caminho = CAM_VIEW."candidato/";
$atualizar = CAM_VIEW."candidato/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idCandidato = Uteis::escapeRequest($_REQUEST["idCandidato"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Candidato -> tabelaCandidato_html(" WHERE C.id = $idCandidato", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where .= " WHERE P.excluido = 0 ";

$status = implode(",", Uteis::escapeRequest($_POST['status']));
if( $status != "" ) $where .= " AND P.inativo IN(".$status.")";

//echo $where;
?>

<fieldset>
  <legend>Candidato</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_candidato')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", "Documento", "Status", ""));
		echo $Candidato -> tabelaCandidato_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
