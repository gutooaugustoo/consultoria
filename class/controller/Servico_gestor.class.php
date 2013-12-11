<?php
class Servico_gestor extends Servico_gestor_m {
		
	//CONSTRUTOR
	function __construct($idServico_gestor = "") {
		parent::__construct($idServico_gestor);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectServico_gestor_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectServico_gestor($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleServico_gestor_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectServico_gestor($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxServico_gestor_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectServico_gestor($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaServico_gestor_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectServico_gestor($where, array("S.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Servico = new Servico( $this -> get_servico_idServico_gestor() );
				$colunas[] = $Servico -> get_idServico();
				$Gestor = new Gestor( $this -> get_gestor_idServico_gestor() );
				$colunas[] = $Gestor -> get_idGestor();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idServico_gestor=".$this -> get_idServico_gestor();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idServico_gestor=".$this -> get_idServico_gestor() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idServico_gestor() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarServico_gestor($idServico_gestor, $post = array()){
		
		//CARREGAR DO POST
		$servico_id = ($post['servico_id']);
		if( $servico_id == '' ) return array(false, MSG_OBRIGAT." Servico");
		
		$gestor_id = ($post['gestor_id']);
		if( $gestor_id == '' ) return array(false, MSG_OBRIGAT." Gestor");
				
		//SETAR
		$this
			 -> set_servico_idServico_gestor($servico_id)
			 -> set_gestor_idServico_gestor($gestor_id);
		
		if( $idServico_gestor ){			
			$this -> set_idServico_gestor($idServico_gestor);			
			return ( $this -> updateServico_gestor() );
		}else{			
			return ( $this -> insertServico_gestor() );			
		}

	}
		
	function deletarServico_gestor($idServico_gestor) {
		$this -> set_idServico_gestor($idServico_gestor);	
		return (	$this -> deleteServico_gestor() );
	}
	
}

