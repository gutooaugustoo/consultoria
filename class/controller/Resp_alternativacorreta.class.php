<?php
class Resp_alternativacorreta extends Resp_alternativacorreta_m {
		
	//CONSTRUTOR
	function __construct($idResp_alternativacorreta = "") {
		parent::__construct($idResp_alternativacorreta);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectResp_alternativacorreta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", "resposta AS legenda");
		$array = $this -> selectResp_alternativacorreta($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleResp_alternativacorreta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", "resposta AS legenda");
		$array = $this -> selectResp_alternativacorreta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxResp_alternativacorreta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", "resposta AS legenda");
		$array = $this -> selectResp_alternativacorreta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaResp_alternativacorreta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectResp_alternativacorreta($where, array("R.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_respostaResp_alternativacorreta();
				$colunas[] = $this -> get_corretaResp_alternativacorreta(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idResp_alternativacorreta=".$this -> get_idResp_alternativacorreta();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idResp_alternativacorreta=".$this -> get_idResp_alternativacorreta() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idResp_alternativacorreta() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarResp_alternativacorreta($idResp_alternativacorreta, $post = array()){
		
		//CARREGAR DO POST
		$pergunta_id = ($post['pergunta_id']);
		if( $pergunta_id == '' ) return array(false, MSG_OBRIGAT." Pergunta");
		
		$correta = ($post['correta']);
		
		$ordem = ($post['ordem']);
		//if( $ordem == '' ) return array(false, MSG_OBRIGAT." Ordem");
		
		$resposta = ($post['resposta']);
		if( $resposta == '' ) return array(false, MSG_OBRIGAT." Resposta");
				
		//SETAR
		$this
			 -> set_pergunta_idResp_alternativacorreta($pergunta_id)
			 -> set_corretaResp_alternativacorreta($correta)
			 -> set_ordemResp_alternativacorreta($ordem)
			 -> set_respostaResp_alternativacorreta($resposta);
		
		if( $correta ){
			$rs = $this->desmarcarOpcoesCorretas();
			if( !$rs[0] ) return array(false, $rs[1]);
		}
		
		if( $idResp_alternativacorreta ){			
			$this -> set_idResp_alternativacorreta($idResp_alternativacorreta);			
			return ( $this -> updateResp_alternativacorreta() );
		}else{			
			return ( $this -> insertResp_alternativacorreta() );			
		}

	}
		
	function deletarResp_alternativacorreta($idResp_alternativacorreta) {
		$this -> set_idResp_alternativacorreta($idResp_alternativacorreta);	
		return (	$this -> deleteResp_alternativacorreta() );
	}
	
	function desmarcarOpcoesCorretas(){
		if( $this->get_pergunta_idResp_alternativacorreta() ){
			$sql = "UPDATE resp_alternativacorreta SET correta = 0 
			WHERE pergunta_id = ".$this->get_pergunta_idResp_alternativacorreta();
			return $this->query($sql);
		}else{
			return array(false, MSG_ERR);
		}	
	}	
	
}

