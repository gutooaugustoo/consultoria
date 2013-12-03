<?php
class Telefone extends Telefone_m {
		
	//CONSTRUTOR
	function __construct($idTelefone = "") {
		parent::__construct($idTelefone);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectTelefone_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectTelefone($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleTelefone_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectTelefone($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxTelefone_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectTelefone($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaTelefone_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectTelefone($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "?ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idTelefone=".$this -> get_idTelefone();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idTelefone=".$this -> get_idTelefone() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php".$urlAux."', '".$this -> get_idTelefone() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarTelefone($idTelefone, $post = array()){
		
		//CARREGAR DO POST		
		//SETAR
		$this;
		
		if( $idTelefone ){			
			$this -> set_idTelefone($idTelefone);			
			return ( $this -> updateTelefone() );
		}else{			
			return ( $this -> insertTelefone() );			
		}

	}
		
	function deletarTelefone($idTelefone) {
		$this -> set_idTelefone($idTelefone);	
		return (	$this -> deleteTelefone() );
	}
	
}

