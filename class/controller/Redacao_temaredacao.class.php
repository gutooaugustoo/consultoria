<?php
class Redacao_temaredacao extends Redacao_temaredacao_m {
		
	//CONSTRUTOR
	function __construct($idRedacao_temaredacao = "") {
		parent::__construct($idRedacao_temaredacao);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectRedacao_temaredacao_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectRedacao_temaredacao($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleRedacao_temaredacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("R.id", "R. AS legenda");
		$array = $this -> selectRedacao_temaredacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxRedacao_temaredacao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND R.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectRedacao_temaredacao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaRedacao_temaredacao_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectRedacao_temaredacao($where, array("R.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				//$Redacao = new Redacao( $this -> get_redacao_idRedacao_temaredacao() );
				//$colunas[] = $Redacao -> get_idRedacao();
				$Temaredacao = new Temaredacao( $this -> get_temaRedacao_idRedacao_temaredacao() );
				$colunas[] = $Temaredacao -> get_tituloTemaredacao();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idRedacao_temaredacao=".$this -> get_idRedacao_temaredacao();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idRedacao_temaredacao=".$this -> get_idRedacao_temaredacao() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idRedacao_temaredacao() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarRedacao_temaredacao($idRedacao_temaredacao, $post = array()){
		
		//CARREGAR DO POST
		$redacao_id = ($post['redacao_id']);
		if( $redacao_id == '' ) return array(false, MSG_OBRIGAT." Redação");
		
		$temaRedacao_id = ($post['temaRedacao_id']);
		if( $temaRedacao_id == '' ) return array(false, MSG_OBRIGAT." Tema Redação");
		
    $where = " WHERE excluido = 0 AND temaRedacao_id = ".Uteis::escapeRequest($temaRedacao_id)." AND redacao_id = ".Uteis::escapeRequest($redacao_id);
    if( $idRedacao_temaredacao ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idRedacao_temaredacao).") ";
    $rs = $this->selectRedacao_temaredacao($where, array("id"));
    if( $rs ) return array(false, "O tema já está vinculado a esta redação");
    	
		//SETAR
		$this
			 -> set_redacao_idRedacao_temaredacao($redacao_id)
			 -> set_temaRedacao_idRedacao_temaredacao($temaRedacao_id);
		
		if( $idRedacao_temaredacao ){			
			$this -> set_idRedacao_temaredacao($idRedacao_temaredacao);			
			return ( $this -> updateRedacao_temaredacao() );
		}else{			
			return ( $this -> insertRedacao_temaredacao() );			
		}

	}
		
	function deletarRedacao_temaredacao($idRedacao_temaredacao) {
		$this -> set_idRedacao_temaredacao($idRedacao_temaredacao);	
		return (	$this -> deleteRedacao_temaredacao() );
	}
	
}

