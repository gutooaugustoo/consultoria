<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/admin.php");

$Endereco = new Endereco();

if ($idEndereco = $_REQUEST["idEndereco"]) {
	$Endereco -> __construct($idEndereco);
} else {
	$Endereco -> set_pessoa_idEndereco($_REQUEST["pessoa_id"]);
	$Endereco -> set_empresa_idEndereco($_REQUEST["empresa_id"]);
}

$nomeTable = "endereco";
$acao = CAM_VIEW . "endereco/acao.php";
?>
<fieldset>
	<legend>
		Endereço
	</legend>

	<img src="<?php echo CAM_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="imgGrupoForm_<?php echo $nomeTable ?>"
	onclick="abrirFormulario('divGrupoForm_<?php echo $nomeTable ?>', 'imgGrupoForm_<?php echo $nomeTable ?>');" />

	<div class="agrupa" id="divGrupoForm_<?php echo $nomeTable ?>">

		<form id="formCad_<?php echo $nomeTable ?>" class="validate" method="post" onsubmit="return false" >

			<input type="hidden" id="acao" name="acao" value="cadastrar" />

			<div class="esquerda">

				<input type="hidden" id="idEndereco" name="idEndereco" value="<?php echo $Endereco -> get_idEndereco() ?>" />

				<input type="hidden" id="pessoa_id" name="pessoa_id" value="<?php echo $Endereco -> get_pessoa_idEndereco() ?>" />
				<input type="hidden" id="empresa_id" name="empresa_id" value="<?php echo $Endereco -> get_empresa_idEndereco() ?>" />

				<p>
					<label>Rua, Avenida, etc:</label>
					<input type="text" name="rua" id="rua" value="<?php echo $Endereco -> get_ruaEndereco()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Bairro:</label>
					<input type="text" name="bairro" id="bairro" value="<?php echo $Endereco -> get_bairroEndereco()?>" class="required" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Numero:</label>
					<input type="text" name="numero" id="numero" value="<?php echo $Endereco -> get_numeroEndereco()?>" class="required numeric" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

				<p>
					<label>Cep:</label>
					<input type="text" name="cep" id="cep" value="<?php echo $Endereco -> get_cepEndereco()?>" class="required cep" />
					<span class="placeholder" >Campo obrigatório</span>
				</p>

			</div>

			<div class="direita">

				<p>
					<label>Pais:</label>
					<?php $Pais = new Pais();
					Html::set_cssClass(array("required"));
					Html::set_eventos(array("onchange" => "verificaPais()"));
					echo $Pais -> selectPais_html('pais_id', $Endereco -> get_pais_idEndereco());
					?>
					<span class="placeholder" >Campo obrigatório</span>
				</p>
				
				<div id="divEnderecoEstadoCidade" class="off" >
					<p>
						<label>Estado:</label>
						<?php 
						$Cidade = new Cidade( $Endereco -> get_cidade_idEndereco() );						
						$Uf = new Uf();						
						Html::set_eventos(array("onchange" => "verificaEstado()"));
						echo $Uf -> selectUf_html('uf_id', $Cidade->get_uf_idCidade() );
						?>
						<span class="placeholder" ></span>
					</p>
					<p id="divEnderecoCidade" >						
					</p>
					
				</div>
				
				<p id="divEnderecoCidadeEstrangeira" class="off">
					<label>Cidade de outro país:</label>
					<input type="text" name="cidadeEstrangeira" id="cidadeEstrangeira" value="<?php echo $Endereco -> get_cidadeEstrangeiraEndereco()?>" class="" />
					<span class="placeholder" ></span>
				</p>

				<p>
					<label>Complemento:</label>
					<input type="text" name="complemento" id="complemento" value="<?php echo $Endereco -> get_complementoEndereco()?>" class="" />
					<span class="placeholder" ></span>
				</p>

			</div>

			<div class="linha-inteira">
				<p>
					<button class="button blue"
					onclick="postForm('formCad_<?php echo $nomeTable ?>', '<?php echo $acao?>')" >
						Enviar
					</button>
				</p>
			</div>
		</form>

	</div>
</fieldset>
<script>
ativarForm();
	
function verificaPais(){	
	var o = $('#formCad_<?php echo $nomeTable ?> #pais_id');
	//alert(o.val()); 
	if( o.val() == '<?php echo ID_PAIS?>'){
		$('#divEnderecoEstadoCidade').removeClass('off');
		$('#divEnderecoCidadeEstrangeira').addClass('off');
		verificaEstado();		
	}else{
		$('#divEnderecoCidadeEstrangeira').removeClass('off');
		$('#divEnderecoEstadoCidade').addClass('off');		
		
	}
}

function verificaEstado(){
	var o = $('#formCad_<?php echo $nomeTable ?> #uf_id');	
	var param = '&acao=carregarCidade&idCidade=<?php echo $Endereco->get_cidade_idEndereco()?>&uf_id='+o.val();
	postForm('', '<?php echo CAM_VIEW."endereco/acao.php"?>', param, '#divEnderecoCidade');
}

verificaPais();
</script>
