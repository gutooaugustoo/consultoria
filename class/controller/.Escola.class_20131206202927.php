<?php
class Escola extends Escola_m {
		
	//CONSTRUTOR
	function __construct($idEscola = "") {
		parent::__construct($idEscola);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectEscola_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectEscola($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleEscola_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectEscola($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxEscola_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectEscola($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaEscola_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectEscola($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomeEscola();
				$colunas[] = $this -> get_inativoEscola(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idEscola=".$this -> get_idEscola();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idEscola=".$this -> get_idEscola() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idEscola() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarEscola($idEscola, $post = array()){
		
		//CARREGAR DO POST
		$nome = ($post['nome']);
		if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_nomeEscola($nome)
			 -> set_inativoEscola($inativo);
		
		if( $idEscola ){			
			$this -> set_idEscola($idEscola);			
			return ( $this -> updateEscola() );
		}else{			
			return ( $this -> insertEscola() );			
		}

	}
		
	function deletarEscola($idEscola) {
		$this -> set_idEscola($idEscola);	
		return (	$this -> deleteEscola() );
	}
	
}

