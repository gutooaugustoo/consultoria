<?php
class Itemavaliaroral extends Itemavaliaroral_m {
		
	//CONSTRUTOR
	function __construct($idItemavaliaroral = "") {
		parent::__construct($idItemavaliaroral);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectItemavaliaroral_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND I.excluido = 0";
		$campos = array("id", "enunciado AS legenda");
		$array = $this -> selectItemavaliaroral($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleItemavaliaroral_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND I.excluido = 0";
		$campos = array("id", "enunciado AS legenda");
		$array = $this -> selectItemavaliaroral($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxItemavaliaroral_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND I.excluido = 0";
		$campos = array("id", "enunciado AS legenda");
		$array = $this -> selectItemavaliaroral($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaItemavaliaroral_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectItemavaliaroral($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_enunciadoItemavaliaroral();
				//$colunas[] = $this -> get_dicaComoResponderItemavaliaroral();
				$colunas[] = $this -> get_padraoItemavaliaroral(true);
				$colunas[] = $this -> get_inativoItemavaliaroral(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idItemavaliaroral=".$this -> get_idItemavaliaroral();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idItemavaliaroral=".$this -> get_idItemavaliaroral() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idItemavaliaroral() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarItemavaliaroral($idItemavaliaroral, $post = array()){
		
		//CARREGAR DO POST
		$enunciado = ($post['enunciado']);
		if( $enunciado == '' ) return array(false, MSG_OBRIGAT." Enunciado");
		
		$dicaComoResponder = ($post['dicaComoResponder']);
		
		$padrao = ($post['padrao']);
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_enunciadoItemavaliaroral($enunciado)
			 -> set_dicaComoResponderItemavaliaroral($dicaComoResponder)
			 -> set_padraoItemavaliaroral($padrao)
			 -> set_inativoItemavaliaroral($inativo);
		
		if( $idItemavaliaroral ){			
			$this -> set_idItemavaliaroral($idItemavaliaroral);			
			return ( $this -> updateItemavaliaroral() );
		}else{			
			return ( $this -> insertItemavaliaroral() );			
		}

	}
		
	function deletarItemavaliaroral($idItemavaliaroral) {
		$this -> set_idItemavaliaroral($idItemavaliaroral);	
		return (	$this -> deleteItemavaliaroral() );
	}
	
}

