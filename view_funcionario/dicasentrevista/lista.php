<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Dicasentrevista = new Dicasentrevista();

$idTabela = "tb_dicasentrevista";
$campos = array("D.id", "D.idioma_id", "D.titulo", "D.inativo", "D.dica", );

$url = "?";
$caminho = CAM_VIEW."dicasentrevista/";
$atualizar = CAM_VIEW."dicasentrevista/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idDicasentrevista = Uteis::escapeRequest($_REQUEST["idDicasentrevista"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Dicasentrevista -> tabelaDicasentrevista_html(" WHERE D.id = $idDicasentrevista", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE D.excluido = 0";

$idioma_id = implode(",", Uteis::escapeRequest($_POST['idioma_id']));
if( $idioma_id ) $where .= " AND D.idioma_id IN(".$idioma_id.")";

$status = implode(",", Uteis::escapeRequest($_POST['status']));
if( $status != "" ) $where .= " AND D.inativo IN(".$status.")";
//echo $where;
?>

<fieldset>
  <legend>Dicas de entrevista</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_dicasentrevista')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Titulo", "Idioma", "Status", ""));
		echo $Dicasentrevista -> tabelaDicasentrevista_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
