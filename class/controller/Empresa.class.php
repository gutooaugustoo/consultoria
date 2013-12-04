<?php
class Empresa extends Empresa_m {
		
	//CONSTRUTOR
	function __construct($idEmpresa = "") {
		parent::__construct($idEmpresa);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectEmpresa_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "ie AS legenda");
		$array = $this -> selectEmpresa($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleEmpresa_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "ie AS legenda");
		$array = $this -> selectEmpresa($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxEmpresa_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "ie AS legenda");
		$array = $this -> selectEmpresa($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaEmpresa_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectEmpresa($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_razaoSocialEmpresa();
				$colunas[] = $this -> get_nomeFantasiaEmpresa();
				$colunas[] = $this -> get_cnpjEmpresa();				
				$colunas[] = $this -> get_inativoEmpresa(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idEmpresa=".$this -> get_idEmpresa();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idEmpresa=".$this -> get_idEmpresa() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idEmpresa() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarEmpresa($idEmpresa, $post = array()){
		
		//CARREGAR DO POST
		$razaoSocial = ($post['razaoSocial']);
		if( $razaoSocial == '' ) return array(false, MSG_OBRIGAT." Razao Social");
		
		$nomeFantasia = ($post['nomeFantasia']);
		if( $nomeFantasia == '' ) return array(false, MSG_OBRIGAT." Nome Fantasia");
		
		$cnpj = ($post['cnpj']);
		if( $cnpj == '' ) return array(false, MSG_OBRIGAT." Cnpj");
		
		$logo = ($post['logo']);
				
		$ie = ($post['ie']);
		
		$inativo = ($post['inativo']);
				
		//SETAR
		$this
			 -> set_razaoSocialEmpresa($razaoSocial)
			 -> set_nomeFantasiaEmpresa($nomeFantasia)
			 -> set_cnpjEmpresa($cnpj)
			 -> set_logoEmpresa($logo)
			 -> set_ieEmpresa($ie)
			 -> set_inativoEmpresa($inativo);
		
		if( $idEmpresa ){			
			$this -> set_idEmpresa($idEmpresa);			
			return ( $this -> updateEmpresa() );
		}else{			
			return ( $this -> insertEmpresa() );			
		}

	}
		
	function deletarEmpresa($idEmpresa) {
		$this -> set_idEmpresa($idEmpresa);	
		return (	$this -> deleteEmpresa() );
	}
	
}

