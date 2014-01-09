<?php
class Redacao_itemavaliar extends Redacao_itemavaliar_m {
		
	//CONSTRUTOR
	function __construct($idRedacao_itemavaliar = "") {
		parent::__construct($idRedacao_itemavaliar);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectRedacao_itemavaliar_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectRedacao_itemavaliar($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleRedacao_itemavaliar_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectRedacao_itemavaliar($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxRedacao_itemavaliar_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectRedacao_itemavaliar($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaRedacao_itemavaliar_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectRedacao_itemavaliar($where, array("R.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Itemavaliarredacao = new Itemavaliarredacao( $this -> get_itemAvaliarRedacao_idRedacao_itemavaliar() );
				$colunas[] = $Itemavaliarredacao -> get_enunciadoItemavaliarredacao();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idRedacao_itemavaliar=".$this -> get_idRedacao_itemavaliar();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idRedacao_itemavaliar=".$this -> get_idRedacao_itemavaliar() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idRedacao_itemavaliar() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarRedacao_itemavaliar($idRedacao_itemavaliar, $post = array()){
		
		//CARREGAR DO POST
		$itemAvaliarRedacao_id = ($post['itemAvaliarRedacao_id']);
		if( $itemAvaliarRedacao_id == '' ) return array(false, MSG_OBRIGAT." Item Avaliar Redacao");
		
		$redacao_id = ($post['redacao_id']);
		if( $redacao_id == '' ) return array(false, MSG_OBRIGAT." Redacao");
		
		$obsTem = ($post['obsTem']);
		
		$obsObrigatorio = ($post['obsObrigatorio']);
    
    $where = " WHERE excluido = 0 AND itemAvaliarRedacao_id = ".Uteis::escapeRequest($itemAvaliarRedacao_id)." AND redacao_id = ".Uteis::escapeRequest($redacao_id);
    if( $idRedacao_itemavaliar ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idRedacao_itemavaliar).") ";
    $rs = $this->selectRedacao_itemavaliar($where, array("id"));
    if( $rs ) return array(false, "Esse item já está vinculado a esta redação");
				
		//SETAR
		$this
			 -> set_itemAvaliarRedacao_idRedacao_itemavaliar($itemAvaliarRedacao_id)
			 -> set_redacao_idRedacao_itemavaliar($redacao_id)
			 -> set_obsTemRedacao_itemavaliar($obsTem)
			 -> set_obsObrigatorioRedacao_itemavaliar($obsObrigatorio);
		
		if( $idRedacao_itemavaliar ){			
			$this -> set_idRedacao_itemavaliar($idRedacao_itemavaliar);			
			return ( $this -> updateRedacao_itemavaliar() );
		}else{			
			return ( $this -> insertRedacao_itemavaliar() );			
		}

	}
		
	function deletarRedacao_itemavaliar($idRedacao_itemavaliar) {
		$this -> set_idRedacao_itemavaliar($idRedacao_itemavaliar);	
		return (	$this -> deleteRedacao_itemavaliar() );
	}
	
}

