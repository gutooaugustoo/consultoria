<?php
class Nivelpergunta extends Nivelpergunta_m {
		
	//CONSTRUTOR
	function __construct($idNivelpergunta = "") {
		parent::__construct($idNivelpergunta);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectNivelpergunta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND N.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectNivelpergunta($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleNivelpergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND N.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectNivelpergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxNivelpergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND N.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectNivelpergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaNivelpergunta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectNivelpergunta($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomeNivelpergunta();
				$colunas[] = $this -> get_inativoNivelpergunta(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idNivelpergunta=".$this -> get_idNivelpergunta();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idNivelpergunta=".$this -> get_idNivelpergunta() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idNivelpergunta() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarNivelpergunta($idNivelpergunta, $post = array()){
		
		//CARREGAR DO POST
		$nome = ($post['nome']);
		if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_nomeNivelpergunta($nome)
			 -> set_inativoNivelpergunta($inativo);
		
		if( $idNivelpergunta ){			
			$this -> set_idNivelpergunta($idNivelpergunta);			
			return ( $this -> updateNivelpergunta() );
		}else{			
			return ( $this -> insertNivelpergunta() );			
		}

	}
		
	function deletarNivelpergunta($idNivelpergunta) {
		$this -> set_idNivelpergunta($idNivelpergunta);	
		return (	$this -> deleteNivelpergunta() );
	}
	
}

