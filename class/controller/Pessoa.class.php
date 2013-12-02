<?php
class Pessoa extends Pessoa_m {
		
	//CONSTRUTOR
	function __construct($idPessoa) {
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
			
	function tabelaPessoa_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectPessoa($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Pais = new Pais( $this -> get_pais_idPessoa() );
				$colunas[] = $Pais -> get_idPais();
				$Tipodocumentounico = new Tipodocumentounico( $this -> get_tipoDocumentoUnico_idPessoa() );
				$colunas[] = $Tipodocumentounico -> get_idTipodocumentounico();
				$Estadocivil = new Estadocivil( $this -> get_estadoCivil_idPessoa() );
				$colunas[] = $Estadocivil -> get_idEstadocivil();
				$colunas[] = $this -> get_nomePessoa();
				$colunas[] = $this -> get_rgPessoa();
				$colunas[] = $this -> get_fotoPessoa();
				$colunas[] = $this -> get_curriculumPessoa();
				$colunas[] = $this -> get_cargoPessoa();
				$colunas[] = $this -> get_sexoPessoa();
				$colunas[] = $this -> get_senhaPessoa();
				$colunas[] = $this -> get_documentoPessoa();
				$colunas[] = $this -> get_inativoPessoa(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "?ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idPessoa=".$this -> idPessoa;
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."form.php?idPessoa=".$this -> idPessoa."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php".$urlAux."', '".$this -> idPessoa."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
				if( $apenasLinha !== false ){
						
					$colunas[] = implode(ICON_SEPARATOR, array(
						$editar,
						$deletar
					));									
					break;
					
				}else{
						
					$colunas[] = array(
						$editar,
						$deletar
					);
					$linhas[] = $colunas;
					
				}
								
			}
	
		}		
	
		return ( $apenasLinha !== false ) ? $colunas : Html::montarColunas($linhas);
		
	}
	
	//AÇÕES
	function cadastrarPessoa($idPessoa, $post = array()){
		
		//CARREGAR DO POST
		$pais_id = ($post['pais_id']);
			 if( $pais_id == '' ) return array(false, MSG_OBRIGAT." Pais");
		
		$tipoDocumentoUnico_id = ($post['tipoDocumentoUnico_id']);
			 if( $tipoDocumentoUnico_id == '' ) return array(false, MSG_OBRIGAT." Tipo Documento Unico");
		
		$estadoCivil_id = ($post['estadoCivil_id']);
			 if( $estadoCivil_id == '' ) return array(false, MSG_OBRIGAT." Estado Civil");
		
		$nome = ($post['nome']);
			 if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
		
		$rg = ($post['rg']);
		
		$foto = ($post['foto']);
		
		$curriculum = ($post['curriculum']);
		
		$cargo = ($post['cargo']);
		
		$sexo = ($post['sexo']);
			 if( $sexo == '' ) return array(false, MSG_OBRIGAT." Sexo");
		
		$senha = ($post['senha']);
			 if( $senha == '' ) return array(false, MSG_OBRIGAT." Senha");
		
		$documento = ($post['documento']);
			 if( $documento == '' ) return array(false, MSG_OBRIGAT." Documento");
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_pais_idPessoa($pais_id)
			 -> set_tipoDocumentoUnico_idPessoa($tipoDocumentoUnico_id)
			 -> set_estadoCivil_idPessoa($estadoCivil_id)
			 -> set_nomePessoa($nome)
			 -> set_rgPessoa($rg)
			 -> set_fotoPessoa($foto)
			 -> set_curriculumPessoa($curriculum)
			 -> set_cargoPessoa($cargo)
			 -> set_sexoPessoa($sexo)
			 -> set_senhaPessoa($senha)
			 -> set_documentoPessoa($documento)
			 -> set_inativoPessoa($inativo);
		
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

