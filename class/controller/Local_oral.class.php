<?php
class Local_oral extends Local_oral_m {
		
	//CONSTRUTOR
	function __construct($idLocal_oral = "") {
		parent::__construct($idLocal_oral);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectLocal_oral_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND L.excluido = 0";
		$campos = array("L.id", "L.local AS legenda");
		$array = $this -> selectLocal_oral($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleLocal_oral_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND L.excluido = 0";
		$campos = array("L.id", "L.local AS legenda");
		$array = $this -> selectLocal_oral($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxLocal_oral_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND L.excluido = 0";
		$campos = array("id", "local AS legenda");
		$array = $this -> selectLocal_oral($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaLocal_oral_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectLocal_oral($where, array("L.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_localLocal_oral();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idLocal_oral=".$this -> get_idLocal_oral();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idLocal_oral=".$this -> get_idLocal_oral() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idLocal_oral() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarLocal_oral($idLocal_oral, $post = array()){
		
		//CARREGAR DO POST
		$local = ($post['local']);
		if( $local == '' ) return array(false, MSG_OBRIGAT." Local");
				
		//SETAR
		$this
			 -> set_localLocal_oral($local);
		
		if( $idLocal_oral ){			
			$this -> set_idLocal_oral($idLocal_oral);			
			return ( $this -> updateLocal_oral() );
		}else{			
			return ( $this -> insertLocal_oral() );			
		}

	}
		
	function deletarLocal_oral($idLocal_oral) {
		$this -> set_idLocal_oral($idLocal_oral);	
		return (	$this -> deleteLocal_oral() );
	}
	
}

