<?php
class Candidato_redacao extends Candidato_redacao_m {
		
	//CONSTRUTOR
	function __construct($idCandidato_redacao = "") {
		parent::__construct($idCandidato_redacao);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectCandidato_redacao_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("C.id", "C. AS legenda");
		$array = $this -> selectCandidato_redacao($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleCandidato_redacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("C.id", "C. AS legenda");
		$array = $this -> selectCandidato_redacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxCandidato_redacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectCandidato_redacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaCandidato_redacao_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectCandidato_redacao($where, array("C.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Redacao = new Redacao( $this -> get_redacao_idCandidato_redacao() );
				$colunas[] = $Redacao -> get_idRedacao();
				$Redacao_temaredacao = new Redacao_temaredacao( $this -> get_redacao_temaRedacao_idCandidato_redacao() );
				$colunas[] = $Redacao_temaredacao -> get_idRedacao_temaredacao();
				$Servico_candidato = new Servico_candidato( $this -> get_servico_candidato_idCandidato_redacao() );
				$colunas[] = $Servico_candidato -> get_idServico_candidato();
				$Servico_avaliador = new Servico_avaliador( $this -> get_servico_avaliador_idCandidato_redacao() );
				$colunas[] = $Servico_avaliador -> get_idServico_avaliador();
				$colunas[] = $this -> get_redacaoCandidato_redacao();
				$colunas[] = $this -> get_correcaoCandidato_redacao();
				$colunas[] = $this -> get_finalizadoCandidato_redacao(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idCandidato_redacao=".$this -> get_idCandidato_redacao();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idCandidato_redacao=".$this -> get_idCandidato_redacao() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idCandidato_redacao() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarCandidato_redacao($idCandidato_redacao, $post = array()){
		
		//CARREGAR DO POST
		$redacao_id = ($post['redacao_id']);
		if( $redacao_id == '' ) return array(false, MSG_OBRIGAT." Redacao");
		
		$redacao_temaRedacao_id = ($post['redacao_temaRedacao_id']);
		if( $redacao_temaRedacao_id == '' ) return array(false, MSG_OBRIGAT." Redacao Tema Redacao");
		
		$servico_candidato_id = ($post['servico_candidato_id']);
		if( $servico_candidato_id == '' ) return array(false, MSG_OBRIGAT." Servico Candato");
		
		$servico_avaliador_id = ($post['servico_avaliador_id']);
		
		$redacao = ($post['redacao']);
		if( $redacao == '' ) return array(false, MSG_OBRIGAT." Redacao");
		
		$correcao = ($post['correcao']);
		
		$finalizado = ($post['finalizado']);
				
		//SETAR
		$this
			 -> set_redacao_idCandidato_redacao($redacao_id)
			 -> set_redacao_temaRedacao_idCandidato_redacao($redacao_temaRedacao_id)
			 -> set_servico_candidato_idCandidato_redacao($servico_candidato_id)
			 -> set_servico_avaliador_idCandidato_redacao($servico_avaliador_id)
			 -> set_redacaoCandidato_redacao($redacao)
			 -> set_correcaoCandidato_redacao($correcao)
			 -> set_finalizadoCandidato_redacao($finalizado);
		
		if( $idCandidato_redacao ){			
			$this -> set_idCandidato_redacao($idCandidato_redacao);			
			return ( $this -> updateCandidato_redacao() );
		}else{			
			return ( $this -> insertCandidato_redacao() );			
		}

	}
		
	function deletarCandidato_redacao($idCandidato_redacao) {
		$this -> set_idCandidato_redacao($idCandidato_redacao);	
		return (	$this -> deleteCandidato_redacao() );
	}
	
}

