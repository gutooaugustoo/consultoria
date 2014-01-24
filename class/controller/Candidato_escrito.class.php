<?php
class Candidato_escrito extends Candidato_escrito_m {
		
	//CONSTRUTOR
	function __construct($idCandidato_escrito = "") {
		parent::__construct($idCandidato_escrito);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectCandidato_escrito_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("C.id", "C. AS legenda");
		$array = $this -> selectCandidato_escrito($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleCandidato_escrito_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("C.id", "C. AS legenda");
		$array = $this -> selectCandidato_escrito($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxCandidato_escrito_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectCandidato_escrito($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	/*function tabelaCandidato_escrito_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectCandidato_escrito($where, array("C.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Escrito = new Escrito( $this -> get_escrito_idCandidato_escrito() );
				$colunas[] = $Escrito -> get_idEscrito();
				$Servico_candidato = new Servico_candidato( $this -> get_servico_candidato_idCandidato_escrito() );
				$colunas[] = $Servico_candidato -> get_idServico_candidato();
				$Servico_avaliador = new Servico_avaliador( $this -> get_servico_avaliador_idCandidato_escrito() );
				$colunas[] = $Servico_avaliador -> get_idServico_avaliador();
				$colunas[] = $this -> get_finalizadoCandidato_escrito(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idCandidato_escrito=".$this -> get_idCandidato_escrito();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idCandidato_escrito=".$this -> get_idCandidato_escrito() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idCandidato_escrito() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
		
	}*/
	
	//AÇÕES
	function cadastrarCandidato_escrito($idCandidato_escrito, $post = array()){
		
		//CARREGAR DO POST
		$escrito_id = ($post['escrito_id']);
		if( $escrito_id == '' ) return array(false, MSG_OBRIGAT." Escrito");
		
		$servico_candidato_id = ($post['servico_candidato_id']);
		if( $servico_candidato_id == '' ) return array(false, MSG_OBRIGAT." Servico Candato");
		
		$servico_avaliador_id = ($post['servico_avaliador_id']);
		
		$finalizado = ($post['finalizado']);
				
		//SETAR
		$this
			 -> set_escrito_idCandidato_escrito($escrito_id)
			 -> set_servico_candidato_idCandidato_escrito($servico_candidato_id)
			 -> set_servico_avaliador_idCandidato_escrito($servico_avaliador_id)
			 -> set_finalizadoCandidato_escrito($finalizado);
		
		if( $idCandidato_escrito ){			
			$this -> set_idCandidato_escrito($idCandidato_escrito);			
			return ( $this -> updateCandidato_escrito() );
		}else{			
			return ( $this -> insertCandidato_escrito() );			
		}

	}
		
	function deletarCandidato_escrito($idCandidato_escrito) {
		$this -> set_idCandidato_escrito($idCandidato_escrito);	
		return (	$this -> deleteCandidato_escrito() );
	}
	
}

