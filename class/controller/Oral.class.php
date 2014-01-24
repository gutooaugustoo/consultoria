<?php
class Oral extends Oral_m {
		
	//CONSTRUTOR
	function __construct($idOral = "") {
		parent::__construct($idOral);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectOral_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("O.id", "O. AS legenda");
		$array = $this -> selectOral($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleOral_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("O.id", "O. AS legenda");
		$array = $this -> selectOral($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxOral_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectOral($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaOral_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectOral($where, array("O.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
								
				$Etapa = new Etapa( $this -> get_etapa_idOral() );
				$colunas[] = $Etapa -> get_etapaEtapa();
								
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idOral=".$this -> get_idOral();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idOral=".$this -> get_idOral() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idOral() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
				if( $apenasLinha !== false ){						
					$colunas[] = implode(ICON_SEPARATOR, array(
						$editar //,	$deletar
					));									
					break;					
				}else{						
					$colunas[] = array(
						$editar //,	$deletar
					);
					$linhas[] = $colunas;					
				}
								
			}
	
		}		
	
		return ( $apenasLinha !== false ) ? $colunas : Html::montarColunas($linhas);
		
	}
	
	//AÇÕES
	function cadastrarOral($idOral, $post = array()){
		
		//CARREGAR DO POST
		$servico_id = ($post['servico_id']);
		if( $servico_id == '' ) return array(false, MSG_OBRIGAT." Serviço");
		
		$etapa_id = ($post['etapa_id']);
		if( $etapa_id == '' ) return array(false, MSG_OBRIGAT." Etapa");
		
		$video = ($post['video']);
		
		$mostrarAnotacao = ($post['mostrarAnotacao']);
		
		$temAreaAtencao = ($post['temAreaAtencao']);
    
    $temPlanoAcao = ($post['temPlanoAcao']);
    
    $local_oral_id = ($post['local_oral_id']);
    if( $local_oral_id == '' ) return array(false, MSG_OBRIGAT." Local");
    				
		//SETAR
		$this
			 -> set_servico_idOral($servico_id)
			 -> set_etapa_idOral($etapa_id)
			 -> set_videoOral($video)
			 -> set_mostrarAnotacaoOral($mostrarAnotacao)
			 -> set_temAreaAtencaoOral($temAreaAtencao)
       -> set_temPlanoAcaoOral($temPlanoAcao)
       ->set_local_oral_idOral($local_oral_id);
		
		if( $idOral ){			
			$this -> set_idOral($idOral);			
			return ( $this -> updateOral() );
		}else{			
			return ( $this -> insertOral() );			
		}

	}
		
	function deletarOral($idOral) {
		$this -> set_idOral($idOral);	
		return (	$this -> deleteOral() );
	}
	
}

