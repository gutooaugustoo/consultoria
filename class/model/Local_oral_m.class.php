<?php
class Local_oral_m extends Database { 
	
	// ATRIBUTOS
	protected $idLocal_oral;
	protected $localLocal_oral;
	
	//CONSTRUTOR
	function __construct( $idLocal_oral = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idLocal_oral) ){
		
			$array = $this -> selectLocal_oral(" WHERE L.id = ".$this -> gravarBD($idLocal_oral) );			
			
			$this -> idLocal_oral = $array[0]['id'];
			$this -> localLocal_oral = $array[0]['local'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idLocal_oral($valor) {
		$this -> idLocal_oral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_localLocal_oral($valor) {
		$this -> localLocal_oral = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idLocal_oral() {
		return ($this -> idLocal_oral);
	}
	
	function get_localLocal_oral() {
		return ($this -> localLocal_oral);
	}
				
	//MANUSEANDO O BANCO
		
	function insertLocal_oral() {
		$sql = "INSERT INTO local_oral 
		(local) 
		VALUES (	
			" . $this -> localLocal_oral . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connect), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteLocal_oral() {
		return $this -> updateCampoLocal_oral(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateLocal_oral() {
		if( $this -> idLocal_oral ){
				
			return $this -> updateCampoLocal_oral(
				array(		
					"local" => $this -> localLocal_oral				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoLocal_oral($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idLocal_oral && is_array($sets) ){
			$sql = "UPDATE local_oral SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idLocal_oral;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectLocal_oral($where = "", $campos = array("L.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM local_oral AS L ".$where;
		return $this -> executarQuery($sql);
	}
		
}
