<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Gestor = new Gestor();

$idTabela = "tb_gestor";
$campos = array("G.id", "G.empresa_id", );

$empresa_id = $_REQUEST["empresa_id"];

$url = "?&empresa_id=".$empresa_id;
$caminho = CAM_VIEW."gestor/";
$atualizar = CAM_VIEW."gestor/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idGestor = Uteis::escapeRequest($_REQUEST["idGestor"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Gestor -> tabelaGestor_html(" WHERE G.id = $idGestor", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where .= " WHERE P.excluido = 0 AND G.empresa_id = ".$empresa_id;

//echo $where;
?>

<fieldset>
  <legend>Gestor</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#divLista_res')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", "Documento", "Status", ""));
		echo $Gestor -> tabelaGestor_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
