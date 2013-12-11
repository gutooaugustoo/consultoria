<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Pergunta = new Pergunta();

$tipoPergunta_id = $_REQUEST['tipoPergunta_id'];
$Tipopergunta = new Tipopergunta($tipoPergunta_id);

$idTabela = "tb_pergunta";

$url = "?tipoPergunta_id=".$tipoPergunta_id;
$caminho = CAM_VIEW."pergunta/";
$atualizar = CAM_VIEW."pergunta/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idPergunta = Uteis::escapeRequest($_REQUEST["idPergunta"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Pergunta -> tabelaPergunta_html(" WHERE P.id = $idPergunta", $caminho, $atualizar, $ondeAtualizar, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE P.excluido = 0 AND P.pergunta_id IS NULL AND P.tipoPergunta_id = ".$tipoPergunta_id;

$empresa_id = implode(",", Uteis::escapeRequest($_POST['empresa_id']));
if( $empresa_id ) $where .= " AND P.empresa_id IN(".($empresa_id).")";

$idioma_id = implode(",", Uteis::escapeRequest($_POST['idioma_id']));
if( $idioma_id ) $where .= " AND P.idioma_id IN(".($idioma_id).")";

$nivelPergunta_id = implode(",", Uteis::escapeRequest($_POST['nivelPergunta_id']));
if( $nivelPergunta_id ) $where .= " AND P.nivelPergunta_id IN(".($nivelPergunta_id).")";

$categoriaPergunta_id = implode(",", Uteis::escapeRequest($_POST['categoriaPergunta_id']));
if( $categoriaPergunta_id ) $where .= " AND P.categoriaPergunta_id IN(".($categoriaPergunta_id).")";

$status = implode(",", Uteis::escapeRequest($_POST['status']));
if( $status != "" ) $where .= " AND P.inativo IN(".($status).")";

//echo $where;
?>

<fieldset>
  <legend>Pergunta - <?php echo $Tipopergunta->get_descricaoTipopergunta();?></legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."abas.php".$url?>', 'click', '#btFiltro_pergunta')" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Enunciado", "Idioma", "Nível", "Categoria", "Empresa", "Status", ""));
		echo $Pergunta -> tabelaPergunta_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
