<input type="hidden" id="acao" name="acao" value="cadastrar" />
<!-- <input type="hidden" id="idPessoa" name="idPessoa" value="<?php echo $Pessoa -> get_idPessoa() ?>" /> -->

<div class="esquerda" >

	<p>
		<label>Nome:</label>
		<input type="text" name="nome" id="nome" value="<?php echo $Pessoa -> get_nomePessoa()?>" class="required" />
		<span class="placeholder" >Campo obrigatório</span>
	</p>
	<p>
		<label>Email Principal:</label>
		<input type="text" name="emailPrincipal" id="emailPrincipal" value="<?php echo $Pessoa -> get_emailPrincipalPessoa()?>" class="required email" />
		<span class="placeholder" >Campo obrigatório</span>
	</p>
	<p>
		<label>Tipo Documento:</label>
		<?php $Tipodocumentounico = new Tipodocumentounico();
			Html::set_cssClass(array("required"));						
			echo $Tipodocumentounico -> selectTipodocumentounico_html('tipoDocumentoUnico_id', $Pessoa -> get_tipoDocumentoUnico_idPessoa());
		?>
		<span class="placeholder" >Campo obrigatório</span>
	</p>
	<p>
		<label>Número Documento:</label>
		<input type="text" name="documento" id="documento" value="<?php echo $Pessoa -> get_documentoPessoa()?>" class="required" />
		<span class="placeholder" >Campo obrigatório</span>
	</p>

	<p>
		<label>Data Nascimento:</label>
		<input type="text" name="dataNascimento" id="dataNascimento" value="<?php echo $Pessoa -> get_dataNascimentoPessoa()?>" class="required data" />
		<span class="placeholder" >Campo obrigatório</span>
	</p>

	<p>
		<label>Rg:</label>
		<input type="text" name="rg" id="rg" value="<?php echo $Pessoa -> get_rgPessoa()?>" class="rg" />
		<span class="placeholder" ></span>
	</p>
	<p>
		<label>Sexo:</label>
		<?php Html::set_cssClass(array("required"));
		echo Html::selectSexo_html("sexo", $Pessoa -> get_sexoPessoa());
		?>
		<span class="placeholder" >Campo obrigatório</span>
	</p>
	<p>
		<label>Senha:</label>
		<img src="<?php echo CAM_IMG . "senha.png"; ?>" title="GERAR SENHA" onclick="geraSenha('senha', 'rsenha');" />
		<input type="password" name="senha" id="senha" value="<?php echo $Pessoa -> get_senhaPessoa()?>" class="required password" />
		<span class="placeholder" >Campo obrigatório</span>
	</p>

	<p>
		<label>Confirmar Senha:</label>
		<input type="password" name="rsenha" id="rsenha" value="<?php echo $Pessoa -> get_senhaPessoa()?>" class="required password" />
		<span class="placeholder" >Campo obrigatório</span>
	</p>
	
</div>

<div class="direita">

	<p>
		<label>Foto:</label>
		<!--	<input type="text" name="foto" id="foto" value="<?php echo $Pessoa -> get_fotoPessoa()?>" class="" />
		<span class="placeholder" ></span>-->
	</p>

	<p>
		<label>Curriculum:</label>
		<!--<input type="text" name="curriculum" id="curriculum" value="<?php echo $Pessoa -> get_curriculumPessoa()?>" class="" />
		<span class="placeholder" ></span>-->
	</p>
	<p>
		<label>País de origem:</label>
		<?php $Pais = new Pais();
			Html::set_cssClass(array("required"));
			echo $Pais -> selectPais_html('pais_id', $Pessoa -> get_pais_idPessoa());
		?>
		<span class="placeholder" >Campo obrigatório</span>
	</p>

	<p>
		<label>Estado Civil:</label>
		<?php $Estadocivil = new Estadocivil();
			Html::set_cssClass(array("required"));
			echo $Estadocivil -> selectEstadocivil_html('estadoCivil_id', $Pessoa -> get_estadoCivil_idPessoa());
		?>
		<span class="placeholder" >Campo obrigatório</span>
	</p>

	<p>
		<label>Cargo:</label>
		<input type="text" name="cargo" id="cargo" value="<?php echo $Pessoa -> get_cargoPessoa()?>" class="" />
		<span class="placeholder" ></span>
	</p>

	<p>
		<label for="inativo" >
			<input type="checkbox" name="inativo" id="inativo" value="1" class=""
			<?php echo Uteis::verificaChecked($Pessoa -> get_inativoPessoa())?>
			/>
			Inativo:</label>
		<span class="placeholder" >Campo obrigatório</span>
	</p>

	<p>
		<label>Obs:</label>
		<textarea name="obs" id="obs" cols="60" rows="4" class="" ><?php echo $Pessoa -> get_obsPessoa()?></textarea>
		<span class="placeholder" ></span>
	</p>

</div>

<script>

</script>

