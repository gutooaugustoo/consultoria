<?php
class Endereco extends Endereco_m {
		
	//CONSTRUTOR
	function __construct($idEndereco = "") {
		parent::__construct($idEndereco);	
	}

	function __destruct(){
		parent::__destruct();
	}

	//GERAR ELEMENTOS
	function selectEndereco_html($nomeId, $idAtual = "", $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "cidadeEstrangeira AS legenda");
		$array = $this -> selectEndereco($where, $campos);
		return Html::select($nomeId, $idAtual, $array);
	}
	
	function selectMultipleEndereco_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "cidadeEstrangeira AS legenda");
		$array = $this -> selectEndereco($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}
	
	/*function checkBoxEndereco_html($nomeId, $idAtual = array(), $where = "WHERE 1 ") {
		$where .= " AND E.excluido = 0";
		$campos = array("id", "cidadeEstrangeira AS legenda");
		$array = $this -> selectEndereco($where, $campos);
		return Html::selectMultiple($nomeId, $idAtual, $array);
	}*/
			
	function tabelaEndereco_html($where = "", $caminho = "", $atualizar = "", $ondeAtualizar = "", $campos = array("*"), $apenasLinha = false){
			
		$array = $this -> selectEndereco($where, $campos);
		
		if( $array ){
				
			$cont = 0;				
			$linha = array();
						
			foreach($array as $iten){
					
				$colunas = array();
				
				//CARREGAR VALORES
				$this -> __construct($iten['id']); 				
					
				$Pais = new Pais( $this -> get_pais_idEndereco() );
				$colunas[] = $Pais -> get_idPais();
				$Cidade = new Cidade( $this -> get_cidade_idEndereco() );
				$colunas[] = $Cidade -> get_idCidade();
				$colunas[] = $this -> get_bairroEndereco();
				$colunas[] = $this -> get_numeroEndereco();
				$colunas[] = $this -> get_cepEndereco();
				$colunas[] = $this -> get_complementoEndereco();
								
				$ordem = ( $apenasLinha !== false ) ? $apenasLinha : $cont++;								
				$urlAux = "&ordem=".$ordem."&tabela=".Html::get_idTabela();				
				$atualizarFinal = $atualizar.$urlAux."&tr=1&idEndereco=".$this -> get_idEndereco();
						
				$editar = "<img src=\"".CAM_IMG."editar.png\" title=\"Editar registro\" 
				onclick=\"abrirNivelPagina(this, '".$caminho."abas.php?idEndereco=".$this -> get_idEndereco() ."', '$atualizarFinal', '$ondeAtualizar')\" >";
				
				$deletar = "<img src=\"".CAM_IMG."excluir.png\" title=\"Excluir registro\" 
				onclick=\"deletaRegistro('".$caminho."acao.php?".$urlAux."', '".$this -> get_idEndereco() ."', '$atualizarFinal', '$ondeAtualizar')\">";							
					
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
	function cadastrarEndereco($idEndereco, $post = array()){
		
		//CARREGAR DO POST
		$pessoa_id = ($post['pessoa_id']);
		
		$empresa_id = ($post['empresa_id']);
		
		$pais_id = ($post['pais_id']);
			 if( $pais_id == '' ) return array(false, MSG_OBRIGAT." Pais");
		
		$cidade_id = ($post['cidade_id']);
		
		$bairro = ($post['bairro']);
			 if( $bairro == '' ) return array(false, MSG_OBRIGAT." Bairro");
		
		$numero = ($post['numero']);
			 if( $numero == '' ) return array(false, MSG_OBRIGAT." Numero");
		
		$cep = ($post['cep']);
			 if( $cep == '' ) return array(false, MSG_OBRIGAT." Cep");
		
		$complemento = ($post['complemento']);
		
		$cidadeEstrangeira = ($post['cidadeEstrangeira']);
				
		//SETAR
		$this
			 -> set_pessoa_idEndereco($pessoa_id)
			 -> set_empresa_idEndereco($empresa_id)
			 -> set_pais_idEndereco($pais_id)
			 -> set_cidade_idEndereco($cidade_id)
			 -> set_bairroEndereco($bairro)
			 -> set_numeroEndereco($numero)
			 -> set_cepEndereco($cep)
			 -> set_complementoEndereco($complemento)
			 -> set_cidadeEstrangeiraEndereco($cidadeEstrangeira);
		
		if( $idEndereco ){			
			$this -> set_idEndereco($idEndereco);			
			return ( $this -> updateEndereco() );
		}else{			
			return ( $this -> insertEndereco() );			
		}

	}
		
	function deletarEndereco($idEndereco) {
		$this -> set_idEndereco($idEndereco);	
		return (	$this -> deleteEndereco() );
	}
	
}

