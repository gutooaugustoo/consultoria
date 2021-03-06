<?php
class Pessoa extends Pessoa_m {
		
	//CONSTRUTOR
	function __construct($idPessoa = "") {
		parent::__construct($idPessoa);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectPessoa_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("id", "documento AS legenda");
		$array = $this -> selectPessoa($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultiplePessoa_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("id", "documento AS legenda");
		$array = $this -> selectPessoa($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxPessoa_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("id", "documento AS legenda");
		$array = $this -> selectPessoa($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/		
	
	//AÇÕES
	function cadastrarPessoa($idPessoa, $post = array()){
		
		//CARREGAR DO POST
		$emailPrincipal = ($post['emailPrincipal']);
		if( $emailPrincipal == '' ) return array(false, MSG_OBRIGAT." Email Principal");
		
		//VERIFICAR SE JA EXISTE ESSE EMAIL NO CADASTRO		
		$where = "WHERE emailPrincipal = ".$this->gravarBD($emailPrincipal);
		if( $idPessoa ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idPessoa).")";		
		if( $rs_temDocumento = $this->selectPessoa($where, array("id")) ){
			return array(false, "Esse e-mail já existe no cadastro.");
		};
		
		$documento = ($post['documento']);
		if( $documento == '' ) return array(false, MSG_OBRIGAT." Documento");
		
		//VERIFICAR SE JA EXISTE ESSE NUM DOCUMENTO NO CADASTRO		
		$where = "WHERE documento = ".$this->gravarBD($documento);
		if( $idPessoa ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idPessoa).")";		
		if( $rs_temDocumento = $this->selectPessoa($where, array("id")) ){
			return array(false, "Esse número de documento já existe no cadastro.");
		};
		
		$pais_id = ($post['pais_id']);
		if( $pais_id == '' ) return array(false, MSG_OBRIGAT." Pais");
		
		$tipoDocumentoUnico_id = ($post['tipoDocumentoUnico_id']);
		if( $tipoDocumentoUnico_id == '' ) return array(false, MSG_OBRIGAT." Tipo Documento Unico");
		
		$estadoCivil_id = ($post['estadoCivil_id']);
		if( $estadoCivil_id == '' ) return array(false, MSG_OBRIGAT." Estado Civil");
		
		$nome = ($post['nome']);
		if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
		
		$dataNascimento = ($post['dataNascimento']);
		if( $dataNascimento == '' ) return array(false, MSG_OBRIGAT." Data Nascimento");
		
		$rg = ($post['rg']);
		
		$foto = ($post['foto']);
		
		$curriculum = ($post['curriculum']);
		
		$cargo = ($post['cargo']);
		
		$sexo = ($post['sexo']);
		if( $sexo == '' ) return array(false, MSG_OBRIGAT." Sexo");
		
		$senha = ($post['senha']);
		if( $senha == '' ) return array(false, MSG_OBRIGAT." Senha");			
		
		$inativo = ($post['inativo']);
		
		$obs = ($post['obs']);
			
		//SETAR
		$this
			 -> set_pais_idPessoa($pais_id)
			 -> set_tipoDocumentoUnico_idPessoa($tipoDocumentoUnico_id)
			 -> set_estadoCivil_idPessoa($estadoCivil_id)
			 -> set_nomePessoa($nome)
			 -> set_emailPrincipalPessoa($emailPrincipal)
			 -> set_dataNascimentoPessoa($dataNascimento)
			 -> set_rgPessoa($rg)
			 -> set_fotoPessoa($foto)
			 -> set_curriculumPessoa($curriculum)
			 -> set_cargoPessoa($cargo)
			 -> set_sexoPessoa($sexo)
			 -> set_senhaPessoa($senha)
			 -> set_documentoPessoa($documento)
			 -> set_inativoPessoa($inativo)
			 -> set_obsPessoa($obs);
		
		if( $idPessoa ){			
			$this -> set_idPessoa($idPessoa);			
			return ( $this -> updatePessoa() );
		}else{			
			return ( $this -> insertPessoa() );			
		}

	}
		
	function deletarPessoa($idPessoa) {
		$this -> set_idPessoa($idPessoa);	
		return (	$this -> deletePessoa() );
	}
	
}

