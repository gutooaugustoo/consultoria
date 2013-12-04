<?php
class Uf extends Uf_m {
		
	//CONSTRUTOR
	function __construct($idUf = "") {
		parent::__construct($idUf);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectUf_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectUf($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleUf_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectUf($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxUf_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectUf($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaUf_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectUf($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_siglaUf();
				$colunas[] = $this -> get_nomeUf();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idUf=".$this -> get_idUf();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idUf=".$this -> get_idUf() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idUf() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarUf($idUf, $post = array()){
		
		//CARREGAR DO POST
		$sigla = ($post['sigla']);
			 if( $sigla == '' ) return array(false, MSG_OBRIGAT." Sigla");
		
		$nome = ($post['nome']);
			 if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
				
		//SETAR
		$this
			 -> set_siglaUf($sigla)
			 -> set_nomeUf($nome);
		
		if( $idUf ){			
			$this -> set_idUf($idUf);			
			return ( $this -> updateUf() );
		}else{			
			return ( $this -> insertUf() );			
		}

	}
		
	function deletarUf($idUf) {
		$this -> set_idUf($idUf);	
		return (	$this -> deleteUf() );
	}
	
}

