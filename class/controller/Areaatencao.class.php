<?php
class Areaatencao extends Areaatencao_m {
		
	//CONSTRUTOR
	function __construct($idAreaatencao = "") {
		parent::__construct($idAreaatencao);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectAreaatencao_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND A.excluido = 0";
		$campos = array("id", "descricao AS legenda");
		$array = $this -> selectAreaatencao($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleAreaatencao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND A.excluido = 0";
		$campos = array("id", "descricao AS legenda");
		$array = $this -> selectAreaatencao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxAreaatencao_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND A.excluido = 0";
		$campos = array("id", "descricao AS legenda");
		$array = $this -> selectAreaatencao($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaAreaatencao_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectAreaatencao($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Idioma = new Idioma( $this -> get_idioma_idAreaatencao() );
				$colunas[] = $Idioma -> get_nomeIdioma();
				$colunas[] = $this -> get_descricaoAreaatencao();
				$colunas[] = $this -> get_inativoAreaatencao(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idAreaatencao=".$this -> get_idAreaatencao();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idAreaatencao=".$this -> get_idAreaatencao() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idAreaatencao() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarAreaatencao($idAreaatencao, $post = array()){
		
		//CARREGAR DO POST
		$idioma_id = ($post['idioma_id']);
		if( $idioma_id == '' ) return array(false, MSG_OBRIGAT." ioma");
		
		$descricao = ($post['descricao']);
		if( $descricao == '' ) return array(false, MSG_OBRIGAT." Descricao");
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_idioma_idAreaatencao($idioma_id)
			 -> set_descricaoAreaatencao($descricao)
			 -> set_inativoAreaatencao($inativo);
		
		if( $idAreaatencao ){			
			$this -> set_idAreaatencao($idAreaatencao);			
			return ( $this -> updateAreaatencao() );
		}else{			
			return ( $this -> insertAreaatencao() );			
		}

	}
		
	function deletarAreaatencao($idAreaatencao) {
		$this -> set_idAreaatencao($idAreaatencao);	
		return (	$this -> deleteAreaatencao() );
	}
	
}

