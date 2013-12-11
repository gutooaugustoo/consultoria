<?php
class Redacao extends Redacao_m {
		
	//CONSTRUTOR
	function __construct($idRedacao = "") {
		parent::__construct($idRedacao);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectRedacao_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectRedacao($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleRedacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectRedacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxRedacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectRedacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaRedacao_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectRedacao($where, array("R.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
								
				$Etapa = new Etapa( $this -> get_etapa_idRedacao() );
				$colunas[] = $Etapa -> get_etapaEtapa();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idRedacao=".$this -> get_idRedacao();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idRedacao=".$this -> get_idRedacao() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idRedacao() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarRedacao($idRedacao, $post = array()){
		
		//CARREGAR DO POST
		$servico_id = ($post['servico_id']);
		if( $servico_id == '' ) return array(false, MSG_OBRIGAT." Servico");
		
		$etapa_id = ($post['etapa_id']);
		if( $etapa_id == '' ) return array(false, MSG_OBRIGAT." Etapa");
		
		$tempoParaFinalizacao = ($post['tempoParaFinalizacao']);
		if( $tempoParaFinalizacao == '' ) return array(false, MSG_OBRIGAT." Tempo Para Finalizacao");
		
		$minimoLinhas = ($post['minimoLinhas']);
		if( $minimoLinhas == '' ) return array(false, MSG_OBRIGAT." Minimo Linhas");
		
		$maximoLinhas = ($post['maximoLinhas']);
		if( $maximoLinhas == '' ) return array(false, MSG_OBRIGAT." Maximo Linhas");
				
		//SETAR
		$this
			 -> set_servico_idRedacao($servico_id)
			 -> set_etapa_idRedacao($etapa_id)
			 -> set_tempoParaFinalizacaoRedacao($tempoParaFinalizacao)
			 -> set_minimoLinhasRedacao($minimoLinhas)
			 -> set_maximoLinhasRedacao($maximoLinhas);
		
		if( $idRedacao ){			
			$this -> set_idRedacao($idRedacao);			
			return ( $this -> updateRedacao() );
		}else{			
			return ( $this -> insertRedacao() );			
		}

	}
		
	function deletarRedacao($idRedacao) {
		$this -> set_idRedacao($idRedacao);	
		return (	$this -> deleteRedacao() );
	}
	
}

