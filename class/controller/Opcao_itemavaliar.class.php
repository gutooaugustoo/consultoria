<?php
class Opcao_itemavaliar extends Opcao_itemavaliar_m {
		
	//CONSTRUTOR
	function __construct($idOpcao_itemavaliar = "") {
		parent::__construct($idOpcao_itemavaliar);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectOpcao_itemavaliar_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("id", "opcao AS legenda");
		$array = $this -> selectOpcao_itemavaliar($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleOpcao_itemavaliar_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("id", "opcao AS legenda");
		$array = $this -> selectOpcao_itemavaliar($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxOpcao_itemavaliar_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("id", "opcao AS legenda");
		$array = $this -> selectOpcao_itemavaliar($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaOpcao_itemavaliar_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectOpcao_itemavaliar($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				//$Itemavaliaroral = new Itemavaliaroral( $this -> get_itemAvaliarOral_idOpcao_itemavaliar() );
				//$colunas[] = $Itemavaliaroral -> get_idItemavaliaroral();
				$colunas[] = $this -> get_opcaoOpcao_itemavaliar();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idOpcao_itemavaliar=".$this -> get_idOpcao_itemavaliar();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idOpcao_itemavaliar=".$this -> get_idOpcao_itemavaliar() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idOpcao_itemavaliar() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarOpcao_itemavaliar($idOpcao_itemavaliar, $post = array()){
		
		//CARREGAR DO POST
		$itemAvaliarOral_id = ($post['itemAvaliarOral_id']);
		if( $itemAvaliarOral_id == '' ) return array(false, MSG_OBRIGAT." Item Avaliar Oral");
		
		$opcao = ($post['opcao']);
		if( $opcao == '' ) return array(false, MSG_OBRIGAT." Opcao");
				
		//SETAR
		$this
			 -> set_itemAvaliarOral_idOpcao_itemavaliar($itemAvaliarOral_id)
			 -> set_opcaoOpcao_itemavaliar($opcao);
		
		if( $idOpcao_itemavaliar ){			
			$this -> set_idOpcao_itemavaliar($idOpcao_itemavaliar);			
			return ( $this -> updateOpcao_itemavaliar() );
		}else{			
			return ( $this -> insertOpcao_itemavaliar() );			
		}

	}
		
	function deletarOpcao_itemavaliar($idOpcao_itemavaliar) {
		$this -> set_idOpcao_itemavaliar($idOpcao_itemavaliar);	
		return (	$this -> deleteOpcao_itemavaliar() );
	}
	
}

