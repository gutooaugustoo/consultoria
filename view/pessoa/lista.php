<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idPessoa = $_REQUEST["idPessoa"];

$Pessoa = new Pessoa();

$caminho = CAM_VIEW."pessoa/";
$atualizar = CAM_VIEW."pessoa/lista.php";
$ondeAtualizar = "tr";	

$idTabela = "tb_pessoa";
$campos = array("P.id", "P.pais_id", "P.tipoDocumentoUnico_id", "P.estadoCivil_id", "P.nome", "P.rg", "P.foto", "P.curriculum", "P.cargo", "P.sexo", "P.senha", "P.documento", "P.inativo", );

Html::set_idTabela($idTabela);

if( $_REQUEST["tr"] == "1" ){
	
	$arrayRetorno = array();
	
	$ordem = $_REQUEST["ordem"];
		
	$arrayRetorno["updateTr"] = $Pessoa -> tabelaPessoa_html(" WHERE id = $idPessoa", $caminho, $atualizar, $ondeAtualizar, $campos, $ordem);
	$arrayRetorno["tabela"] = $idTabela;
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
	
}

$where = " WHERE P.excluido = 0";

	$pais_id = implode(",", $_POST['pais_id']);
	if( $pais_id ) $where .= " AND P.pais_id IN(".$pais_id.")";
	
	$tipoDocumentoUnico_id = implode(",", $_POST['tipoDocumentoUnico_id']);
	if( $tipoDocumentoUnico_id ) $where .= " AND P.tipoDocumentoUnico_id IN(".$tipoDocumentoUnico_id.")";
	
	$estadoCivil_id = implode(",", $_POST['estadoCivil_id']);
	if( $estadoCivil_id ) $where .= " AND P.estadoCivil_id IN(".$estadoCivil_id.")";
	
$colunas = array("Pais", "Tipo Documento Unico", "Estado Civil", "Nome", "Rg", "Foto", "Curriculum", "Cargo", "Sexo", "Senha", "Documento", "Inativo", "");

Html::set_colunas($colunas);
$corpoTabela = $Pessoa -> tabelaPessoa_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);

?>

<fieldset>
  <legend>Pessoa</legend>
  
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
		onclick="abrirNivelPagina(this, '<?php echo $caminho."form.php"?>', 'click', '#btFiltro_pessoa')" /> 
  </div>
  
  <div class="lista">
		<?php echo $corpoTabela;?>
	</div>
	
	<script>
	tabelaDataTable('<?php echo $idTabela?>', '');
	</script>
	   	      
</fieldset>
