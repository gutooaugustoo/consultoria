<?php
class Candidato_precadastro extends Candidato_precadastro_m {
		
	//CONSTRUTOR
	function __construct($emailCandidato_precadastro = "") {
		parent::__construct($emailCandidato_precadastro);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	/*function selectCandidato_precadastro_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("C.id", "C.nome AS legenda");
		$array = $this -> selectCandidato_precadastro($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}*/
	
	/*function selectMultipleCandidato_precadastro_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("C.id", "C.nome AS legenda");
		$array = $this -> selectCandidato_precadastro($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxCandidato_precadastro_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND C.excluido = 0";
		$campos = array("id", "nome AS legenda");
		$array = $this -> selectCandidato_precadastro($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaCandidato_precadastro_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectCandidato_precadastro($where, array("C.email"));
		//Uteis::pr($array);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['email']); 				
				
				$colunas[] = $this -> get_emailCandidato_precadastro();
				$colunas[] = $this -> get_nomeCandidato_precadastro();
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&emailCandidato_precadastro=".$this -> get_emailCandidato_precadastro();
						
				/*$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?email=".$this -> get_emailCandidato_precadastro() ."', '$atualizarFinal', '$ondeAtualizar')\" >";*/
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_emailCandidato_precadastro() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarCandidato_precadastro($emailCandidato_precadastro, $post = array()){
		
		//CARREGAR DO POST		   
    $servico_id = ($post['servico_id']);
    if( $servico_id == '' ) return array(false, MSG_OBRIGAT." Servico");
		
		$nome = ($post['nome']);
		if( $nome == '' ) return array(false, MSG_OBRIGAT." Nome");
	 
    $rs = $this->selectCandidato_precadastro(" WHERE email = ".Uteis::escapeRequest($emailCandidato_precadastro), array("email"));
    if( $rs ) return array(false, "E-mail já cadastrado");
          
		//SETAR
		$this
		  ->set_emailCandidato_precadastro($emailCandidato_precadastro)
			 -> set_servico_idCandidato_precadastro($servico_id)
			 -> set_nomeCandidato_precadastro($nome);
		
    return ( $this -> insertCandidato_precadastro() );
    
		/*if( $idCandidato_precadastro ){			
			$this -> set_idCandidato_precadastro($idCandidato_precadastro);			
			return ( $this -> updateCandidato_precadastro() );
		}else{			
			return ( $this -> insertCandidato_precadastro() );			
		}*/
  
	}
		
	function deletarCandidato_precadastro($emailCandidato_precadastro) {
		$this -> set_emailCandidato_precadastro( $emailCandidato_precadastro );	
		return (	$this -> deleteCandidato_precadastro());
	}
	
}

