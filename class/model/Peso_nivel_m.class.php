<?php
class Peso_nivel_m extends Database { 
	
	// ATRIBUTOS
	protected $idPeso_nivel;
	protected $escrito_idPeso_nivel;
	protected $nivelPergunta_idPeso_nivel;
	protected $pesoPorcentagemPeso_nivel;
	
	//CONSTRUTOR
	function __construct( $idPeso_nivel = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idPeso_nivel) ){
		
			$array = $this -> selectPeso_nivel(" WHERE P.id = ".$this -> gravarBD($idPeso_nivel) );			
			
			$this -> idPeso_nivel = $array[0]['id'];
			$this -> escrito_idPeso_nivel = $array[0]['escrito_id'];
			$this -> nivelPergunta_idPeso_nivel = $array[0]['nivelPergunta_id'];
			$this -> pesoPorcentagemPeso_nivel = $array[0]['pesoPorcentagem'];
			
		}
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idPeso_nivel($valor) {
		$this -> idPeso_nivel = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_escrito_idPeso_nivel($valor) {
		$this -> escrito_idPeso_nivel = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_nivelPergunta_idPeso_nivel($valor) {
		$this -> nivelPergunta_idPeso_nivel = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_pesoPorcentagemPeso_nivel($valor) {
		$this -> pesoPorcentagemPeso_nivel = ($valor) ? $this -> gravarBD( Uteis::gravarMoeda($valor, 2) ) : "NULL";
		return $this;
	}
		
	//GETS
	
	function get_idPeso_nivel() {
		return ($this -> idPeso_nivel);
	}
	
	function get_escrito_idPeso_nivel() {
		return ($this -> escrito_idPeso_nivel);
	}
	
	function get_nivelPergunta_idPeso_nivel() {
		return ($this -> nivelPergunta_idPeso_nivel);
	}
	
	function get_pesoPorcentagemPeso_nivel() {
		return Uteis::formatarMoeda($this -> pesoPorcentagemPeso_nivel, 2);
	}
				
	//MANUSEANDO O BANCO
		
	function insertPeso_nivel() {
		$sql = "INSERT INTO peso_nivel 
		(escrito_id, nivelPergunta_id, pesoPorcentagem) 
		VALUES (	
			" . $this -> escrito_idPeso_nivel . ", 	
			" . $this -> nivelPergunta_idPeso_nivel . ", 	
			" . $this -> pesoPorcentagemPeso_nivel . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deletePeso_nivel() {
		return $this -> updateCampoPeso_nivel(array("excluido" => "1"), MSG_CADDEL);
	}

	function updatePeso_nivel() {
		if( $this -> idPeso_nivel ){
				
			return $this -> updateCampoPeso_nivel(
				array(		
					"escrito_id" => $this -> escrito_idPeso_nivel, 		
					"nivelPergunta_id" => $this -> nivelPergunta_idPeso_nivel, 		
					"pesoPorcentagem" => $this -> pesoPorcentagemPeso_nivel				
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoPeso_nivel($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idPeso_nivel && is_array($sets) ){
			$sql = "UPDATE peso_nivel SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idPeso_nivel;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectPeso_nivel($where = "", $campos = array("P.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM peso_nivel AS P ".$where;
		return $this -> executarQuery($sql);
	}
		
}
