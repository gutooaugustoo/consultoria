<?php
class Categoriapergunta extends Categoriapergunta_m {
		
	//CONSTRUTOR
	function __construct($idCategoriapergunta = "") {
		parent::__construct($idCategoriapergunta);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectCategoriapergunta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectCategoriapergunta($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleCategoriapergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectCategoriapergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxCategoriapergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectCategoriapergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaCategoriapergunta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectCategoriapergunta($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomeCategoriapergunta();
				$colunas[] = $this -> get_inativoCategoriapergunta(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idCategoriapergunta=".$this -> get_idCategoriapergunta();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idCategoriapergunta=".$this -> get_idCategoriapergunta() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idCategoriapergunta() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarCategoriapergunta($idCategoriapergunta, $post = array()){
		
		//CARREGAR DO POST
		$nome = ($post['nome']);
		if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_nomeCategoriapergunta($nome)
			 -> set_inativoCategoriapergunta($inativo);
		
		if( $idCategoriapergunta ){			
			$this -> set_idCategoriapergunta($idCategoriapergunta);			
			return ( $this -> updateCategoriapergunta() );
		}else{			
			return ( $this -> insertCategoriapergunta() );			
		}

	}
		
	function deletarCategoriapergunta($idCategoriapergunta) {
		$this -> set_idCategoriapergunta($idCategoriapergunta);	
		return (	$this -> deleteCategoriapergunta() );
	}
	
}

