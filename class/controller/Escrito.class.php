<?php
class Escrito extends Escrito_m {
		
	//CONSTRUTOR
	function __construct($idEscrito = "") {
		parent::__construct($idEscrito);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectEscrito_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("E.id", "E. AS legenda");
		$array = $this -> selectEscrito($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultipleEscrito_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("E.id", "E. AS legenda");
		$array = $this -> selectEscrito($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxEscrito_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectEscrito($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaEscrito_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectEscrito($where, array("E.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				
				$Etapa = new Etapa( $this -> get_etapa_idEscrito() );
				$colunas[] = $Etapa -> get_etapaEtapa();							
								
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idEscrito=".$this -> get_idEscrito();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idEscrito=".$this -> get_idEscrito() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idEscrito() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
				if( $apenasLinha !== false ){						
					$colunas[] = implode(ICON_SEPARATOR, array(
						$editar //,	$deletar
					));									
					break;					
				}else{						
					$colunas[] = array(
						$editar //,	$deletar
					);
					$linhas[] = $colunas;					
				}
								
			}
	
		}		
	
		return ( $apenasLinha !== false ) ? $colunas : Html::montarColunas($linhas);
		
	}
	
	//AÇÕES
	function cadastrarEscrito($idEscrito, $post = array()){
		
		//CARREGAR DO POST
		$etapa_id = ($post['etapa_id']);
		if( $etapa_id == '' ) return array(false, MSG_OBRIGAT." Etapa");
		
		$tipoEscrito_id = ($post['tipoEscrito_id']);
		if( $tipoEscrito_id == '' ) return array(false, MSG_OBRIGAT." Tipo Escrito");
		
		$servico_id = ($post['servico_id']);
		if( $servico_id == '' ) return array(false, MSG_OBRIGAT." Servico");
				
		$porcentagemCorte = ($post['porcentagemCorte']);
    
    $randomico = ($post['randomico']);
    $temPlanoAcao = ($post['temPlanoAcao']);
			
		//SETAR
		$this
			 -> set_etapa_idEscrito($etapa_id)
			 -> set_tipoEscrito_idEscrito($tipoEscrito_id)
			 -> set_servico_idEscrito($servico_id)
			 -> set_porcentagemCorte($porcentagemCorte)
       -> set_randomicoEscrito($randomico)
       -> set_temPlanoAcaoEscrito($temPlanoAcao);
		
		if( $idEscrito ){			
			$this -> set_idEscrito($idEscrito);			
			return ( $this -> updateEscrito() );
		}else{			
			return ( $this -> insertEscrito() );			
		}

	}
		
	function deletarEscrito($idEscrito) {
		$this -> set_idEscrito($idEscrito);	
		return (	$this -> deleteEscrito() );
	}
	
}

