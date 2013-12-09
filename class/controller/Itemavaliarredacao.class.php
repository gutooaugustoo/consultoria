<?php
class Itemavaliarredacao extends Itemavaliarredacao_m {
		
	//CONSTRUTOR
	function __construct($idItemavaliarredacao = "") {
		parent::__construct($idItemavaliarredacao);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectItemavaliarredacao_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND I.excluido = 0";
		$campos = array("id", "enunciado AS legenda");
		$array = $this -> selectItemavaliarredacao($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleItemavaliarredacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND I.excluido = 0";
		$campos = array("id", "enunciado AS legenda");
		$array = $this -> selectItemavaliarredacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxItemavaliarredacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND I.excluido = 0";
		$campos = array("id", "enunciado AS legenda");
		$array = $this -> selectItemavaliarredacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaItemavaliarredacao_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectItemavaliarredacao($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_enunciadoItemavaliarredacao();
				//$colunas[] = $this -> get_dicaComoResponderItemavaliarredacao();
				$colunas[] = $this -> get_padraoItemavaliarredacao(true);
				$colunas[] = $this -> get_inativoItemavaliarredacao(true);				
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idItemavaliarredacao=".$this -> get_idItemavaliarredacao();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idItemavaliarredacao=".$this -> get_idItemavaliarredacao() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idItemavaliarredacao() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarItemavaliarredacao($idItemavaliarredacao, $post = array()){
		
		//CARREGAR DO POST
		$enunciado = ($post['enunciado']);
		if( $enunciado == '' ) return array(false, MSG_OBRIGAT." Enunciado");
		
		$dicaComoResponder = ($post['dicaComoResponder']);
		
		$inativo = ($post['inativo']);
		
		$padrao = ($post['padrao']);
				
		//SETAR
		$this
			 -> set_enunciadoItemavaliarredacao($enunciado)
			 -> set_dicaComoResponderItemavaliarredacao($dicaComoResponder)
			 -> set_inativoItemavaliarredacao($inativo)
			 -> set_padraoItemavaliarredacao($padrao);
		
		if( $idItemavaliarredacao ){			
			$this -> set_idItemavaliarredacao($idItemavaliarredacao);			
			return ( $this -> updateItemavaliarredacao() );
		}else{			
			return ( $this -> insertItemavaliarredacao() );			
		}

	}
		
	function deletarItemavaliarredacao($idItemavaliarredacao) {
		$this -> set_idItemavaliarredacao($idItemavaliarredacao);	
		return (	$this -> deleteItemavaliarredacao() );
	}
	
}

