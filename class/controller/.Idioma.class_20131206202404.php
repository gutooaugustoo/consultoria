<?php
class Idioma extends Idioma_m {
		
	//CONSTRUTOR
	function __construct($idIdioma = "") {
		parent::__construct($idIdioma);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectIdioma_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND I.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectIdioma($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleIdioma_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND I.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectIdioma($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxIdioma_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND I.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectIdioma($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaIdioma_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectIdioma($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomeIdioma();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idIdioma=".$this -> get_idIdioma();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idIdioma=".$this -> get_idIdioma() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idIdioma() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarIdioma($idIdioma, $post = array()){
		
		//CARREGAR DO POST
		$nome = ($post['nome']);
		if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
				
		//SETAR
		$this
			 -> set_nomeIdioma($nome);
		
		if( $idIdioma ){			
			$this -> set_idIdioma($idIdioma);			
			return ( $this -> updateIdioma() );
		}else{			
			return ( $this -> insertIdioma() );			
		}

	}
		
	function deletarIdioma($idIdioma) {
		$this -> set_idIdioma($idIdioma);	
		return (	$this -> deleteIdioma() );
	}
	
}

