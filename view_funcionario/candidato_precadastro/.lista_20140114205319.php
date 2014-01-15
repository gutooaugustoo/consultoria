<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/verificar.php");

$Candidato_precadastro = new Candidato_precadastro();

$idTabela = "tb_candidato_precadastro";

$servico_id = $_REQUEST["servico_id"];
$url = "?servico_id=".$servico_id;

$caminho = CAM_VIEW."candidato_precadastro/";
$atualizar = CAM_VIEW."candidato_precadastro/lista.php".$url;
$ondeAtualizar = "tr";	

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	//ATUALIZAR APENAS A LINHA
	$idCandidato_precadastro = Uteis::escapeRequest($_REQUEST["idCandidato_precadastro"]);	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Candidato_precadastro -> tabelaCandidato_precadastro_html(" WHERE C.email = $idCandidato_precadastro", $caminho, $atualizar, $ondeAtualizar, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

//FILTROS
$where = " WHERE C.excluido = 0 AND C.servico_id = ".Uteis::escapeRequest($servico_id);

//echo $where;
?>

<fieldset>
  <legend>Pré-cadastro de candidatos</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Upload de arquivo excel (CSV)" /> 
  </div>
  
  <div class="lista">
		<?php //IMPRIMIR TABELA		
		Html::set_colunas(array("Nome", "E-mail", ""));
		echo $Candidato_precadastro -> tabelaCandidato_precadastro_html($where, $caminho, $atualizar, $ondeAtualizar);
		?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', 'simples');
	</script>
	   	      
</fieldset>
