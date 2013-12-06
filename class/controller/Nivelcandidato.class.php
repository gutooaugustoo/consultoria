<?php
class Nivelcandidato extends Nivelcandidato_m {
		
	//CONSTRUTOR
	function __construct($idNivelcandidato = "") {
		parent::__construct($idNivelcandidato);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectNivelcandidato_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND N.excluido = 0";
		$campos = array("id", "nivel AS legenda");
		$array = $this -> selectNivelcandidato($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleNivelcandidato_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND N.excluido = 0";
		$campos = array("id", "nivel AS legenda");
		$array = $this -> selectNivelcandidato($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxNivelcandidato_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND N.excluido = 0";
		$campos = array("id", "nivel AS legenda");
		$array = $this -> selectNivelcandidato($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaNivelcandidato_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectNivelcandidato($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nivelNivelcandidato();
				$colunas[] = $this -> get_inativoNivelcandidato(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idNivelcandidato=".$this -> get_idNivelcandidato();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idNivelcandidato=".$this -> get_idNivelcandidato() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idNivelcandidato() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarNivelcandidato($idNivelcandidato, $post = array()){
		
		//CARREGAR DO POST
		$nivel = ($post['nivel']);
		if( $nivel == '' ) return array(false, MSG_OBRIGAT." Nivel");
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_nivelNivelcandidato($nivel)
			 -> set_inativoNivelcandidato($inativo);
		
		if( $idNivelcandidato ){			
			$this -> set_idNivelcandidato($idNivelcandidato);			
			return ( $this -> updateNivelcandidato() );
		}else{			
			return ( $this -> insertNivelcandidato() );			
		}

	}
		
	function deletarNivelcandidato($idNivelcandidato) {
		$this -> set_idNivelcandidato($idNivelcandidato);	
		return (	$this -> deleteNivelcandidato() );
	}
	
}

