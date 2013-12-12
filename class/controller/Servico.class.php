<?php
class Servico extends Servico_m {
		
	//CONSTRUTOR
	function __construct($idServico = "") {
		parent::__construct($idServico);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectServico_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("id", "descricao AS legenda");
		$array = $this -> selectServico($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleServico_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("id", "descricao AS legenda");
		$array = $this -> selectServico($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxServico_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND S.excluido = 0";
		$campos = array("id", "hash AS legenda");
		$array = $this -> selectServico($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaServico_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectServico($where, array("S.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
				/*$Servico = new Servico( $this -> get_servico_idServico() );
					$colunas[] = $Servico -> get_idServico();*/
				$colunas[] = $this -> get_descricaoServico();				
				$Empresa = new Empresa( $this -> get_empresa_idServico() );
					$colunas[] = $Empresa -> get_nomeFantasiaEmpresa();
				$Idioma = new Idioma( $this -> get_idioma_idServico() );
					$colunas[] = $Idioma -> get_nomeIdioma();				
				$colunas[] = $this -> get_dataInicioServico()." - ".$this -> get_dataValidadeServico();				
				$colunas[] = $this -> get_temOralServico(true);
				$colunas[] = $this -> get_temEscritoServico(true);
				$colunas[] = $this -> get_temRedacaoServico(true);
				$colunas[] = $this -> get_temResultadoFinalServico(true);
				
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idServico=".$this -> get_idServico();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idServico=".$this -> get_idServico() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idServico() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	
  function tabelaConteudo_html( $servico_id ){
      
    $this->__construct($servico_id);
    
    if( $this->get_temEscritoServico() ){
      
    }
    
    if( $this->get_temOralServico() ){
      
    }
    
    if( $this->get_temRedacaoServico() ){
      
    }
  }
  
	//AÇÕES
	function cadastrarServico($idServico, $post = array()){
		
		//CARREGAR DO POST
		$empresa_id = ($post['empresa_id']);
		if( $empresa_id == '' ) return array(false, MSG_OBRIGAT." Empresa");
		
		$idioma_id = ($post['idioma_id']);
		if( $idioma_id == '' ) return array(false, MSG_OBRIGAT." Idioma");
		
		$servico_id = ($post['servico_id']);
		
		$descricao = ($post['descricao']);
		if( $descricao == '' ) return array(false, MSG_OBRIGAT." Descrição");
		
		$dataInicio = ($post['dataInicio']);
		if( $dataInicio == '' ) return array(false, MSG_OBRIGAT." Data Inicio");
		
		$dataValidade = ($post['dataValidade']);
		if( $dataValidade == '' ) return array(false, MSG_OBRIGAT." Data Validade");
		
		$temOral = ($post['temOral']);
		
		$temEscrito = ($post['temEscrito']);
		
		$temRedacao = ($post['temRedacao']);
		
		$temResultadoFinal = ($post['temResultadoFinal']);
		
		$obs = ($post['obs']);
		
		$hash = ($post['hash']);
		//if( $hash == '' ) return array(false, MSG_OBRIGAT." Hash");
				
		//SETAR
		$this
			 -> set_empresa_idServico($empresa_id)
			 -> set_idioma_idServico($idioma_id)
			 -> set_servico_idServico($servico_id)
			 -> set_descricaoServico($descricao)
			 -> set_dataInicioServico($dataInicio)
			 -> set_dataValidadeServico($dataValidade)
			 -> set_temOralServico($temOral)
			 -> set_temEscritoServico($temEscrito)
			 -> set_temRedacaoServico($temRedacao)
			 -> set_temResultadoFinalServico($temResultadoFinal)
			 -> set_obsServico($obs)
			 -> set_hashServico();
		
		if( $idServico ){			
			$this -> set_idServico($idServico);			
			return ( $this -> updateServico() );
		}else{			
			return ( $this -> insertServico() );			
		}

	}
		
	function deletarServico($idServico) {
		$this -> set_idServico($idServico);	
		return (	$this -> deleteServico() );
	}
	
}

