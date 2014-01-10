<?php
class Oral_itemanotacaoentrevista extends Oral_itemanotacaoentrevista_m {
		
	//CONSTRUTOR
	function __construct($idOral_itemanotacaoentrevista = "") {
		parent::__construct($idOral_itemanotacaoentrevista);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectOral_itemanotacaoentrevista_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("O.id", "O. AS legenda");
		$array = $this -> selectOral_itemanotacaoentrevista($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleOral_itemanotacaoentrevista_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("O.id", "O. AS legenda");
		$array = $this -> selectOral_itemanotacaoentrevista($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxOral_itemanotacaoentrevista_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND O.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectOral_itemanotacaoentrevista($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaOral_itemanotacaoentrevista_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectOral_itemanotacaoentrevista($where, array("O.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Oral = new Oral( $this -> get_oral_idOral_itemanotacaoentrevista() );
				$colunas[] = $Oral -> get_idOral();
				$Item_anotacaoentrevista = new Item_anotacaoentrevista( $this -> get_item_anotacaoEntrevista_idOral_itemanotacaoentrevista() );
				$colunas[] = $Item_anotacaoentrevista -> get_idItem_anotacaoentrevista();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idOral_itemanotacaoentrevista=".$this -> get_idOral_itemanotacaoentrevista();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idOral_itemanotacaoentrevista=".$this -> get_idOral_itemanotacaoentrevista() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idOral_itemanotacaoentrevista() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarOral_itemanotacaoentrevista($idOral_itemanotacaoentrevista, $post = array()){
		
		//CARREGAR DO POST
		$oral_id = ($post['oral_id']);
		if( $oral_id == '' ) return array(false, MSG_OBRIGAT." Oral");
		
		$item_anotacaoEntrevista_id = ($post['item_anotacaoEntrevista_id']);
		if( $item_anotacaoEntrevista_id == '' ) return array(false, MSG_OBRIGAT." Item Anotacao Entrevista");
				
		//SETAR
		$this
			 -> set_oral_idOral_itemanotacaoentrevista($oral_id)
			 -> set_item_anotacaoEntrevista_idOral_itemanotacaoentrevista($item_anotacaoEntrevista_id);
		
		if( $idOral_itemanotacaoentrevista ){			
			$this -> set_idOral_itemanotacaoentrevista($idOral_itemanotacaoentrevista);			
			return ( $this -> updateOral_itemanotacaoentrevista() );
		}else{			
			return ( $this -> insertOral_itemanotacaoentrevista() );			
		}

	}
		
	function deletarOral_itemanotacaoentrevista($idOral_itemanotacaoentrevista) {
		$this -> set_idOral_itemanotacaoentrevista($idOral_itemanotacaoentrevista);	
		return (	$this -> deleteOral_itemanotacaoentrevista() );
	}
	
}

