<?php
class Teste extends Teste_m {
		
	//CONSTRUTOR
	function __construct($idTeste) {
		parent::__construct($idTeste);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectTeste_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND excluido = 0";
		$campos = array("id AS id", "primeiroCampo AS legenda");
		$array = $this->selectTeste($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleTeste_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND excluido = 0";
		$campos = array("id AS id", "primeiroCampo AS legenda");
		$array = $this->selectTeste($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxTeste_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND excluido = 0";
		$campos = array("id AS id", "primeiroCampo AS legenda");
		$array = $this->selectTeste($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaTeste_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this->selectTeste($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();				
				
				$this->idTeste = $iten['id'];
				$this->campoStringTeste = $iten['campoString'];
				$this->campoTextTeste = $iten['campoText'];
				$this->campoIntTeste = $iten['campoInt'];
				$this->campoBoolTeste = $iten['campoBool'];
				$this->campoDateTeste = $iten['campoDate'];
				$this->campoDoubleTeste = $iten['campoDouble'];
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;				
				
				$urlAux = "?ordem=".$ordem."&tabela=".Html::get_idTabela();
				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idTeste=".$this->idTeste;
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" onclick=\"abrirNivelPagina(this, '".$caminho."form.php?idTeste=".$this->idTeste."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" onclick=\"deletaRegistro('".$caminho."acao.php".$urlAux."', '".$this->idTeste."', '$atualizarFinal', '$ondeAtualizar')\">";							
				
				$colunas[] = $this->get_campoStringTeste();
				$colunas[] = $this->get_campoTextTeste();
				$colunas[] = $this->get_campoIntTeste();
				$colunas[] = $this->get_campoBoolTeste(true);
				$colunas[] = $this->get_campoDateTeste();
				$colunas[] = $this->get_campoDoubleTeste(true);
							
				if( $apenasLinha !== false ){
						
					$colunas[] = implode(ICON_SEPARATOR, array(
						$editar,
						$deletar
					));									
					break;
					
				}else{
						
					$colunas[] = array(
						$editar,
						$deletar
					);
					$linhas[] = $colunas;
					
				}
								
			}
	
		}		
	
		return ( $apenasLinha !== false ) ? $colunas : Html::montarColunas($linhas);
		
	}
	
	//AÇÕES
	function cadastrarTeste($idTeste, $post = array()){
		
		//CARREGAR DO POST
		$campoString = ($post['campoString']);
		if( $campoString == '' ) return array(false, MSG_OBRIGAT."  Campo String");
		
		$campoText = ($post['campoText']);
		if( $campoText == '' ) return array(false, MSG_OBRIGAT."  Campo Text");
		
		$campoInt = ($post['campoInt']);
		if( $campoInt == '' ) return array(false, MSG_OBRIGAT."  Campo Int");
		
		$campoBool = ($post['campoBool']);
		
		$campoDate = ($post['campoDate']);
		if( $campoDate == '' ) return array(false, MSG_OBRIGAT."  Campo Date");
		
		$campoDouble = ($post['campoDouble']);
		if( $campoDouble == '' ) return array(false, MSG_OBRIGAT."  Campo Double");
				
		//SETAR
		$this
			->set_campoStringTeste($campoString)
			->set_campoTextTeste($campoText)
			->set_campoIntTeste($campoInt)
			->set_campoBoolTeste($campoBool)
			->set_campoDateTeste($campoDate)
			->set_campoDoubleTeste($campoDouble);
		
		if( $idTeste ){			
			$this->set_idTeste($idTeste);			
			return array($this->updateTeste(), MSG_CADUP);
		}else{			
			return array($this->insertTeste(), MSG_CADNEW);			
		}

	}
		
	function deletarTeste($idTeste) {
		$this->set_idTeste($idTeste);	
		return array(	$this->deleteTeste(), MSG_CADDEL);
	}
	
}

