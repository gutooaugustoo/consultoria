<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/includes.php");

$Tipoescrito = new Tipoescrito();

$idTabela = "tb_tipoescrito";
$campos = array("T.id", "T.nome", "T.inativo", );

$url = "?";
$caminho = CAM_VIEW."tipoescrito/";
$atualizar = CAM_VIEW."tipoescrito/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idTipoescrito = Uteis::escapeRequest($_REQUEST["idTipoescrito"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Tipoescrito -> tabelaTipoescrito_html(" WHERE T.id = $idTipoescrito", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE T.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Tipo de teste escrito</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", "Inativo", ""));
		echo $Tipoescrito -> tabelaTipoescrito_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
