<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Pergunta = new Pergunta();

$idTabela = "tb_pergunta";
$campos = array("P.id", "P.pergunta_id", "P.empresa_id", "P.idioma_id", "P.nivelPergunta_id", "P.categoriaPergunta_id", "P.enunciado", "P.tempoResposta", "P.inativo", );

$url = "?";
$caminho = CAM_VIEW."pergunta/";
$atualizar = CAM_VIEW."pergunta/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idPergunta = Uteis::escapeRequest($_REQUEST["idPergunta"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Pergunta -> tabelaPergunta_html(" WHERE P.id = $idPergunta", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE P.excluido = 0";

$pergunta_id = implode(",", $_POST['pergunta_id']);
if( $pergunta_id ) $where .= " AND P.pergunta_id IN(".Uteis::escapeRequest($pergunta_id).")";

$empresa_id = implode(",", $_POST['empresa_id']);
if( $empresa_id ) $where .= " AND P.empresa_id IN(".Uteis::escapeRequest($empresa_id).")";

$idioma_id = implode(",", $_POST['idioma_id']);
if( $idioma_id ) $where .= " AND P.idioma_id IN(".Uteis::escapeRequest($idioma_id).")";

$nivelPergunta_id = implode(",", $_POST['nivelPergunta_id']);
if( $nivelPergunta_id ) $where .= " AND P.nivelPergunta_id IN(".Uteis::escapeRequest($nivelPergunta_id).")";

$categoriaPergunta_id = implode(",", $_POST['categoriaPergunta_id']);
if( $categoriaPergunta_id ) $where .= " AND P.categoriaPergunta_id IN(".Uteis::escapeRequest($categoriaPergunta_id).")";

$status = implode(",", $_POST['status']);
if( $status != "" ) $where .= " AND P.inativo IN(".Uteis::escapeRequest($status).")";
//echo $where;
?>

<fieldset>
  <legend>Pergunta</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_pergunta')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Pergunta", "Empresa", "ioma", "Nivel Pergunta", "Categoria Pergunta", "Enunciado", "Tempo Resposta", "Inativo", ""));
		echo $Pergunta -> tabelaPergunta_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
