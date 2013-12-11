<?php
class Etapa extends Etapa_m {
		
	//CONSTRUTOR
	function __construct($idEtapa = "") {
		parent::__construct($idEtapa);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectEtapa_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("E.id", "E.etapa AS legenda");
		$array = $this -> selectEtapa($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleEtapa_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("E.id", "E.etapa AS legenda");
		$array = $this -> selectEtapa($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxEtapa_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "etapa AS legenda");
		$array = $this -> selectEtapa($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaEtapa_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectEtapa($where, array("E.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_etapaEtapa();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idEtapa=".$this -> get_idEtapa();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idEtapa=".$this -> get_idEtapa() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idEtapa() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarEtapa($idEtapa, $post = array()){
		
		//CARREGAR DO POST
		$etapa = ($post['etapa']);
		if( $etapa == '' ) return array(false, MSG_OBRIGAT." Etapa");
				
		//SETAR
		$this
			 -> set_etapaEtapa($etapa);
		
		if( $idEtapa ){			
			$this -> set_idEtapa($idEtapa);			
			return ( $this -> updateEtapa() );
		}else{			
			return ( $this -> insertEtapa() );			
		}

	}
		
	function deletarEtapa($idEtapa) {
		$this -> set_idEtapa($idEtapa);	
		return (	$this -> deleteEtapa() );
	}
	
}

