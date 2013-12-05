<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Empresa = new Empresa();

$idTabela = "tb_empresa";
$campos = array("E.id", "E.razaoSocial", "E.nomeFantasia", "E.cnpj", "E.logo", "E.ie", "E.inativo", );

$url = "?";
$caminho = CAM_VIEW."empresa/";
$atualizar = CAM_VIEW."empresa/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idEmpresa = Uteis::escapeRequest($_REQUEST["idEmpresa"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Empresa -> tabelaEmpresa_html(" WHERE E.id = $idEmpresa", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE E.excluido = 0";

$status = implode(",", $_POST['status']);
if( $status != "" ) $where .= " AND E.inativo IN(".Uteis::escapeRequest($status).")";
//echo $where;
?>

<fieldset>
  <legend>Empresa</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_empresa')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Razao Social", "Nome Fantasia", "CNPJ", "Status", ""));
		echo $Empresa -> tabelaEmpresa_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
