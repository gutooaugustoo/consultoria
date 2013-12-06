<?php
class Descricaotelefone extends Descricaotelefone_m {
		
	//CONSTRUTOR
	function __construct($idDescricaotelefone = "") {
		parent::__construct($idDescricaotelefone);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectDescricaotelefone_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND D.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectDescricaotelefone($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleDescricaotelefone_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND D.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectDescricaotelefone($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxDescricaotelefone_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND D.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectDescricaotelefone($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaDescricaotelefone_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectDescricaotelefone($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomeDescricaotelefone();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idDescricaotelefone=".$this -> get_idDescricaotelefone();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idDescricaotelefone=".$this -> get_idDescricaotelefone() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idDescricaotelefone() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarDescricaotelefone($idDescricaotelefone, $post = array()){
		
		//CARREGAR DO POST
		$nome = ($post['nome']);
			 if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
				
		//SETAR
		$this
			 -> set_nomeDescricaotelefone($nome);
		
		if( $idDescricaotelefone ){			
			$this -> set_idDescricaotelefone($idDescricaotelefone);			
			return ( $this -> updateDescricaotelefone() );
		}else{			
			return ( $this -> insertDescricaotelefone() );			
		}

	}
		
	function deletarDescricaotelefone($idDescricaotelefone) {
		$this -> set_idDescricaotelefone($idDescricaotelefone);	
		return (	$this -> deleteDescricaotelefone() );
	}
	
}

