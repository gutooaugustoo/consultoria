<?php
class Tipopergunta extends Tipopergunta_m {
		
	//CONSTRUTOR
	function __construct($idTipopergunta = "") {
		parent::__construct($idTipopergunta);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectTipopergunta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "descricao AS legenda");
		$array = $this -> selectTipopergunta($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleTipopergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "descricao AS legenda");
		$array = $this -> selectTipopergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxTipopergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "descricao AS legenda");
		$array = $this -> selectTipopergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaTipopergunta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectTipopergunta($where, array("T.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_descricaoTipopergunta();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idTipopergunta=".$this -> get_idTipopergunta();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idTipopergunta=".$this -> get_idTipopergunta() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idTipopergunta() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarTipopergunta($idTipopergunta, $post = array()){
		
		//CARREGAR DO POST
		$descricao = ($post['descricao']);
		if( $descricao == '' ) return array(false, MSG_OBRIGAT." Descrição");
				
		//SETAR
		$this
			 -> set_descricaoTipopergunta($descricao);
		
		if( $idTipopergunta ){			
			$this -> set_idTipopergunta($idTipopergunta);			
			return ( $this -> updateTipopergunta() );
		}else{			
			return ( $this -> insertTipopergunta() );			
		}

	}
		
	function deletarTipopergunta($idTipopergunta) {
		$this -> set_idTipopergunta($idTipopergunta);	
		return (	$this -> deleteTipopergunta() );
	}
	
}

