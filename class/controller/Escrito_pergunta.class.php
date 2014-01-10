<?php
class Escrito_pergunta extends Escrito_pergunta_m {
		
	//CONSTRUTOR
	function __construct($idEscrito_pergunta = "") {
		parent::__construct($idEscrito_pergunta);    
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectEscrito_pergunta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("E.id", "E. AS legenda");
		$array = $this -> selectEscrito_pergunta($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleEscrito_pergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("E.id", "E. AS legenda");
		$array = $this -> selectEscrito_pergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxEscrito_pergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectEscrito_pergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaEscrito_pergunta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectEscrito_pergunta($where, array("E.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_ordemEscrito_pergunta();				
				        
        $Pergunta = new Pergunta( $this -> get_pergunta_idEscrito_pergunta() );
        $Tipopergunta = new Tipopergunta( $Pergunta->get_tipoPergunta_idPergunta() );
        
        $colunas[] = $Tipopergunta -> get_descricaoTipopergunta();
				$colunas[] = $Pergunta -> get_tituloPergunta();				
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idEscrito_pergunta=".$this -> get_idEscrito_pergunta();
						
				/*$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idEscrito_pergunta=".$this -> get_idEscrito_pergunta() ."', '$atualizarFinal', '$ondeAtualizar')\" >";*/
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idEscrito_pergunta() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
				if( $apenasLinha !== false ){						
					$colunas[] = implode(ICON_SEPARATOR, array(
						//$editar,	
						$deletar
					));									
					break;					
				}else{						
					$colunas[] = array(
						//$editar,	
						$deletar
					);
					$linhas[] = $colunas;					
				}
								
			}
	
		}		
	
		return ( $apenasLinha !== false ) ? $colunas : Html::montarColunas($linhas);
		
	}
	
	//AÇÕES
	function cadastrarEscrito_pergunta($idEscrito_pergunta, $post = array()){
		
		//CARREGAR DO POST
		$escrito_id = ($post['escrito_id']);
		if( $escrito_id == '' ) return array(false, MSG_OBRIGAT." Escrito");
		
		$pergunta_id = ($post['pergunta_id']);
		if( $pergunta_id == '' ) return array(false, MSG_OBRIGAT." Pergunta");
	 
    //VERIFICA SE JA EXISTE UM PESO CADASTRADO COM ESSE NIVEL
    $where = " WHERE excluido = 0 AND pergunta_id = ".Uteis::escapeRequest($pergunta_id)." AND escrito_id = ".Uteis::escapeRequest($escrito_id);
    if( $idEscrito_pergunta ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idEscrito_pergunta).") ";
    $rs = $this->selectEscrito_pergunta($where, array("id"));
    if( $rs ) return array(false, "A pergunta já está vinculada a este teste escrito");
    			
		//SETAR
		$this
			 -> set_escrito_idEscrito_pergunta($escrito_id)
			 -> set_pergunta_idEscrito_pergunta($pergunta_id);       
			 
		if( $idEscrito_pergunta ){			
			$this->set_idEscrito_pergunta($idEscrito_pergunta);			
			return ( $this -> updateEscrito_pergunta() );
		}else{
		  $this-> set_ordemEscrito_pergunta( $this->get_proximaOrdem() );			
			return ( $this -> insertEscrito_pergunta() );			
		}

	}
		
	function deletarEscrito_pergunta($idEscrito_pergunta) {
		$this -> set_idEscrito_pergunta($idEscrito_pergunta);	
		return (	$this -> deleteEscrito_pergunta() );
	}
  
  function get_proximaOrdem() {
    if ($this -> escrito_idEscrito_pergunta){
      $rs = $this -> selectEscrito_pergunta(" WHERE excluido = 0 AND escrito_id = " . $this -> escrito_idEscrito_pergunta . " ORDER BY ordem DESC");
      return ($rs ? $rs[0]['ordem'] : "0") + 1;
    }    
  }
  	
}

