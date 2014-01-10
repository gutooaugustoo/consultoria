<?php
class Escrito_pergunta_randomica extends Escrito_pergunta_randomica_m {
		
	//CONSTRUTOR
	function __construct($idEscrito_pergunta_randomica = "") {
		parent::__construct($idEscrito_pergunta_randomica);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectEscrito_pergunta_randomica_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("E.id", "E. AS legenda");
		$array = $this -> selectEscrito_pergunta_randomica($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleEscrito_pergunta_randomica_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("E.id", "E. AS legenda");
		$array = $this -> selectEscrito_pergunta_randomica($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxEscrito_pergunta_randomica_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectEscrito_pergunta_randomica($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaEscrito_pergunta_randomica_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectEscrito_pergunta_randomica($where, array("E.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
								
				$Idioma = new Idioma( $this -> get_idioma_idEscrito_pergunta_randomica() );
        $colunas[] = $Idioma -> get_nomeIdioma();        
        $Nivelpergunta = new Nivelpergunta( $this -> get_nivelPergunta_idEscrito_pergunta_randomica() );
				$colunas[] = $Nivelpergunta -> get_nomeNivelpergunta();
				$Categoriapergunta = new Categoriapergunta( $this -> get_categoriaPergunta_idEscrito_pergunta_randomica() );
				$colunas[] = $Categoriapergunta -> get_nomeCategoriapergunta();				
				$colunas[] = $this -> get_quantidadeEscrito_pergunta_randomica();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idEscrito_pergunta_randomica=".$this -> get_idEscrito_pergunta_randomica();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idEscrito_pergunta_randomica=".$this -> get_idEscrito_pergunta_randomica() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idEscrito_pergunta_randomica() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarEscrito_pergunta_randomica($idEscrito_pergunta_randomica, $post = array()){
		
		//CARREGAR DO POST
		$escrito_id = ($post['escrito_id']);
		if( $escrito_id == '' ) return array(false, MSG_OBRIGAT." Escrito");
		
		$nivelPergunta_id = ($post['nivelPergunta_id']);
		if( $nivelPergunta_id == '' ) return array(false, MSG_OBRIGAT." Nivel Pergunta");
		
		$categoriaPergunta_id = ($post['categoriaPergunta_id']);
		if( $categoriaPergunta_id == '' ) return array(false, MSG_OBRIGAT." Categoria Pergunta");
		
		$idioma_id = ($post['idioma_id']);
		if( $idioma_id == '' ) return array(false, MSG_OBRIGAT." ioma");
		
		$quantidade = ($post['quantidade']);
		if( $quantidade == '' ) return array(false, MSG_OBRIGAT." Quantade");
	 
     //VERIFICA SE JA EXISTE UM PESO CADASTRADO COM ESSE NIVEL
    $where = " WHERE excluido = 0 AND escrito_id = ".Uteis::escapeRequest($escrito_id). 
    " AND nivelPergunta_id = ".Uteis::escapeRequest($nivelPergunta_id)." 
      AND categoriaPergunta_id = ".Uteis::escapeRequest($categoriaPergunta_id)." 
      AND idioma_id = ".Uteis::escapeRequest($idioma_id);      
    if( $idEscrito_pergunta_randomica ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idEscrito_pergunta_randomica).") ";
    $rs = $this->selectEscrito_pergunta_randomica($where, array("id"));
    if( $rs ) return array(false, "A definição de pergunta randomica selecionada já está vinculada a este teste escrito");
    	
		//SETAR
		$this
			 -> set_escrito_idEscrito_pergunta_randomica($escrito_id)
			 -> set_nivelPergunta_idEscrito_pergunta_randomica($nivelPergunta_id)
			 -> set_categoriaPergunta_idEscrito_pergunta_randomica($categoriaPergunta_id)
			 -> set_idioma_idEscrito_pergunta_randomica($idioma_id)
			 -> set_quantidadeEscrito_pergunta_randomica($quantidade);
		
		if( $idEscrito_pergunta_randomica ){			
			$this -> set_idEscrito_pergunta_randomica($idEscrito_pergunta_randomica);			
			return ( $this -> updateEscrito_pergunta_randomica() );
		}else{			
			return ( $this -> insertEscrito_pergunta_randomica() );			
		}

	}
		
	function deletarEscrito_pergunta_randomica($idEscrito_pergunta_randomica) {
		$this -> set_idEscrito_pergunta_randomica($idEscrito_pergunta_randomica);	
		return (	$this -> deleteEscrito_pergunta_randomica() );
	}
	
}

