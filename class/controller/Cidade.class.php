<?php
class Cidade extends Cidade_m {
		
	//CONSTRUTOR
	function __construct($idCidade = "") {
		parent::__construct($idCidade);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectCidade_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectCidade($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleCidade_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectCidade($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxCidade_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectCidade($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaCidade_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectCidade($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Uf = new Uf( $this -> get_uf_idCidade() );
				$colunas[] = $Uf -> get_idUf();
				$colunas[] = $this -> get_nomeCidade();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idCidade=".$this -> get_idCidade();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idCidade=".$this -> get_idCidade() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idCidade() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarCidade($idCidade, $post = array()){
		
		//CARREGAR DO POST
		$uf_id = ($post['uf_id']);
			 if( $uf_id == '' ) return array(false, MSG_OBRIGAT." Uf");
		
		$nome = ($post['nome']);
			 if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
				
		//SETAR
		$this
			 -> set_uf_idCidade($uf_id)
			 -> set_nomeCidade($nome);
		
		if( $idCidade ){			
			$this -> set_idCidade($idCidade);			
			return ( $this -> updateCidade() );
		}else{			
			return ( $this -> insertCidade() );			
		}

	}
		
	function deletarCidade($idCidade) {
		$this -> set_idCidade($idCidade);	
		return (	$this -> deleteCidade() );
	}
	
}

