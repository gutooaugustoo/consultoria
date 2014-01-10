<?php
class Oral_dicas extends Oral_dicas_m {
		
	//CONSTRUTOR
	function __construct($idOral_dicas = "") {
		parent::__construct($idOral_dicas);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectOral_dicas_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("O.id", "O. AS legenda");
		$array = $this -> selectOral_dicas($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleOral_dicas_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("O.id", "O. AS legenda");
		$array = $this -> selectOral_dicas($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxOral_dicas_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectOral_dicas($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaOral_dicas_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectOral_dicas($where, array("O.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
								
				$Dicasentrevista = new Dicasentrevista( $this -> get_dicasEntrevista_idOral_dicas() );
				$colunas[] = $Dicasentrevista -> get_tituloDicasentrevista();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idOral_dicas=".$this -> get_idOral_dicas();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idOral_dicas=".$this -> get_idOral_dicas() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idOral_dicas() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarOral_dicas($idOral_dicas, $post = array()){
		
		//CARREGAR DO POST
		$oral_id = ($post['oral_id']);
		if( $oral_id == '' ) return array(false, MSG_OBRIGAT." Oral");
		
		$dicasEntrevista_id = ($post['dicasEntrevista_id']);
		if( $dicasEntrevista_id == '' ) return array(false, MSG_OBRIGAT." Dicas Entrevista");
		
    $where = " WHERE excluido = 0 AND dicasEntrevista_id = ".Uteis::escapeRequest($dicasEntrevista_id)." AND oral_id = ".Uteis::escapeRequest($oral_id);
    if( $idOral_dicas ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idOral_dicas).") ";
    $rs = $this->selectOral_dicas($where, array("id"));
    if( $rs ) return array(false, "A dica já está vinculada a este teste oral");
    	
		//SETAR
		$this
			 -> set_oral_idOral_dicas($oral_id)
			 -> set_dicasEntrevista_idOral_dicas($dicasEntrevista_id);
		
		if( $idOral_dicas ){			
			$this -> set_idOral_dicas($idOral_dicas);			
			return ( $this -> updateOral_dicas() );
		}else{			
			return ( $this -> insertOral_dicas() );			
		}

	}
		
	function deletarOral_dicas($idOral_dicas) {
		$this -> set_idOral_dicas($idOral_dicas);	
		return (	$this -> deleteOral_dicas() );
	}
	
}

