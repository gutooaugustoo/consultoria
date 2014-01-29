<?php
class Escrito_m extends Database { 
	
	// ATRIBUTOS
	protected $idEscrito;
	protected $etapa_idEscrito;
	protected $tipoEscrito_idEscrito;
	protected $servico_idEscrito;
  protected $porcentagemCorte;
	protected $randomicoEscrito = 0;
	protected $temPlanoAcaoEscrito = 0;
  
	//CONSTRUTOR
	function __construct( $idEscrito = "" ) {
		
		parent::__construct();
		
		if( is_numeric($idEscrito) ){		
			$array = $this -> selectEscrito(" WHERE E.id = ".$this -> gravarBD($idEscrito) );						
		}elseif( $idEscrito != "" ){
		  $array = $this -> selectEscrito($idEscrito." LIMIT 1");
		}
    
    if( $array ){
      $this -> idEscrito = $array[0]['id'];
      $this -> etapa_idEscrito = $array[0]['etapa_id'];
      $this -> tipoEscrito_idEscrito = $array[0]['tipoEscrito_id'];
      $this -> servico_idEscrito = $array[0]['servico_id'];
      $this -> porcentagemCorte = $array[0]['porcentagemCorte'];
      $this -> randomicoEscrito = $array[0]['randomico'];
      $this -> temPlanoAcaoEscrito = $array[0]['temPlanoAcao'];
    }
    
	}

	function __destruct(){
		parent::__destruct();
	}
		
	//SETS
	
	function set_idEscrito($valor) {
		$this -> idEscrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_etapa_idEscrito($valor) {
		$this -> etapa_idEscrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_tipoEscrito_idEscrito($valor) {
		$this -> tipoEscrito_idEscrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_servico_idEscrito($valor) {
		$this -> servico_idEscrito = ($valor) ? $this -> gravarBD($valor) : "NULL";
		return $this;
	}
	
	function set_porcentagemCorte($valor) {	     	 
		$this -> porcentagemCorte = ($valor) ? $this -> gravarBD( Uteis::gravarMoeda($valor, 2) ) : "NULL";
		return $this;
	}
  
  function set_randomicoEscrito($valor) {
    $this -> randomicoEscrito = ($valor) ? $this -> gravarBD($valor) : "0";
    return $this;
  }
  
  function set_temPlanoAcaoEscrito($valor) {
    $this -> temPlanoAcaoEscrito = ($valor) ? $this -> gravarBD($valor) : "0";
    return $this;
  }
		
	//GETS
	
	function get_idEscrito() {
		return ($this -> idEscrito);
	}
	
	function get_etapa_idEscrito() {
		return ($this -> etapa_idEscrito);
	}
	
	function get_tipoEscrito_idEscrito() {
		return ($this -> tipoEscrito_idEscrito);
	}
	
	function get_servico_idEscrito() {
		return ($this -> servico_idEscrito);
	}
    
	function get_porcentagemCorte() {
    return Uteis::formatarMoeda($this -> porcentagemCorte, true);
  }
  
	function get_randomicoEscrito($mostrarImagem = false) {
		return !$mostrarImagem ? $this -> randomicoEscrito : Uteis::exibirStatus($this -> randomicoEscrito);
	}
  
  function get_temPlanoAcaoEscrito($mostrarImagem = false) {
    return !$mostrarImagem ? $this -> temPlanoAcaoEscrito : Uteis::exibirStatus($this -> temPlanoAcaoEscrito);
  }
				
	//MANUSEANDO O BANCO
		
	function insertEscrito() {
		$sql = "INSERT INTO escrito 
		(etapa_id, tipoEscrito_id, servico_id, porcentagemCorte, randomico, temPlanoAcao) 
		VALUES (	
			" . $this -> etapa_idEscrito . ", 	
			" . $this -> tipoEscrito_idEscrito . ", 	
			" . $this -> servico_idEscrito . ", 	
			" . $this -> porcentagemCorte . ",
			" . $this -> randomicoEscrito . ",
			" . $this -> temPlanoAcaoEscrito . "
		)";
		if( $this -> query($sql) ){
			return array(mysql_insert_id($this -> connectDB), MSG_CADNEW);
		}else{
			return array(false, MSG_ERR);
		}		
	}
	
	function deleteEscrito() {
		return $this -> updateCampoEscrito(array("excluido" => "1"), MSG_CADDEL);
	}

	function updateEscrito() {
		if( $this -> idEscrito ){
				
			return $this -> updateCampoEscrito(
				array(		
					"etapa_id" => $this -> etapa_idEscrito, 		
					"tipoEscrito_id" => $this -> tipoEscrito_idEscrito, 		
					"servico_id" => $this -> servico_idEscrito, 		
					"porcentagemCorte" => $this -> porcentagemCorte,		
					"randomico" => $this -> randomicoEscrito,
					"temPlanoAcao" => $this -> temPlanoAcaoEscrito,
				)	
			);
			
		}else{
			return array(false, MSG_ERR);
		}
	}
	
	function updateCampoEscrito($sets = array(), $msg = MSG_CADUP) {		
		if( $this -> idEscrito && is_array($sets) ){
			$sql = "UPDATE escrito SET ".Uteis::montarUpdate($sets)." WHERE id = ".$this -> idEscrito;							
			return $this -> query($sql, $msg);
		}else{
			return array(false, MSG_ERR);
		}
	}

	function selectEscrito($where = "", $campos = array("E.*") ) {	
		$sql = "SELECT SQL_CACHE ".implode(",", $campos)." FROM escrito AS E ".$where;
		return $this -> executarQuery($sql);
	}
		
}
