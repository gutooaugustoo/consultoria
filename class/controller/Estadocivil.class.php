<?php
class Estadocivil extends Estadocivil_m {
		
	//CONSTRUTOR
	function __construct($idEstadocivil = "") {
		parent::__construct($idEstadocivil);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectEstadocivil_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectEstadocivil($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleEstadocivil_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectEstadocivil($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxEstadocivil_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectEstadocivil($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaEstadocivil_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectEstadocivil($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomeEstadocivil();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idEstadocivil=".$this -> get_idEstadocivil();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idEstadocivil=".$this -> get_idEstadocivil() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idEstadocivil() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarEstadocivil($idEstadocivil, $post = array()){
		
		//CARREGAR DO POST
		$nome = ($post['nome']);
			 if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
				
		//SETAR
		$this
			 -> set_nomeEstadocivil($nome);
		
		if( $idEstadocivil ){			
			$this -> set_idEstadocivil($idEstadocivil);			
			return ( $this -> updateEstadocivil() );
		}else{			
			return ( $this -> insertEstadocivil() );			
		}

	}
		
	function deletarEstadocivil($idEstadocivil) {
		$this -> set_idEstadocivil($idEstadocivil);	
		return (	$this -> deleteEstadocivil() );
	}
	
}

