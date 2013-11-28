<?php
class Html{
	
	private static $idTabela;
	private static $colunas;
	private static $eventos;
	private static $cssClass;
		
	function __construct() {				
	}
	
	function __destruct(){		
	}
	
	static function set_idTabela($id) {
		self::$idTabela = $id;
	}
	
	static function get_idTabela($id) {
		return self::$idTabela;
	}
	
	static function set_colunas($array = array()) {
		self::$colunas = $array;
	}
	
	static function set_eventos($array = array()) {
		self::$eventos = $array;
	}
	
	static function set_cssClass($array = array()) {
		self::$cssClass = $array;
	}
	
	private function montaClass() {
		
		$html = "";
		
		if( count(self::$cssClass) > 0 ){
			$html .= " class=\"".implode(" ", self::$cssClass)."\"";
		}
		
		return $html;	
	}
	
	private function montaEventos() {
		
		$html = "";
		
		if( count(self::$eventos) > 0 ){
			foreach(self::$eventos as $evento) $html .= " ".$evento[0]."=\"".$evento[1]."\"";
		}
		
		return $html;	
	}
	
	static function select($nomeId, $idAtual, $array){	
		
		$html = "<select name=\"$nomeId\" id=\"$nomeId\" ".self::montaClass()." ".self::montaEventos()." >
		<option value=\"0\">Selecione</option>";
		
		foreach($array as $iten){
			$selecionado = ($idAtual == $iten['id']) ? "selected" : "";
			$html .= "<option value=\"".$iten['id']."\" $selecionado >".$iten['legenda']."</option>";
		}
		
		$html .= "</select>";
		
		self::set_cssClass();
		self::set_eventos();
		
		return $html;		
	}	
	
	static function selectMultiple($nomeId, $idsAtuais = array(), $array){	
		
		$html = "<select name=\"".$nomeId."[]\" id=\"$nomeId\" multiple=\"multiple\" ".self::montaClass()." ".self::montaEventos()." >
		<option value=\"\">Selecione</option>";
		
		foreach($array as $iten){
			$selecionado = (in_array($iten['id'], $idsAtuais)) ? "selected" : "";
			$html .= "<option value=\"".$iten['id']."\" $selecionado >".$iten['legenda']."</option>";
		}
		
		$html .= "</select>";
		
		self::set_cssClass();
		self::set_eventos();
		
		return $html;			
	}	
	
	static function checkbox($nomeId, $idAtual, $array){		
		
		$html = "";
		
		if( $array ){
			foreach($array as $iten){
				$selecionado = (in_array($iten['id'], $idsAtuais)) ? "checked" : "";
				$html .= "<p><input type=\"checkbox\" name=\"".$nomeId."[]\" id=\"$nomeId\" value=\"".$iten['id']."\" $selecionado 
				".self::montaClass()." ".self::montaEventos()." />".$iten['legenda']."</p>";
			}
		}
		
		self::set_cssClass();
		self::set_eventos();
		
		return $html;
			
	}	
	
	static function montarColunas($linhas = "", $somar){		
			
		$colunas = self::$colunas;
		
		if( $somar != '' && is_numeric($somar) && $somar > 0 ){
			for($x = 0; $x < $somar; $x++) $colunas[] = "";
		}
		
		$html = "<table id=\"".self::get_idTabela()."\" class=\"registros\" >";
		
		if( count($colunas) > 0 ){

			$html .= "<thead>";
			foreach($colunas as $coluna) $html .= "<th>".$coluna."</th>";
			$html .= "</thead>";
						
			$html .= "<tfoot>";
			foreach($colunas as $coluna) $html .= "<th>".$coluna."</th>";
			$html .= "</tfoot>";
			
		}
		
		$html .= $linhas;		
		$html .= "</table>";
		
		self::set_colunas();
		return $html;		
		
	}	
			
}?>
