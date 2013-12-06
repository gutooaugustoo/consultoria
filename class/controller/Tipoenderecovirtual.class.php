<?php
class Tipoenderecovirtual extends Tipoenderecovirtual_m {
		
	//CONSTRUTOR
	function __construct($idTipoenderecovirtual = "") {
		parent::__construct($idTipoenderecovirtual);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectTipoenderecovirtual_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectTipoenderecovirtual($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleTipoenderecovirtual_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectTipoenderecovirtual($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxTipoenderecovirtual_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectTipoenderecovirtual($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaTipoenderecovirtual_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectTipoenderecovirtual($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomeTipoenderecovirtual();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idTipoenderecovirtual=".$this -> get_idTipoenderecovirtual();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idTipoenderecovirtual=".$this -> get_idTipoenderecovirtual() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idTipoenderecovirtual() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
				if( $apenasLinha !== false ){
						
					if( $iten['id'] == "1" ){
						$colunas[] = "";
					}else{
						$colunas[] = implode(ICON_SEPARATOR, array(
							$editar,	$deletar
						));	
					}						
														
					break;					
					
				}else{
					if( $iten['id'] == "1" ){
						$colunas[] = array();
					}else{
						$colunas[] = array(
							$editar,	$deletar
						);	
					}						
					
					$linhas[] = $colunas;					
				}
								
			}
	
		}		
	
		return ( $apenasLinha !== false ) ? $colunas : Html::montarColunas($linhas);
		
	}
	
	//AÇÕES
	function cadastrarTipoenderecovirtual($idTipoenderecovirtual, $post = array()){
		
		//CARREGAR DO POST
		$nome = ($post['nome']);
		if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
				
		//SETAR
		$this
			 -> set_nomeTipoenderecovirtual($nome);
		
		if( $idTipoenderecovirtual ){			
			$this -> set_idTipoenderecovirtual($idTipoenderecovirtual);			
			return ( $this -> updateTipoenderecovirtual() );
		}else{			
			return ( $this -> insertTipoenderecovirtual() );			
		}

	}
		
	function deletarTipoenderecovirtual($idTipoenderecovirtual) {
		$this -> set_idTipoenderecovirtual($idTipoenderecovirtual);	
		return (	$this -> deleteTipoenderecovirtual() );
	}
	
}

