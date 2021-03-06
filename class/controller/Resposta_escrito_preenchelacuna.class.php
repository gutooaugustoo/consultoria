<?php
class Resposta_escrito_preenchelacuna extends Resposta_escrito_preenchelacuna_m {
		
	//CONSTRUTOR
	function __construct($idResposta_escrito_preenchelacuna = "") {
		parent::__construct($idResposta_escrito_preenchelacuna);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectResposta_escrito_preenchelacuna_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R.lacuna AS legenda");
		$array = $this -> selectResposta_escrito_preenchelacuna($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleResposta_escrito_preenchelacuna_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R.lacuna AS legenda");
		$array = $this -> selectResposta_escrito_preenchelacuna($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxResposta_escrito_preenchelacuna_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", "lacuna AS legenda");
		$array = $this -> selectResposta_escrito_preenchelacuna($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaResposta_escrito_preenchelacuna_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectResposta_escrito_preenchelacuna($where, array("R.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Candidato_escrito = new Candidato_escrito( $this -> get_candidato_escrito_idResposta_escrito_preenchelacuna() );
				$colunas[] = $Candidato_escrito -> get_idCandidato_escrito();
				$Escrito_pergunta = new Escrito_pergunta( $this -> get_escrito_pergunta_idResposta_escrito_preenchelacuna() );
				$colunas[] = $Escrito_pergunta -> get_idEscrito_pergunta();
				$Resp_preenchelacuna = new Resp_preenchelacuna( $this -> get_resp_preenchelacuna_idResposta_escrito_preenchelacuna() );
				$colunas[] = $Resp_preenchelacuna -> get_idResp_preenchelacuna();
				$colunas[] = $this -> get_lacunaResposta_escrito_preenchelacuna();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idResposta_escrito_preenchelacuna=".$this -> get_idResposta_escrito_preenchelacuna();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idResposta_escrito_preenchelacuna=".$this -> get_idResposta_escrito_preenchelacuna() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idResposta_escrito_preenchelacuna() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarResposta_escrito_preenchelacuna($idResposta_escrito_preenchelacuna, $post = array()){
		
		//CARREGAR DO POST
		$candidato_escrito_id = ($post['candidato_escrito_id']);
		if( $candidato_escrito_id == '' ) return array(false, MSG_OBRIGAT." Candato Escrito");
		
		$escrito_pergunta_id = ($post['escrito_pergunta_id']);
		if( $escrito_pergunta_id == '' ) return array(false, MSG_OBRIGAT." Escrito Pergunta");
		
		$resp_preenchelacuna_id = ($post['resp_preenchelacuna_id']);
		if( $resp_preenchelacuna_id == '' ) return array(false, MSG_OBRIGAT." Resp Preenchelacuna");
		
		$lacuna = ($post['lacuna']);
		//if( $lacuna == '' ) return array(false, MSG_OBRIGAT." Lacuna");
				
		//SETAR
		$this
			 -> set_candidato_escrito_idResposta_escrito_preenchelacuna($candidato_escrito_id)
			 -> set_escrito_pergunta_idResposta_escrito_preenchelacuna($escrito_pergunta_id)
			 -> set_resp_preenchelacuna_idResposta_escrito_preenchelacuna($resp_preenchelacuna_id)
			 -> set_lacunaResposta_escrito_preenchelacuna($lacuna);
		
		if( $idResposta_escrito_preenchelacuna ){			
			$this -> set_idResposta_escrito_preenchelacuna($idResposta_escrito_preenchelacuna);			
			return ( $this -> updateResposta_escrito_preenchelacuna() );
		}else{			
			return ( $this -> insertResposta_escrito_preenchelacuna() );			
		}

	}
		
	function deletarResposta_escrito_preenchelacuna($idResposta_escrito_preenchelacuna) {
		$this -> set_idResposta_escrito_preenchelacuna($idResposta_escrito_preenchelacuna);	
		return (	$this -> deleteResposta_escrito_preenchelacuna() );
	}
	
}

