<?php
class Item_anotacaoentrevista extends Item_anotacaoentrevista_m {
		
	//CONSTRUTOR
	function __construct($idItem_anotacaoentrevista = "") {
		parent::__construct($idItem_anotacaoentrevista);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectItem_anotacaoentrevista_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "item AS legenda");
		$array = $this -> selectItem_anotacaoentrevista($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleItem_anotacaoentrevista_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "item AS legenda");
		$array = $this -> selectItem_anotacaoentrevista($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxItem_anotacaoentrevista_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "item AS legenda");
		$array = $this -> selectItem_anotacaoentrevista($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaItem_anotacaoentrevista_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectItem_anotacaoentrevista($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_itemItem_anotacaoentrevista();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idItem_anotacaoentrevista=".$this -> get_idItem_anotacaoentrevista();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idItem_anotacaoentrevista=".$this -> get_idItem_anotacaoentrevista() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idItem_anotacaoentrevista() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarItem_anotacaoentrevista($idItem_anotacaoentrevista, $post = array()){
		
		//CARREGAR DO POST
		$item = ($post['item']);
		if( $item == '' ) return array(false, MSG_OBRIGAT." Item");
				
		//SETAR
		$this
			 -> set_itemItem_anotacaoentrevista($item);
		
		if( $idItem_anotacaoentrevista ){			
			$this -> set_idItem_anotacaoentrevista($idItem_anotacaoentrevista);			
			return ( $this -> updateItem_anotacaoentrevista() );
		}else{			
			return ( $this -> insertItem_anotacaoentrevista() );			
		}

	}
		
	function deletarItem_anotacaoentrevista($idItem_anotacaoentrevista) {
		$this -> set_idItem_anotacaoentrevista($idItem_anotacaoentrevista);	
		return (	$this -> deleteItem_anotacaoentrevista() );
	}
	
}

