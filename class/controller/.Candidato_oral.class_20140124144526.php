<?php
class Candidato_oral extends Candidato_oral_m {
		
	//CONSTRUTOR
	function __construct($idCandidato_oral = "") {
		parent::__construct($idCandidato_oral);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectCandidato_oral_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("C.id", "C. AS legenda");
		$array = $this -> selectCandidato_oral($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleCandidato_oral_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("C.id", "C. AS legenda");
		$array = $this -> selectCandidato_oral($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxCandidato_oral_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectCandidato_oral($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaCandidato_oral_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectCandidato_oral($where, array("C.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Servico_candidato = new Servico_candidato( $this -> get_servico_candidato_idCandidato_oral() );
				$colunas[] = $Servico_candidato -> get_idServico_candidato();
				$Servico_avaliador = new Servico_avaliador( $this -> get_servico_avaliador_idCandidato_oral() );
				$colunas[] = $Servico_avaliador -> get_idServico_avaliador();
				$colunas[] = $this -> get_videoCandidato_oral();
				$colunas[] = $this -> get_finalizadoCandidato_oral(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idCandidato_oral=".$this -> get_idCandidato_oral();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idCandidato_oral=".$this -> get_idCandidato_oral() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idCandidato_oral() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarCandidato_oral($idCandidato_oral, $post = array()){
		
		//CARREGAR DO POST
		$servico_candidato_id = ($post['servico_candidato_id']);
		if( $servico_candidato_id == '' ) return array(false, MSG_OBRIGAT." Servico Candato");
		
		$servico_avaliador_id = ($post['servico_avaliador_id']);
		if( $servico_avaliador_id == '' ) return array(false, MSG_OBRIGAT." Servico Avaliador");
		
		$video = ($post['video']);
		
		$finalizado = ($post['finalizado']);
				
		//SETAR
		$this
			 -> set_servico_candidato_idCandidato_oral($servico_candidato_id)
			 -> set_servico_avaliador_idCandidato_oral($servico_avaliador_id)
			 -> set_videoCandidato_oral($video)
			 -> set_finalizadoCandidato_oral($finalizado);
		
		if( $idCandidato_oral ){			
			$this -> set_idCandidato_oral($idCandidato_oral);			
			return ( $this -> updateCandidato_oral() );
		}else{			
			return ( $this -> insertCandidato_oral() );			
		}

	}
		
	function deletarCandidato_oral($idCandidato_oral) {
		$this -> set_idCandidato_oral($idCandidato_oral);	
		return (	$this -> deleteCandidato_oral() );
	}
	
}

