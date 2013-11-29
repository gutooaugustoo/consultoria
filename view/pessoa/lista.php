<?php
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$idPessoa = $_REQUEST["idPessoa"];

$Pessoa = new Pessoa();

$idTabela = "tb_pessoa";
$campos = array("id", "pais_id", "tipoDocumentoUnico_id", "estadoCivil_id", "nome", "rg", "foto", "curriculum", "cargo", "sexo", "senha", "documento", "inativo", );

$caminho = CAM_VIEW."pessoa/";
$atualizar = CAM_VIEW."pessoa/lista.php";
$ondeAtualizar = "tr";	

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

$colunas = array("Pais", "Tipo Documento Unico", "Estado Civil", "Nome", "Rg", "Foto", "Curriculum", "Cargo", "Sexo", "Senha", "Documento", "Inativo", "");

$where .= " WHERE excluido = 0";

Html::set_colunas($colunas);
$corpoTabela = $Pessoa -> tabelaPessoa_html($where, $caminho, $atualizar, $ondeAtualizar, $campos);
?>

<fieldset>
  <legend>Pessoa</legend>
  <div class="menu_interno"> 
  	<img src="<?php echo CAM_IMG."novo.png";?>" title="Novo cadastro" 
	onclick="abrirNivelPagina(this, '<?php echo $caminho."form.php"?>', '<?php echo $atualizar?>', '#centro')" /> 
  </div>
  <div class="lista"> 
  	<?php echo $corpoTabela?>      
  </div>
</fieldset>
<script>
tabelaDataTable('<?php echo $idTabela?>', '');
</script> 
