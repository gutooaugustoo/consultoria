<?php
class Tipodocumentounico extends Tipodocumentounico_m {
		
	//CONSTRUTOR
	function __construct($idTipodocumentounico) {
		parent::__construct($idTipodocumentounico);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectTipodocumentounico_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "class AS legenda");
		$array = $this -> selectTipodocumentounico($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleTipodocumentounico_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "class AS legenda");
		$array = $this -> selectTipodocumentounico($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxTipodocumentounico_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "class AS legenda");
		$array = $this -> selectTipodocumentounico($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaTipodocumentounico_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectTipodocumentounico($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomeTipodocumentounico();
				$colunas[] = $this -> get_classTipodocumentounico();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "?ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idTipodocumentounico=".$this -> idTipodocumentounico;
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."form.php?idTipodocumentounico=".$this -> idTipodocumentounico."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php".$urlAux."', '".$this -> idTipodocumentounico."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
				if( $apenasLinha !== false ){
						
					$colunas[] = implode(ICON_SEPARATOR, array(
						$editar,
						$deletar
					));									
					break;
					
				}else{
						
					$colunas[] = array(
						$editar,
						$deletar
					);
					$linhas[] = $colunas;
					
				}
								
			}
	
		}		
	
		return ( $apenasLinha !== false ) ? $colunas : Html::montarColunas($linhas);
		
	}
	
	//AÇÕES
	function cadastrarTipodocumentounico($idTipodocumentounico, $post = array()){
		
		//CARREGAR DO POST
		$nome = ($post['nome']);
			 if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
		
		$class = ($post['class']);
			 if( $class == '' ) return array(false, MSG_OBRIGAT." Class");
				
		//SETAR
		$this
			 -> set_nomeTipodocumentounico($nome)
			 -> set_classTipodocumentounico($class);
		
		if( $idTipodocumentounico ){			
			$this -> set_idTipodocumentounico($idTipodocumentounico);			
			return ( $this -> updateTipodocumentounico() );
		}else{			
			return ( $this -> insertTipodocumentounico() );			
		}

	}
		
	function deletarTipodocumentounico($idTipodocumentounico) {
		$this -> set_idTipodocumentounico($idTipodocumentounico);	
		return (	$this -> deleteTipodocumentounico() );
	}
	
}

