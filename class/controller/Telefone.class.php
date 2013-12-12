<?php
class Telefone extends Telefone_m {
		
	//CONSTRUTOR
	function __construct($idTelefone = "") {
		parent::__construct($idTelefone);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectTelefone_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "numero AS legenda");
		$array = $this -> selectTelefone($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleTelefone_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "numero AS legenda");
		$array = $this -> selectTelefone($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxTelefone_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND T.excluido = 0";
		$campos = array("id", "numero AS legenda");
		$array = $this -> selectTelefone($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaTelefone_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectTelefone($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
								
				$Descricaotelefone = new Descricaotelefone( $this -> get_descricaoTelefone_idTelefone() );
				$colunas[] = $Descricaotelefone->get_nomeDescricaotelefone();			
				$colunas[] = $this -> get_dddTelefone();
				$colunas[] = $this -> get_numeroTelefone();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idTelefone=".$this -> get_idTelefone();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idTelefone=".$this -> get_idTelefone() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idTelefone() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarTelefone($idTelefone, $post = array()){
		
		//CARREGAR DO POST
		$pessoa_id = ($post['pessoa_id']);		
		$empresa_id = ($post['empresa_id']);
		
		if( $pessoa_id == '' && $empresa_id == '' ) return array(false, MSG_ERR);
		
		$descricaoTelefone_id = ($post['descricaoTelefone_id']);
			 if( $descricaoTelefone_id == '' ) return array(false, MSG_OBRIGAT." Descrição Telefone");
		
		$ddd = ($post['ddd']);
			 if( $ddd == '' ) return array(false, MSG_OBRIGAT." Ddd");
		
		$numero = ($post['numero']);
			 if( $numero == '' ) return array(false, MSG_OBRIGAT." Numero");
				
		//SETAR
		$this
			 -> set_pessoa_idTelefone($pessoa_id)
			 -> set_empresa_idTelefone($empresa_id)
			 -> set_descricaoTelefone_idTelefone($descricaoTelefone_id)
			 -> set_dddTelefone($ddd)
			 -> set_numeroTelefone($numero);
		
		if( $idTelefone ){			
			$this -> set_idTelefone($idTelefone);			
			return ( $this -> updateTelefone() );
		}else{			
			return ( $this -> insertTelefone() );			
		}

	}
		
	function deletarTelefone($idTelefone) {
		$this -> set_idTelefone($idTelefone);	
		return (	$this -> deleteTelefone() );
	}
	
}

