<?php
class Resposta_escritorand_alternativacorreta extends Resposta_escritorand_alternativacorreta_m {
		
	//CONSTRUTOR
	function __construct($idResposta_escritorand_alternativacorreta = "") {
		parent::__construct($idResposta_escritorand_alternativacorreta);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectResposta_escritorand_alternativacorreta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectResposta_escritorand_alternativacorreta($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleResposta_escritorand_alternativacorreta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectResposta_escritorand_alternativacorreta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxResposta_escritorand_alternativacorreta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectResposta_escritorand_alternativacorreta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	/*function tabelaResposta_escritorand_alternativacorreta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectResposta_escritorand_alternativacorreta($where, array("R.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Candidato_escrito_randomica_com_pergunta = new Candidato_escrito_randomica_com_pergunta( $this -> get_candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta() );
				$colunas[] = $Candidato_escrito_randomica_com_pergunta -> get_idCandidato_escrito_randomica_com_pergunta();
				$Resp_alternativacorreta = new Resp_alternativacorreta( $this -> get_resp_alternativacorreta_idResposta_escritorand_alternativacorreta() );
				$colunas[] = $Resp_alternativacorreta -> get_idResp_alternativacorreta();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idResposta_escritorand_alternativacorreta=".$this -> get_idResposta_escritorand_alternativacorreta();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idResposta_escritorand_alternativacorreta=".$this -> get_idResposta_escritorand_alternativacorreta() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idResposta_escritorand_alternativacorreta() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	*/
	//AÇÕES
	function cadastrarResposta_escritorand_alternativacorreta($idResposta_escritorand_alternativacorreta, $post = array()){
		
		//CARREGAR DO POST
		$candidato_escrito_randomica_com_pergunta_id = ($post['candidato_escrito_randomica_com_pergunta_id']);
		if( $candidato_escrito_randomica_com_pergunta_id == '' ) return array(false, MSG_OBRIGAT." Candato Escrito Randomica Com Pergunta");
		
		$resp_alternativacorreta_id = ($post['resp_alternativacorreta_id']);
		if( $resp_alternativacorreta_id == '' ) return array(false, MSG_OBRIGAT." Resp Alternativacorreta");
				
		//SETAR
		$this
			 -> set_candidato_escrito_randomica_com_pergunta_idResposta_escritorand_alternativacorreta($candidato_escrito_randomica_com_pergunta_id)
			 -> set_resp_alternativacorreta_idResposta_escritorand_alternativacorreta($resp_alternativacorreta_id);
		
		if( $idResposta_escritorand_alternativacorreta ){			
			$this -> set_idResposta_escritorand_alternativacorreta($idResposta_escritorand_alternativacorreta);			
			return ( $this -> updateResposta_escritorand_alternativacorreta() );
		}else{			
			return ( $this -> insertResposta_escritorand_alternativacorreta() );			
		}

	}
		
	function deletarResposta_escritorand_alternativacorreta($idResposta_escritorand_alternativacorreta) {
		$this -> set_idResposta_escritorand_alternativacorreta($idResposta_escritorand_alternativacorreta);	
		return (	$this -> deleteResposta_escritorand_alternativacorreta() );
	}
	
}

