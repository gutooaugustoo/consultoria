<?php
class Tipoescrito extends Tipoescrito_m {
		
	//CONSTRUTOR
	function __construct($idTipoescrito = "") {
		parent::__construct($idTipoescrito);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectTipoescrito_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectTipoescrito($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleTipoescrito_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectTipoescrito($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxTipoescrito_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectTipoescrito($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaTipoescrito_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectTipoescrito($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomeTipoescrito();
				$colunas[] = $this -> get_inativoTipoescrito(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idTipoescrito=".$this -> get_idTipoescrito();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idTipoescrito=".$this -> get_idTipoescrito() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idTipoescrito() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarTipoescrito($idTipoescrito, $post = array()){
		
		//CARREGAR DO POST
		$nome = ($post['nome']);
		if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_nomeTipoescrito($nome)
			 -> set_inativoTipoescrito($inativo);
		
		if( $idTipoescrito ){			
			$this -> set_idTipoescrito($idTipoescrito);			
			return ( $this -> updateTipoescrito() );
		}else{			
			return ( $this -> insertTipoescrito() );			
		}

	}
		
	function deletarTipoescrito($idTipoescrito) {
		$this -> set_idTipoescrito($idTipoescrito);	
		return (	$this -> deleteTipoescrito() );
	}
	
}

