<?php
class Servico_candidato extends Servico_candidato_m {
		
	//CONSTRUTOR
	function __construct($idServico_candidato = "") {
		parent::__construct($idServico_candidato);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectServico_candidato_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("S.id", "S. AS legenda");
		$array = $this -> selectServico_candidato($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleServico_candidato_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("S.id", "S. AS legenda");
		$array = $this -> selectServico_candidato($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxServico_candidato_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectServico_candidato($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaServico_candidato_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectServico_candidato($where, array("S.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Candidato = new Candidato( $this -> get_candidato_idServico_candidato() );
				$colunas[] = $Candidato -> get_nomePessoa();
				$colunas[] = $this -> get_dataValidadeServico_candidato();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idServico_candidato=".$this -> get_idServico_candidato();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idServico_candidato=".$this -> get_idServico_candidato() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idServico_candidato() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarServico_candidato($idServico_candidato, $post = array()){
		
		//CARREGAR DO POST
		$servico_id = ($post['servico_id']);
		if( $servico_id == '' ) return array(false, MSG_OBRIGAT." Servico");
		
		$candidato_id = ($post['candidato_id']);
		if( $candidato_id == '' ) return array(false, MSG_OBRIGAT." Candato");
		
		$dataValidade = ($post['dataValidade']);
		if( $dataValidade == '' ) return array(false, MSG_OBRIGAT." Data Validade");
		
    $where = " WHERE excluido = 0 AND candidato_id = ".Uteis::escapeRequest($candidato_id)." AND servico_id = ".Uteis::escapeRequest($servico_id);
    if( $idServico_candidato ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idServico_candidato).") ";
    $rs = $this->selectServico_candidato($where, array("id"));
    if( $rs ) return array(false, "Esse candidato já está vinculado a este serviço");    
    	
		//SETAR
		$this
			 -> set_servico_idServico_candidato($servico_id)
			 -> set_candidato_idServico_candidato($candidato_id)
			 -> set_dataValidadeServico_candidato($dataValidade);
		
		if( $idServico_candidato ){			
			$this -> set_idServico_candidato($idServico_candidato);			
			return ( $this -> updateServico_candidato() );
		}else{			
			return ( $this -> insertServico_candidato() );			
		}

	}
		
	function deletarServico_candidato($idServico_candidato) {
		$this -> set_idServico_candidato($idServico_candidato);	
		return (	$this -> deleteServico_candidato() );
	}
	
}

