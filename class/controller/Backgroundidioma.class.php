<?php
class Backgroundidioma extends Backgroundidioma_m {
		
	//CONSTRUTOR
	function __construct($idBackgroundidioma = "") {
		parent::__construct($idBackgroundidioma);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectBackgroundidioma_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND B.excluido = 0";
		$campos = array("id", "quantoTempo AS legenda");
		$array = $this -> selectBackgroundidioma($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleBackgroundidioma_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND B.excluido = 0";
		$campos = array("id", "quantoTempo AS legenda");
		$array = $this -> selectBackgroundidioma($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxBackgroundidioma_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND B.excluido = 0";
		$campos = array("id", "quantoTempo AS legenda");
		$array = $this -> selectBackgroundidioma($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaBackgroundidioma_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectBackgroundidioma($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Escola = new Escola( $this -> get_escola_idBackgroundidioma() );
				$colunas[] = $Escola -> get_nomeEscola();
				$Idioma = new Idioma( $this -> get_idioma_idBackgroundidioma() );
				$colunas[] = $Idioma -> get_nomeIdioma();
								
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idBackgroundidioma=".$this -> get_idBackgroundidioma();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idBackgroundidioma=".$this -> get_idBackgroundidioma() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idBackgroundidioma() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarBackgroundidioma($idBackgroundidioma, $post = array()){
		
		//CARREGAR DO POST
		$candidato_id = ($post['candidato_id']);
		if( $candidato_id == '' ) return array(false, MSG_OBRIGAT." Candato");
		
		$escola_id = ($post['escola_id']);
		if( $escola_id == '' ) return array(false, MSG_OBRIGAT." Escola");
		
		$idioma_id = ($post['idioma_id']);
		if( $idioma_id == '' ) return array(false, MSG_OBRIGAT." ioma");
		
		$haQuantoTempo = ($post['haQuantoTempo']);
		if( $haQuantoTempo == '' ) return array(false, MSG_OBRIGAT." Ha Quanto Tempo");
		
		$quantoTempo = ($post['quantoTempo']);
		if( $quantoTempo == '' ) return array(false, MSG_OBRIGAT." Quanto Tempo");
		
		$obs = ($post['obs']);
				
		//SETAR
		$this
			 -> set_candidato_idBackgroundidioma($candidato_id)
			 -> set_escola_idBackgroundidioma($escola_id)
			 -> set_idioma_idBackgroundidioma($idioma_id)
			 -> set_haQuantoTempoBackgroundidioma($haQuantoTempo)
			 -> set_quantoTempoBackgroundidioma($quantoTempo)
			 -> set_obsBackgroundidioma($obs);
		
		if( $idBackgroundidioma ){			
			$this -> set_idBackgroundidioma($idBackgroundidioma);			
			return ( $this -> updateBackgroundidioma() );
		}else{			
			return ( $this -> insertBackgroundidioma() );			
		}

	}
		
	function deletarBackgroundidioma($idBackgroundidioma) {
		$this -> set_idBackgroundidioma($idBackgroundidioma);	
		return (	$this -> deleteBackgroundidioma() );
	}
	
}

