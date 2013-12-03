<?php
class Html {

	private static $idTabela;
	private static $colunas;
	private static $eventos;
	private static $cssClass;

	function __construct() {
	}

	function __destruct() {
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

		if (count(self::$cssClass) > 0) {
			$html .= " class=\"" . implode(" ", self::$cssClass) . "\"";
		}

		return $html;
	}

	private function montaEventos() {

		$html = "";

		if (count(self::$eventos) > 0) {
			foreach (self::$eventos as $evento)
				$html .= " " . $evento[0] . "=\"" . $evento[1] . "\"";
		}

		return $html;
	}

	static function select($nomeId, $idAtual, $array) {

		$html = "<select name=\"$nomeId\" id=\"$nomeId\" " . self::montaClass() . " " . self::montaEventos() . " >
		<option value=\"\">Selecione</option>";

		foreach ($array as $iten) {
			$selecionado = ($idAtual == $iten['id']) ? "selected" : "";
			$html .= "<option value=\"" . $iten['id'] . "\" $selecionado >" . $iten['legenda'] . "</option>";
		}

		$html .= "</select>";

		self::set_cssClass();
		self::set_eventos();

		return $html;
	}

	static function selectMultiple($nomeId, $idsAtuais = array(), $array) {

		$html = "<select name=\"" . $nomeId . "[]\" id=\"$nomeId\" multiple=\"multiple\" " . self::montaClass() . " " . self::montaEventos() . " >
		<option value=\"\">Todos</option>";

		foreach ($array as $iten) {
			$selecionado = (in_array($iten['id'], $idsAtuais)) ? "selected" : "";
			$html .= "<option value=\"" . $iten['id'] . "\" $selecionado >" . $iten['legenda'] . "</option>";
		}

		$html .= "</select>";

		self::set_cssClass();
		self::set_eventos();

		return $html;
	}

	static function checkbox($nomeId, $idAtual, $array) {

		$html = "";

		if ($array) {
			foreach ($array as $iten) {
				$selecionado = (in_array($iten['id'], $idsAtuais)) ? "checked" : "";
				$html .= "<p><input type=\"checkbox\" name=\"" . $nomeId . "[]\" id=\"$nomeId\" value=\"" . $iten['id'] . "\" $selecionado 
				" . self::montaClass() . " " . self::montaEventos() . " />" . $iten['legenda'] . "</p>";
			}
		}

		self::set_cssClass();
		self::set_eventos();

		return $html;

	}

	static function montarColunas($linhas = array()) {

		$colunasHeadFoot = self::$colunas;
		
		$html = "<table id=\"" . self::get_idTabela() . "\" class=\"registros\" >";
	
		$html_linhas = "";
		if (count($linhas) > 0) {
			$html_linhas .= "<tbody>";
			foreach ($linhas as $key => $colunas) {				
				$html_linhas .= "<tr>";
				foreach ($colunas as $coluna){
					if( is_array($coluna) ) {
						$html_linhas .= "<td align=\"center\" >" . implode(ICON_SEPARATOR, $coluna) . "</td>";						
					}else{
						$html_linhas .= "<td>" . $coluna . "</td>";						
					}
				}
				$html_linhas .= "</tr>";
			}
			$html_linhas .= "</tbody>";
		}
		
		if (count($colunasHeadFoot) > 0) {

			$html .= "<thead>";
			foreach ($colunasHeadFoot as $colunaHeadFoot)
				$html .= "<th>" . $colunaHeadFoot . "</th>";
			$html .= "</thead>";
			
			$html .= $html_linhas;
			
			$html .= "<tfoot>";
			foreach ($colunasHeadFoot as $colunaHeadFoot)
				$html .= "<th>" . $colunaHeadFoot . "</th>";
			$html .= "</tfoot>";

		}

		
		
		$html .= "</table>";

		self::set_colunas();
		return $html;

	}
	
	static function selectMultipleStatus_html($nome = "status", $idAtual = array("0")){
		$array[] = array("id" => "0", "legenda" => "Ativo");
		$array[] = array("id" => "1", "legenda" => "Inativo");		
		return self::selectMultiple($nome, $idAtual, $array);		 
	}
	
	static function selectSexo_html($nome = "sexo", $idAtual = ""){
		$array[] = array("id" => "M", "legenda" => "Masculino");
		$array[] = array("id" => "F", "legenda" => "Feminino");		
		return self::select($nome, $idAtual, $array);		 
	}
	
}
?>
