<?php
class Modelo extends Modelo_m {
		
	//CONSTRUTOR
	function __construct($id) {
		parent::__construct($id);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function select_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND excluido = 0";
		$campos = array("id AS id", "primeiroCampo AS legenda");
		$array = $this->select($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultiple_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND excluido = 0";
		$campos = array("id AS id", "primeiroCampo AS legenda");
		$array = $this->select($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	function checkBox_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND excluido = 0";
		$campos = array("id AS id", "primeiroCampo AS legenda");
		$array = $this->select($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
			
	function tabela_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
		
		$html = "";
		$cont = 0;
			
		$array = $this->select($where, $campos);
		
		if( $array ){
			
			$html .= "<tbody>";
						
			foreach($array as $iten){				
				
				$this->id = $iten['id'];
				$this->campoString = $iten['campoString'];
				$this->campoText = $iten['campoText'];
				$this->campoInt = $iten['campoInt'];
				$this->campoBool = $iten['campoBool'];
				$this->campoDate = $iten['campoDate'];
				$this->campoDouble = $iten['campoDouble'];
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;				
				
				$urlAux = "?ordem=".$ordem."&tabela=".Html::get_idTabela();
				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&id=".$this->id;
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" onclick=\"abrirNivelPagina(this, '".$caminho."form.php?id=".$this->id."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" onclick=\"deletaRegistro('".$caminho."acao.php".$urlAux."', '".$this->id."', '$atualizarFinal', '$ondeAtualizar')\">";
								
				if( $apenasLinha !== false ){

					$linha = array();
					
					$linha[] = $this->get_campoString();
					$linha[] = $this->get_campoText();
					$linha[] = $this->get_campoInt();
					$linha[] = $this->get_campoBool(true);
					$linha[] = $this->get_campoDate();
					$linha[] = $this->get_campoDouble(true);
					
					$linha[] = $editar;
					$linha[] = $deletar;
										
					break;
					
				}else{

					$html .= "<tr>";
					
					$html .= "<td>".$this->get_campoString()."</td>";
					$html .= "<td>".$this->get_campoText()."</td>";
					$html .= "<td>".$this->get_campoInt()."</td>";
					$html .= "<td>".$this->get_campoBool(true)."</td>";
					$html .= "<td>".$this->get_campoDate()."</td>";
					$html .= "<td>".$this->get_campoDouble(true)."</td>";
					
					$html .= "<td align=\"center\" >$editar</td>";					
					$html .= "<td align=\"center\" >$deletar</td>";
						
					
					$html .= "</tr>";
					
				}
								
			}
			
			$html .= "</tbody>";
			
		}		
	
		return ( $apenasLinha !== false ) ? $linha : Html::montarColunas($html, 2);
		
	}
	
	//AÇÕES
	function cadastrar($id, $post = array()){
		
		//CARREGAR DO POST
		$campoString = $post['campoString'];
		if( $campoString == '' ) return array(false, MSG_OBRIGAT."  Campo String");
		
		$campoText = $post['campoText'];
		if( $campoText == '' ) return array(false, MSG_OBRIGAT."  Campo Text");
		
		$campoInt = $post['campoInt'];
		if( $campoInt == '' ) return array(false, MSG_OBRIGAT."  Campo Int");
		
		$campoBool = $post['campoBool'];
		if( $campoBool == '' ) return array(false, MSG_OBRIGAT."  Campo Bool");
		
		$campoDate = $post['campoDate'];
		if( $campoDate == '' ) return array(false, MSG_OBRIGAT."  Campo Date");
		
		$campoDouble = $post['campoDouble'];
		if( $campoDouble == '' ) return array(false, MSG_OBRIGAT."  Campo Double");
				
		//SETAR
		$this->set_campoString($campoString);
		$this->set_campoText($campoText);
		$this->set_campoInt($campoInt);
		$this->set_campoBool($campoBool);
		$this->set_campoDate($campoDate);
		$this->set_campoDouble($campoDouble);
		
		if( $id ){			
			$this->set_id($id);
			$this->update();
			return array(true, MSG_CADATU);
		}else{
			$id = $this->insert();
			return array($id, MSG_CADNEW);			
		}

	}
		
	function deletar($id) {
		$this->set_id($id);
		$this->delete();
		return array(true, MSG_CADDEL);
	}
	
}

