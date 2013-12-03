<?php
class Enderecovirtual extends Enderecovirtual_m {
		
	//CONSTRUTOR
	function __construct($idEnderecovirtual = "") {
		parent::__construct($idEnderecovirtual);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectEnderecovirtual_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectEnderecovirtual($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleEnderecovirtual_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectEnderecovirtual($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxEnderecovirtual_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectEnderecovirtual($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaEnderecovirtual_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectEnderecovirtual($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
								
				$Tipoenderecovirtual = new Tipoenderecovirtual( $this -> get_tipoEnderecoVirtual_idEnderecovirtual() );
				$colunas[] = $Tipoenderecovirtual -> get_nomeTipoenderecovirtual();
				$colunas[] = $this -> get_nomeEnderecovirtual();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idEnderecovirtual=".$this -> get_idEnderecovirtual();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idEnderecovirtual=".$this -> get_idEnderecovirtual() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idEnderecovirtual() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
				if( $apenasLinha !== false ){						
					$colunas[] = implode(ICON_SEPARATOR, array(
						$editar,	$deletar
					));									
					break;					
				}else{						
					$colunas[] = array(
						$editar,	$deletar
					);
					$linhas[] = $colunas;					
				}
								
			}
	
		}		
	
		return ( $apenasLinha !== false ) ? $colunas : Html::montarColunas($linhas);
		
	}
	
	//AÇÕES
	function cadastrarEnderecovirtual($idEnderecovirtual, $post = array()){
		
		//CARREGAR DO POST
		$empresa_id = ($post['empresa_id']);
		
		$pessoa_id = ($post['pessoa_id']);
		
		$tipoEnderecoVirtual_id = ($post['tipoEnderecoVirtual_id']);
			 if( $tipoEnderecoVirtual_id == '' ) return array(false, MSG_OBRIGAT." Tipo Endereco Virtual");
		
		$nome = ($post['nome']);
			 if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
				
		//SETAR
		$this
			 -> set_empresa_idEnderecovirtual($empresa_id)
			 -> set_pessoa_idEnderecovirtual($pessoa_id)
			 -> set_tipoEnderecoVirtual_idEnderecovirtual($tipoEnderecoVirtual_id)
			 -> set_nomeEnderecovirtual($nome);
		
		if( $idEnderecovirtual ){			
			$this -> set_idEnderecovirtual($idEnderecovirtual);			
			return ( $this -> updateEnderecovirtual() );
		}else{			
			return ( $this -> insertEnderecovirtual() );			
		}

	}
		
	function deletarEnderecovirtual($idEnderecovirtual) {
		$this -> set_idEnderecovirtual($idEnderecovirtual);	
		return (	$this -> deleteEnderecovirtual() );
	}
	
}

