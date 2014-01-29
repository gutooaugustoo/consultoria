<?php
class Porcentagemcorte_m extends Database { 
	
	// ATRIBUTOS
	protected $escrito_idPorcentagemcorte;
	protected $porcentagemPorcentagemcorte;
	
	//CONSTRUTOR
	function __construct( $idPorcentagemcorte = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idPorcentagemcorte) ){
		
			$array = $this -> selectPorcentagemcorte(" WHERE P.id = ".$this -> gravarBD($idPorcentagemcorte) );			
			
			$this -> escrito_idPorcentagemcorte = $array[0]['escrito_id'];
			$this -> porcentagemPorcentagemcorte = $array[0]['porcentagem'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_escrito_idPorcentagemcorte($valor) {
		$this -> escrito_idPorcentagemcorte = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_porcentagemPorcentagemcorte($valor) {
		$this -> porcentagemPorcentagemcorte = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_escrito_idPorcentagemcorte() {
		return ($this -> escrito_idPorcentagemcorte);
	}
	
	function get_porcentagemPorcentagemcorte() {
		return ($this -> porcentagemPorcentagemcorte);
	}
				
	//MANUSEANDO O BANCO
		
	function insertPorcentagemcorte() {
		$sql = "INSERT INTO porcentagemcorte 
		(porcentagem) 
		VALUES (	
			" . $this -> porcentagemPorcentagemcorte . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deletePorcentagemcorte() {
		return $this -> updateCampoPorcentagemcorte(array("excluido" => "1"), MSG_CADDEL);
	}

	function updatePorcentagemcorte() {
		if( $this -> idPorcentagemcorte ){
				
			return $this -> updateCampoPorcentagemcorte(
				array(		
					"porcentagem" => $this -> porcentagemPorcentagemcorte				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoPorcentagemcorte($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idPorcentagemcorte && is_array($sets) ){
			$sql = "UPDATE porcentagemcorte SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idPorcentagemcorte;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectPorcentagemcorte($where = "", $campos = array("P.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM porcentagemcorte AS P ".$where;
		return $this -> executarQuery($sql);
	}
		
}
