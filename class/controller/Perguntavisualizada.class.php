<?php
class Perguntavisualizada extends Perguntavisualizada_m {
		
	//CONSTRUTOR
	function __construct($idPerguntavisualizada = "") {
		parent::__construct($idPerguntavisualizada);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectPerguntavisualizada_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("P.id", "P. AS legenda");
		$array = $this -> selectPerguntavisualizada($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultiplePerguntavisualizada_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("P.id", "P. AS legenda");
		$array = $this -> selectPerguntavisualizada($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxPerguntavisualizada_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectPerguntavisualizada($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	/*function tabelaPerguntavisualizada_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectPerguntavisualizada($where, array("P.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linhass = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Candidato_escrito = new Candidato_escrito( $this -> get_candidato_escrito_idPerguntavisualizada() );
				$colunas[] = $Candidato_escrito -> get_idCandidato_escrito();
				$Escrito_pergunta = new Escrito_pergunta( $this -> get_escrito_pergunta_idPerguntavisualizada() );
				$colunas[] = $Escrito_pergunta -> get_idEscrito_pergunta();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idPerguntavisualizada=".$this -> get_idPerguntavisualizada();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idPerguntavisualizada=".$this -> get_idPerguntavisualizada() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idPerguntavisualizada() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
		
	}*/
	
	//AÇÕES
	function cadastrarPerguntavisualizada($idPerguntavisualizada, $post = array()){
		
		//CARREGAR DO POST
		$candidato_escrito_id = ($post['candidato_escrito_id']);
		if( $candidato_escrito_id == '' ) return array(false, MSG_OBRIGAT." Candato Escrito");
		
		$escrito_pergunta_id = ($post['escrito_pergunta_id']);
		if( $escrito_pergunta_id == '' ) return array(false, MSG_OBRIGAT." Escrito Pergunta");
				
		//SETAR
		$this
			 -> set_candidato_escrito_idPerguntavisualizada($candidato_escrito_id)
			 -> set_escrito_pergunta_idPerguntavisualizada($escrito_pergunta_id);
		
		if( $idPerguntavisualizada ){			
			$this -> set_idPerguntavisualizada($idPerguntavisualizada);			
			return ( $this -> updatePerguntavisualizada() );
		}else{			
			return ( $this -> insertPerguntavisualizada() );			
		}

	}
		
	function deletarPerguntavisualizada($idPerguntavisualizada) {
		$this -> set_idPerguntavisualizada($idPerguntavisualizada);	
		return (	$this -> deletePerguntavisualizada() );
	}
  
  function marcarPergunta($post){
    //return false;
    if (!$this -> get_idPerguntavisualizada()) {          
      $rs =  $this -> cadastrarPerguntavisualizada("", $post);      
      if ($rs[0] == false) {
        //Uteis::fecharNivel();
        Uteis::alertJava("Não é possível responder essa questão");
      }
    }
  }   
  	
}

