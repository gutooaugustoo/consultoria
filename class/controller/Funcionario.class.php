<?php
class Funcionario extends Funcionario_m {
		
	//CONSTRUTOR
	function __construct($idFuncionario) {
		parent::__construct($idFuncionario);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectFuncionario_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectFuncionario($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleFuncionario_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectFuncionario($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxFuncionario_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectFuncionario($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaFuncionario_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectFuncionario($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "?ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idFuncionario=".$this -> idFuncionario;
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."form.php?idFuncionario=".$this -> idFuncionario."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php".$urlAux."', '".$this -> idFuncionario."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarFuncionario($idFuncionario, $post = array()){
		
		//CARREGAR DO POST		
		//SETAR
		$this;
		
		if( $idFuncionario ){			
			$this -> set_idFuncionario($idFuncionario);			
			return ( $this -> updateFuncionario() );
		}else{			
			return ( $this -> insertFuncionario() );			
		}

	}
		
	function deletarFuncionario($idFuncionario) {
		$this -> set_idFuncionario($idFuncionario);	
		return (	$this -> deleteFuncionario() );
	}
	
}

