<?php
class Candidato_precadastro_m extends Database { 
	
	// ATRIBUTOS
	protected $emailCandidato_precadastro;
	protected $servico_idCandidato_precadastro;
	protected $nomeCandidato_precadastro;
	
	//CONSTRUTOR
	function __construct( $emailCandidato_precadastro = "" ) {
		
		parent::__construct();
		
		if( is_string($emailCandidato_precadastro) ){
		
			$array = $this -> selectCandidato_precadastro(" WHERE C.email = ".$this -> gravarBD($emailCandidato_precadastro) );			
			
			$this -> emailCandidato_precadastro = $array[0]['email'];
			$this -> servico_idCandidato_precadastro = $array[0]['servico_id'];
			$this -> nomeCandidato_precadastro = $array[0]['nome'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_emailCandidato_precadastro($valor) {
		$this -> emailCandidato_precadastro = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_idCandidato_precadastro($valor) {
		$this -> servico_idCandidato_precadastro = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nomeCandidato_precadastro($valor) {
		$this -> nomeCandidato_precadastro = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_emailCandidato_precadastro() {
		return ($this -> emailCandidato_precadastro);
	}
	
	function get_servico_idCandidato_precadastro() {
		return ($this -> servico_idCandidato_precadastro);
	}
	
	function get_nomeCandidato_precadastro() {
		return ($this -> nomeCandidato_precadastro);
	}
				
	//MANUSEANDO O BANCO
		
	function insertCandidato_precadastro() {
		$sql = "INSERT INTO candidato_precadastro 
		(email, servico_id, nome) 
		VALUES (	
			" . $this -> emailCandidato_precadastro . ", 	
			" . $this -> servico_idCandidato_precadastro . ",
			" . $this -> nomeCandidato_precadastro . "
		)";
		if( $this -> query($sql) ){
			//return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
			return array($this -> emailCandidato_precadastro, MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteCandidato_precadastro() {
		//return $this -> updateCampoCandidato_precadastro(array("excluido" => "1"), MSG_CADDEL);
		 
		if ($this -> emailCandidato_precadastro) {
      $sql = "DELETE FROM candidato_precadastro WHERE email = " . $this -> emailCandidato_precadastro;
      return $this -> query($sql, MSG_CADDEL);
    } else {
      return array(false, MSG_ERR);
    }
	}

	/*function updateCandidato_precadastro() {
		if( $this -> idCandidato_precadastro ){
				
			return $this -> updateCampoCandidato_precadastro(
				array(		
					"servico_id" => $this -> servico_idCandidato_precadastro, 							
					"nome" => $this -> nomeCandidato_precadastro				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}*/
	
	function updateCampoCandidato_precadastro($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> emailCandidato_precadastro && is_array($sets) ){
			$sql = "UPDATE candidato_precadastro SET ".Uteis::montarUpdate($sets)." WHERE email = ".$this -> emailCandidato_precadastro;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectCandidato_precadastro($where = "", $campos = array("C.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM candidato_precadastro AS C ".$where;
		return $this -> executarQuery($sql);
	}
		
}
