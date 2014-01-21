<?php
class Teste extends Teste_m {
		
	//CONSTRUTOR
	function __construct($idTeste = "") {
		parent::__construct($idTeste);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectTeste_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("T.id", "T.campoString AS legenda");
		$array = $this -> selectTeste($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleTeste_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("T.id", "T.campoString AS legenda");
		$array = $this -> selectTeste($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxTeste_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "campoString AS legenda");
		$array = $this -> selectTeste($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaTeste_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectTeste($where, array("T.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_campoStringTeste();
				$colunas[] = $this -> get_campoTextTeste();
				$colunas[] = $this -> get_campoIntTeste();
				$colunas[] = $this -> get_campoBoolTeste(true);
				$colunas[] = $this -> get_campoDateTeste();
				$colunas[] = $this -> get_campoDoubleTeste(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idTeste=".$this -> get_idTeste();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idTeste=".$this -> get_idTeste() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idTeste() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarTeste($idTeste, $post = array()){
		
		//CARREGAR DO POST
		$campoString = ($post['campoString']);
		if( $campoString == '' ) return array(false, MSG_OBRIGAT." Campo String");
		
		$campoText = ($post['campoText']);
		if( $campoText == '' ) return array(false, MSG_OBRIGAT." Campo Text");
		
		$campoInt = ($post['campoInt']);
		if( $campoInt == '' ) return array(false, MSG_OBRIGAT." Campo Int");
		
		$campoBool = ($post['campoBool']);
		
		$campoDate = ($post['campoDate']);
		if( $campoDate == '' ) return array(false, MSG_OBRIGAT." Campo Date");
		
		$campoDouble = ($post['campoDouble']);
		if( $campoDouble == '' ) return array(false, MSG_OBRIGAT." Campo Double");
				
		//SETAR
		$this
			 -> set_campoStringTeste($campoString)
			 -> set_campoTextTeste($campoText)
			 -> set_campoIntTeste($campoInt)
			 -> set_campoBoolTeste($campoBool)
			 -> set_campoDateTeste($campoDate)
			 -> set_campoDoubleTeste($campoDouble);
		
		if( $idTeste ){			
			$this -> set_idTeste($idTeste);			
			return ( $this -> updateTeste() );
		}else{			
			return ( $this -> insertTeste() );			
		}

	}
		
	function deletarTeste($idTeste) {
		$this -> set_idTeste($idTeste);	
		return (	$this -> deleteTeste() );
	}
	
}

