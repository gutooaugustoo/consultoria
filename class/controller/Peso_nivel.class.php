<?php
class Peso_nivel extends Peso_nivel_m {
		
	//CONSTRUTOR
	function __construct($idPeso_nivel = "") {
		parent::__construct($idPeso_nivel);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectPeso_nivel_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("P.id", "P. AS legenda");
		$array = $this -> selectPeso_nivel($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	/*function selectMultiplePeso_nivel_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("P.id", "P. AS legenda");
		$array = $this -> selectPeso_nivel($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
	
	/*function checkBoxPeso_nivel_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND P.excluido = 0";
		$campos = array("id", " AS legenda");
		$array = $this -> selectPeso_nivel($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaPeso_nivel_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $apenasLinha = false){
			
		$array = $this -> selectPeso_nivel($where, array("P.id"));
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
								
				$Nivelpergunta = new Nivelpergunta( $this -> get_nivelPergunta_idPeso_nivel() );
				$colunas[] = $Nivelpergunta -> get_nomeNivelpergunta();
				$colunas[] = $this -> get_pesoPorcentagemPeso_nivel()."%";
				
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idPeso_nivel=".$this -> get_idPeso_nivel();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idPeso_nivel=".$this -> get_idPeso_nivel() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idPeso_nivel() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarPeso_nivel($idPeso_nivel, $post = array()){
		
		//CARREGAR DO POST
		$escrito_id = ($post['escrito_id']);
		if( $escrito_id == '' ) return array(false, MSG_OBRIGAT." Escrito");
		
		$nivelPergunta_id = ($post['nivelPergunta_id']);
		if( $nivelPergunta_id == '' ) return array(false, MSG_OBRIGAT." Nivel Pergunta");
		
		//VERIFICA SE JA EXISTE UM PESO CADASTRADO COM ESSE NIVEL
    $where = " WHERE excluido = 0 AND nivelPergunta_id = ".Uteis::escapeRequest($nivelPergunta_id)." AND escrito_id = ".Uteis::escapeRequest($escrito_id);
    if( $idPeso_nivel ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idPeso_nivel).") ";
    $rs = $this->selectPeso_nivel($where, array("id"));
    if( $rs ) return array(false, "O nivel da pergunta já está vinculado a este teste escrito");    
    
		$pesoPorcentagem = ($post['pesoPorcentagem']);
    if( $pesoPorcentagem == '' ) return array(false, MSG_OBRIGAT." Peso Porcentagem");
    
    //VERIFICAR SE A SOMA DE TODOS OS PESOS NAO EXCEDE 100%
    $where = " WHERE excluido = 0 AND escrito_id = ".Uteis::escapeRequest($escrito_id);
    if( $idPeso_nivel ) $where .= " AND id NOT IN (".Uteis::escapeRequest($idPeso_nivel).") ";
    $rs = $this->selectPeso_nivel($where, array("pesoPorcentagem"));    
    $totalSoma = 0;
    foreach ($rs as $value) $totalSoma += $value['pesoPorcentagem'];                       
    if( ($totalSoma+$pesoPorcentagem) > 100) return array(false, "A porcentagem deve ser menor ou igual a ".(100-$totalSoma));
        
		//SETAR
		$this
			 -> set_escrito_idPeso_nivel($escrito_id)
			 -> set_nivelPergunta_idPeso_nivel($nivelPergunta_id)
			 -> set_pesoPorcentagemPeso_nivel($pesoPorcentagem);
		
		if( $idPeso_nivel ){			
			$this -> set_idPeso_nivel($idPeso_nivel);			
			return ( $this -> updatePeso_nivel() );
		}else{			
			return ( $this -> insertPeso_nivel() );			
		}

	}
		
	function deletarPeso_nivel($idPeso_nivel) {
		$this -> set_idPeso_nivel($idPeso_nivel);	
		return (	$this -> deletePeso_nivel() );
	}
	
}

