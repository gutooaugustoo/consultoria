<?php
class Resposta_escrito_associeresposta extends Resposta_escrito_associeresposta_m {
		
	//CONSTRUTOR
	function __construct($idResposta_escrito_associeresposta = "") {
		parent::__construct($idResposta_escrito_associeresposta);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectResposta_escrito_associeresposta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectResposta_escrito_associeresposta($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleResposta_escrito_associeresposta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectResposta_escrito_associeresposta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxResposta_escrito_associeresposta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectResposta_escrito_associeresposta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaResposta_escrito_associeresposta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectResposta_escrito_associeresposta($where, array("R.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Candidato_escrito = new Candidato_escrito( $this -> get_candidato_escrito_idResposta_escrito_associeresposta() );
				$colunas[] = $Candidato_escrito -> get_idCandidato_escrito();
				$Escrito_pergunta = new Escrito_pergunta( $this -> get_escrito_pergunta_idResposta_escrito_associeresposta() );
				$colunas[] = $Escrito_pergunta -> get_idEscrito_pergunta();
				$Resp_associeresposta = new Resp_associeresposta( $this -> get_resp_associeResposta_idResposta_escrito_associeresposta() );
				$colunas[] = $Resp_associeresposta -> get_idResp_associeresposta();
				$colunas[] = $this -> get_ordemResposta_escrito_associeresposta();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idResposta_escrito_associeresposta=".$this -> get_idResposta_escrito_associeresposta();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idResposta_escrito_associeresposta=".$this -> get_idResposta_escrito_associeresposta() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idResposta_escrito_associeresposta() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarResposta_escrito_associeresposta($idResposta_escrito_associeresposta, $post = array()){
		
		//CARREGAR DO POST
		$candidato_escrito_id = ($post['candidato_escrito_id']);
		if( $candidato_escrito_id == '' ) return array(false, MSG_OBRIGAT." Candato Escrito");
		
		$escrito_pergunta_id = ($post['escrito_pergunta_id']);
		if( $escrito_pergunta_id == '' ) return array(false, MSG_OBRIGAT." Escrito Pergunta");
		
		$resp_associeResposta_id = ($post['resp_associeResposta_id']);
		if( $resp_associeResposta_id == '' ) return array(false, MSG_OBRIGAT." Resp Associe Resposta");
		
		$ordem = ($post['ordem']);
		if( $ordem == '' ) return array(false, MSG_OBRIGAT." Ordem");
				
		//SETAR
		$this
			 -> set_candidato_escrito_idResposta_escrito_associeresposta($candidato_escrito_id)
			 -> set_escrito_pergunta_idResposta_escrito_associeresposta($escrito_pergunta_id)
			 -> set_resp_associeResposta_idResposta_escrito_associeresposta($resp_associeResposta_id)
			 -> set_ordemResposta_escrito_associeresposta($ordem);
		
		if( $idResposta_escrito_associeresposta ){			
			$this -> set_idResposta_escrito_associeresposta($idResposta_escrito_associeresposta);			
			return ( $this -> updateResposta_escrito_associeresposta() );
		}else{			
			return ( $this -> insertResposta_escrito_associeresposta() );			
		}

	}
		
	function deletarResposta_escrito_associeresposta($idResposta_escrito_associeresposta) {
		$this -> set_idResposta_escrito_associeresposta($idResposta_escrito_associeresposta);	
		return (	$this -> deleteResposta_escrito_associeresposta() );
	}
	
}

