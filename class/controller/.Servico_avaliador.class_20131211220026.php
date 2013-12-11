<?php
class Servico_avaliador extends Servico_avaliador_m {
		
	//CONSTRUTOR
	function __construct($idServico_avaliador = "") {
		parent::__construct($idServico_avaliador);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectServico_avaliador_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("S.id", "S. AS legenda");
		$array = $this -> selectServico_avaliador($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleServico_avaliador_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("S.id", "S. AS legenda");
		$array = $this -> selectServico_avaliador($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxServico_avaliador_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectServico_avaliador($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaServico_avaliador_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectServico_avaliador($where, array("S.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
								
				$Avaliador = new Avaliador( $this -> get_avaliador_idServico_avaliador() );
				$colunas[] = $Avaliador -> get_nomePessoa();
				$colunas[] = $this -> get_valorServico_avaliador();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idServico_avaliador=".$this -> get_idServico_avaliador();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idServico_avaliador=".$this -> get_idServico_avaliador() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idServico_avaliador() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarServico_avaliador($idServico_avaliador, $post = array()){
		
		//CARREGAR DO POST
		$servico_id = ($post['servico_id']);
		if( $servico_id == '' ) return array(false, MSG_OBRIGAT." Servico");
		
		$avaliador_id = ($post['avaliador_id']);
		if( $avaliador_id == '' ) return array(false, MSG_OBRIGAT." Avaliador");
		
		$valor = ($post['valor']);
		if( $valor == '' ) return array(false, MSG_OBRIGAT." Valor");
				
		//SETAR
		$this
			 -> set_servico_idServico_avaliador($servico_id)
			 -> set_avaliador_idServico_avaliador($avaliador_id)
			 -> set_valorServico_avaliador($valor);
		
		if( $idServico_avaliador ){			
			$this -> set_idServico_avaliador($idServico_avaliador);			
			return ( $this -> updateServico_avaliador() );
		}else{			
			return ( $this -> insertServico_avaliador() );			
		}

	}
		
	function deletarServico_avaliador($idServico_avaliador) {
		$this -> set_idServico_avaliador($idServico_avaliador);	
		return (	$this -> deleteServico_avaliador() );
	}
	
}

