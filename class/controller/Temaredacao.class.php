<?php
class Temaredacao extends Temaredacao_m {
		
	//CONSTRUTOR
	function __construct($idTemaredacao = "") {
		parent::__construct($idTemaredacao);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectTemaredacao_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "titulo AS legenda");
		$array = $this -> selectTemaredacao($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleTemaredacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "titulo AS legenda");
		$array = $this -> selectTemaredacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxTemaredacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "titulo AS legenda");
		$array = $this -> selectTemaredacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaTemaredacao_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectTemaredacao($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_tituloTemaredacao();
				//$colunas[] = $this -> get_temaTemaredacao();
				$colunas[] = $this -> get_inativoTemaredacao(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idTemaredacao=".$this -> get_idTemaredacao();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idTemaredacao=".$this -> get_idTemaredacao() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idTemaredacao() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarTemaredacao($idTemaredacao, $post = array()){
		
		//CARREGAR DO POST
		$titulo = ($post['titulo']);
		if( $titulo == '' ) return array(false, MSG_OBRIGAT." Titulo");
		
		$tema = ($post['tema']);
		if( $tema == '' ) return array(false, MSG_OBRIGAT." Tema");
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_tituloTemaredacao($titulo)
			 -> set_temaTemaredacao($tema)
			 -> set_inativoTemaredacao($inativo);
		
		if( $idTemaredacao ){			
			$this -> set_idTemaredacao($idTemaredacao);			
			return ( $this -> updateTemaredacao() );
		}else{			
			return ( $this -> insertTemaredacao() );			
		}

	}
		
	function deletarTemaredacao($idTemaredacao) {
		$this -> set_idTemaredacao($idTemaredacao);	
		return (	$this -> deleteTemaredacao() );
	}
	
}

