<?php
class Dicasentrevista extends Dicasentrevista_m {
		
	//CONSTRUTOR
	function __construct($idDicasentrevista = "") {
		parent::__construct($idDicasentrevista);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectDicasentrevista_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND D.excluido = 0";
		$campos = array("id", "titulo AS legenda");
		$array = $this -> selectDicasentrevista($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleDicasentrevista_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND D.excluido = 0";
		$campos = array("id", "titulo AS legenda");
		$array = $this -> selectDicasentrevista($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxDicasentrevista_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND D.excluido = 0";
		$campos = array("id", "titulo AS legenda");
		$array = $this -> selectDicasentrevista($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaDicasentrevista_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectDicasentrevista($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_tituloDicasentrevista();
				$Idioma = new Idioma( $this -> get_idioma_idDicasentrevista() );
				$colunas[] = $Idioma -> get_nomeIdioma();				
				$colunas[] = $this -> get_inativoDicasentrevista(true);
				//$colunas[] = $this -> get_dicaDicasentrevista();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idDicasentrevista=".$this -> get_idDicasentrevista();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idDicasentrevista=".$this -> get_idDicasentrevista() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idDicasentrevista() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarDicasentrevista($idDicasentrevista, $post = array()){
		
		//CARREGAR DO POST
		$idioma_id = ($post['idioma_id']);
		if( $idioma_id == '' ) return array(false, MSG_OBRIGAT." Idioma");
		
		$titulo = ($post['titulo']);
		if( $titulo == '' ) return array(false, MSG_OBRIGAT." Titulo");
		
		$inativo = ($post['inativo']);
		
		$dica = ($post['dica']);
		if( $dica == '' ) return array(false, MSG_OBRIGAT." Dica");
				
		//SETAR
		$this
			 -> set_idioma_idDicasentrevista($idioma_id)
			 -> set_tituloDicasentrevista($titulo)
			 -> set_inativoDicasentrevista($inativo)
			 -> set_dicaDicasentrevista($dica);
		
		if( $idDicasentrevista ){			
			$this -> set_idDicasentrevista($idDicasentrevista);			
			return ( $this -> updateDicasentrevista() );
		}else{			
			return ( $this -> insertDicasentrevista() );			
		}

	}
		
	function deletarDicasentrevista($idDicasentrevista) {
		$this -> set_idDicasentrevista($idDicasentrevista);	
		return (	$this -> deleteDicasentrevista() );
	}
	
}

