<?php
class Gestor extends Gestor_m {
		
	//CONSTRUTOR
	function __construct($idGestor = "") {
		parent::__construct($idGestor);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectGestor_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectGestor($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleGestor_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectGestor($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxGestor_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= "";
		$campos = array("id", " AS legenda");
		$array = $this -> selectGestor($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaGestor_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectGestor($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$colunas[] = $this -> get_nomePessoa();
				$Tipodocumentounico = new Tipodocumentounico($this -> get_tipoDocumentoUnico_idPessoa());
				$colunas[] = $this -> get_documentoPessoa() . " (" . $Tipodocumentounico -> get_nomeTipodocumentounico() . ")";
				$colunas[] = $this -> get_inativoPessoa(true);
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idGestor=".$this -> get_idGestor();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idGestor=".$this -> get_idGestor() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idGestor() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarGestor($idGestor, $post = array()){
		
		//CARREGAR DO POST
		$empresa_id = ($post['empresa_id']);
		if( $empresa_id == '' ) return array(false, MSG_ERR);
		
		//SETAR
		$this
			 -> set_empresa_idGestor($empresa_id);
			 
		$rs = $this -> cadastrarPessoa($idGestor, $post);
		
		if ($rs[0] != false) {	
			
			if( $idGestor ){			
				$this -> set_idGestor($idGestor);			
				return ( $this -> updateGestor() );
			}else{
				$this -> set_idGestor($rs[0]);			
				return ( $this -> insertGestor() );			
			}
		}else{
			return $rs;
		}
		
	}
		
	function deletarGestor($idGestor) {
		$this -> set_idGestor($idGestor);	
		return (	$this -> deleteGestor() );
	}
	
}

