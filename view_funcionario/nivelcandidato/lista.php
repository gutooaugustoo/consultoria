<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Nivelcandidato = new Nivelcandidato();

$idTabela = "tb_nivelcandidato";
$campos = array("N.id", "N.nivel", "N.inativo", );

$url = "?";
$caminho = CAM_VIEW."nivelcandidato/";
$atualizar = CAM_VIEW."nivelcandidato/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idNivelcandidato = Uteis::escapeRequest($_REQUEST["idNivelcandidato"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Nivelcandidato -> tabelaNivelcandidato_html(" WHERE N.id = $idNivelcandidato", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE N.excluido = 0";

//echo $where;
?>

<fieldset>
  <legend>Nível candiadato</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nível", "Status", ""));
		echo $Nivelcandidato -> tabelaNivelcandidato_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
