<?php
class Planoacao extends Planoacao_m {
		
	//CONSTRUTOR
	function __construct($idPlanoacao = "") {
		parent::__construct($idPlanoacao);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectPlanoacao_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("P.id", "P. AS legenda");
		$array = $this -> selectPlanoacao($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultiplePlanoacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("P.id", "P. AS legenda");
		$array = $this -> selectPlanoacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxPlanoacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectPlanoacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaPlanoacao_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectPlanoacao($where, array("P.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idPlanoacao=".$this -> get_idPlanoacao();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idPlanoacao=".$this -> get_idPlanoacao() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idPlanoacao() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarPlanoacao($idPlanoacao, $post = array()){
		
		//CARREGAR DO POST		
		//SETAR
		$this;
		
		if( $idPlanoacao ){			
			$this -> set_idPlanoacao($idPlanoacao);			
			return ( $this -> updatePlanoacao() );
		}else{			
			return ( $this -> insertPlanoacao() );			
		}

	}
		
	function deletarPlanoacao($idPlanoacao) {
		$this -> set_idPlanoacao($idPlanoacao);	
		return (	$this -> deletePlanoacao() );
	}
	
}

