<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Funcionario = new Funcionario();

$idTabela = "tb_funcionario";
$campos = array("F.id", );

$url = "?";
$caminho = CAM_VIEW."funcionario/";
$atualizar = CAM_VIEW."funcionario/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idFuncionario = Uteis::escapeRequest($_REQUEST["idFuncionario"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Funcionario -> tabelaFuncionario_html(" WHERE F.id = $idFuncionario", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where .= " WHERE 1 ";

$status = implode(",", $_POST['status']);
if( $status != "" ) $where .= " AND P.inativo IN(".Uteis::escapeRequest($status).")";

//echo $where;
?>

<fieldset>
  <legend>Funcionario</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_funcionario')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", "Documento", "Status", ""));
		echo $Funcionario -> tabelaFuncionario_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
