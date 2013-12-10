<?php
class Resp_verdadeirofalso extends Resp_verdadeirofalso_m {
		
	//CONSTRUTOR
	function __construct($idResp_verdadeirofalso = "") {
		parent::__construct($idResp_verdadeirofalso);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectResp_verdadeirofalso_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", "resposta AS legenda");
		$array = $this -> selectResp_verdadeirofalso($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleResp_verdadeirofalso_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", "resposta AS legenda");
		$array = $this -> selectResp_verdadeirofalso($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxResp_verdadeirofalso_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", "resposta AS legenda");
		$array = $this -> selectResp_verdadeirofalso($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaResp_verdadeirofalso_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectResp_verdadeirofalso($where, array("R.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_respostaResp_verdadeirofalso();
				$colunas[] = $this -> get_verdadeiroFalsoResp_verdadeirofalso(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idResp_verdadeirofalso=".$this -> get_idResp_verdadeirofalso();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idResp_verdadeirofalso=".$this -> get_idResp_verdadeirofalso() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idResp_verdadeirofalso() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarResp_verdadeirofalso($idResp_verdadeirofalso, $post = array()){
		
		//CARREGAR DO POST
		$pergunta_id = ($post['pergunta_id']);
		if( $pergunta_id == '' ) return array(false, MSG_OBRIGAT." Pergunta");
		
		$ordem = ($post['ordem']);
		
		$verdadeiroFalso = ($post['verdadeiroFalso']);
		
		$resposta = ($post['resposta']);
		if( $resposta == '' ) return array(false, MSG_OBRIGAT." Resposta");
				
		//SETAR
		$this
			 -> set_pergunta_idResp_verdadeirofalso($pergunta_id)
			 -> set_ordemResp_verdadeirofalso($ordem)
			 -> set_verdadeiroFalsoResp_verdadeirofalso($verdadeiroFalso)
			 -> set_respostaResp_verdadeirofalso($resposta);
		
		if( $idResp_verdadeirofalso ){			
			$this -> set_idResp_verdadeirofalso($idResp_verdadeirofalso);			
			return ( $this -> updateResp_verdadeirofalso() );
		}else{			
			return ( $this -> insertResp_verdadeirofalso() );			
		}

	}
		
	function deletarResp_verdadeirofalso($idResp_verdadeirofalso) {
		$this -> set_idResp_verdadeirofalso($idResp_verdadeirofalso);	
		return (	$this -> deleteResp_verdadeirofalso() );
	}
	
}

