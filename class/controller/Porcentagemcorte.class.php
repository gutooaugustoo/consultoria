<?php
class Porcentagemcorte extends Porcentagemcorte_m {
		
	//CONSTRUTOR
	function __construct($idPorcentagemcorte = "") {
		parent::__construct($idPorcentagemcorte);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectPorcentagemcorte_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("P.id", "P. AS legenda");
		$array = $this -> selectPorcentagemcorte($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultiplePorcentagemcorte_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("P.id", "P. AS legenda");
		$array = $this -> selectPorcentagemcorte($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxPorcentagemcorte_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectPorcentagemcorte($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaPorcentagemcorte_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectPorcentagemcorte($where, array("P.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_porcentagemPorcentagemcorte();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idPorcentagemcorte=".$this -> get_idPorcentagemcorte();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idPorcentagemcorte=".$this -> get_idPorcentagemcorte() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idPorcentagemcorte() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarPorcentagemcorte($idPorcentagemcorte, $post = array()){
		
		//CARREGAR DO POST
		$porcentagem = ($post['porcentagem']);
		if( $porcentagem == '' ) return array(false, MSG_OBRIGAT." Porcentagem");
				
		//SETAR
		$this
			 -> set_porcentagemPorcentagemcorte($porcentagem);
		
		if( $idPorcentagemcorte ){			
			$this -> set_idPorcentagemcorte($idPorcentagemcorte);			
			return ( $this -> updatePorcentagemcorte() );
		}else{			
			return ( $this -> insertPorcentagemcorte() );			
		}

	}
		
	function deletarPorcentagemcorte($idPorcentagemcorte) {
		$this -> set_idPorcentagemcorte($idPorcentagemcorte);	
		return (	$this -> deletePorcentagemcorte() );
	}
	
}

