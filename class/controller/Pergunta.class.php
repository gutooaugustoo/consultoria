<?php
class Pergunta extends Pergunta_m {
		
	//CONSTRUTOR
	function __construct($idPergunta = "") {
		parent::__construct($idPergunta);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectPergunta_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectPergunta($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultiplePergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectPergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxPergunta_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectPergunta($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaPergunta_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectPergunta($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Pergunta = new Pergunta( $this -> get_pergunta_idPergunta() );
				$colunas[] = $Pergunta -> get_idPergunta();
				$Empresa = new Empresa( $this -> get_empresa_idPergunta() );
				$colunas[] = $Empresa -> get_idEmpresa();
				$Idioma = new Idioma( $this -> get_idioma_idPergunta() );
				$colunas[] = $Idioma -> get_idIdioma();
				$Nivelpergunta = new Nivelpergunta( $this -> get_nivelPergunta_idPergunta() );
				$colunas[] = $Nivelpergunta -> get_idNivelpergunta();
				$Categoriapergunta = new Categoriapergunta( $this -> get_categoriaPergunta_idPergunta() );
				$colunas[] = $Categoriapergunta -> get_idCategoriapergunta();
				$colunas[] = $this -> get_enunciadoPergunta();
				$colunas[] = $this -> get_tempoRespostaPergunta();
				$colunas[] = $this -> get_inativoPergunta(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idPergunta=".$this -> get_idPergunta();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idPergunta=".$this -> get_idPergunta() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idPergunta() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarPergunta($idPergunta, $post = array()){
		
		//CARREGAR DO POST
		$pergunta_id = ($post['pergunta_id']);
		
		$empresa_id = ($post['empresa_id']);
		
		$idioma_id = ($post['idioma_id']);
		if( $idioma_id == '' ) return array(false, MSG_OBRIGAT." ioma");
		
		$nivelPergunta_id = ($post['nivelPergunta_id']);
		if( $nivelPergunta_id == '' ) return array(false, MSG_OBRIGAT." Nivel Pergunta");
		
		$categoriaPergunta_id = ($post['categoriaPergunta_id']);
		if( $categoriaPergunta_id == '' ) return array(false, MSG_OBRIGAT." Categoria Pergunta");
		
		$enunciado = ($post['enunciado']);
		if( $enunciado == '' ) return array(false, MSG_OBRIGAT." Enunciado");
		
		$tempoResposta = ($post['tempoResposta']);
		if( $tempoResposta == '' ) return array(false, MSG_OBRIGAT." Tempo Resposta");
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_pergunta_idPergunta($pergunta_id)
			 -> set_empresa_idPergunta($empresa_id)
			 -> set_idioma_idPergunta($idioma_id)
			 -> set_nivelPergunta_idPergunta($nivelPergunta_id)
			 -> set_categoriaPergunta_idPergunta($categoriaPergunta_id)
			 -> set_enunciadoPergunta($enunciado)
			 -> set_tempoRespostaPergunta($tempoResposta)
			 -> set_inativoPergunta($inativo);
		
		if( $idPergunta ){			
			$this -> set_idPergunta($idPergunta);			
			return ( $this -> updatePergunta() );
		}else{			
			return ( $this -> insertPergunta() );			
		}

	}
		
	function deletarPergunta($idPergunta) {
		$this -> set_idPergunta($idPergunta);	
		return (	$this -> deletePergunta() );
	}
	
}
