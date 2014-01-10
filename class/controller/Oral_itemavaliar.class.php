<?php
class Oral_itemavaliar extends Oral_itemavaliar_m {
		
	//CONSTRUTOR
	function __construct($idOral_itemavaliar = "") {
		parent::__construct($idOral_itemavaliar);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectOral_itemavaliar_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("O.id", "O. AS legenda");
		$array = $this -> selectOral_itemavaliar($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleOral_itemavaliar_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("O.id", "O. AS legenda");
		$array = $this -> selectOral_itemavaliar($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxOral_itemavaliar_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectOral_itemavaliar($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaOral_itemavaliar_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectOral_itemavaliar($where, array("O.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
								
				$Itemavaliaroral = new Itemavaliaroral( $this -> get_itemAvaliarOral_idOral_itemavaliar() );
				$colunas[] = $Itemavaliaroral -> get_enunciadoItemavaliaroral();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idOral_itemavaliar=".$this -> get_idOral_itemavaliar();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idOral_itemavaliar=".$this -> get_idOral_itemavaliar() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idOral_itemavaliar() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarOral_itemavaliar($idOral_itemavaliar, $post = array()){
		
		//CARREGAR DO POST
		$oral_id = ($post['oral_id']);
		if( $oral_id == '' ) return array(false, MSG_OBRIGAT." Oral");
		
		$itemAvaliarOral_id = ($post['itemAvaliarOral_id']);
		if( $itemAvaliarOral_id == '' ) return array(false, MSG_OBRIGAT." Item Avaliar Oral");
		
		$obsTem = ($post['obsTem']);
		if( $obsTem ){
		  $obsObrigatotia = ($post['obsObrigatotia']);  
		}
		
    $where = " WHERE excluido = 0 AND itemAvaliarOral_id = ".Uteis::escapeRequest($itemAvaliarOral_id)." AND oral_id = ".Uteis::escapeRequest($oral_id);
    if( $idOral_itemavaliar ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idOral_itemavaliar).") ";
    $rs = $this->selectOral_itemavaliar($where, array("id"));
    if( $rs ) return array(false, "O item já está vinculado a este teste oral");
    		
		//SETAR
		$this
			 -> set_oral_idOral_itemavaliar($oral_id)
			 -> set_itemAvaliarOral_idOral_itemavaliar($itemAvaliarOral_id)
			 -> set_obsTemOral_itemavaliar($obsTem)
			 -> set_obsObrigatotiaOral_itemavaliar($obsObrigatotia);
		
		if( $idOral_itemavaliar ){			
			$this -> set_idOral_itemavaliar($idOral_itemavaliar);			
			return ( $this -> updateOral_itemavaliar() );
		}else{			
			return ( $this -> insertOral_itemavaliar() );			
		}

	}
		
	function deletarOral_itemavaliar($idOral_itemavaliar) {
		$this -> set_idOral_itemavaliar($idOral_itemavaliar);	
		return (	$this -> deleteOral_itemavaliar() );
	}
	
}

