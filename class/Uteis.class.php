<?php
class Uteis {

	function __construct() {
	}

	function __destruct() {
	}

	//ENVIAR E-MAIL
	static function enviarEmail($assunto = "", $mensagem = "", $paraQuem = array(), $arquivos = array(), $copia = array(), $bcopia = array()) {

		require_once 'mailer/class.phpmailer.php';
		$mailer = new PHPMailer();

		$mailer -> IsSMTP();
		$mailer -> SMTPDebug = 1;
		$mailer -> SMTPSecure = 'tls';
		$mailer -> IsHTML(true);
		$mailer -> SMTPAuth = true;
		$mailer -> Port = 587;
		$mailer -> Host = HOST;
		$mailer -> Username = USERNAME;
		$mailer -> Password = PASSWORD;
		$mailer -> FromName = FROMNAME;
		$mailer -> From = FROM;

		if ($copia) {
			foreach ($copia as $valor) {
				if ($valor != "")
					$mailer -> AddCC($valor, "");
			}
		}

		if ($bcopia) {
			foreach ($bcopia as $valor) {
				if ($valor != "")
					$mailer -> AddBCC($valor, "");
			}
		}

		if ($arquivos) {
			foreach ($arquivos as $valor) {
				if ($valor != "")
					$mailer -> AddAttachment($valor);
				//anexa o arquivo
			}
		}

		$mailer -> AddReplyTo(REPLYTO);

		if ($paraQuem) {
			$mensagem .= "<hr />O e-mail iria para os seguintes destinatarios:";
			foreach ($paraQuem as $valor) {
				//Destinatários
				if ($valor['email'] != "")
					$mensagem .= "<br>E-mail:" . $valor['email'] . " - Nome: " . $valor['nome'];
					//if( $valor['email'] != "" ) $mailer->AddAddress($valor['email'], $valor['nome']);
			}
		}
	
		if (EMPRESA) {
			$mailer -> AddAddress(ENVIO_TESTE, "Teste");			
		}

		$mailer -> Subject = utf8_decode($assunto);

		$mailer -> Body = utf8_decode(self::montarEmail($mensagem, $assunto));

		if (EMPRESA)
			$mailer -> Send();

		return true;

	}

	//CORPO PADRÃO DOS E-MAILS ENVIADOS
	static function montarEmail($mensagem = "", $assunto = "") {

		$mensagem_final = "
		<html>
			<head>
				<title></title>				
			</head>
			<style>			
				body{
					font-family:Verdana, Geneva, sans-serif;
					background-color:#FFFFFF;
					padding: 10px 10px 10px 10px ;
					margin:0 auto;
				}
				
				p{
					padding:3px 3px;
					color:#333;
					text-align:justify;
					font-size:12px;
				}
				
				a{
					text-decoration:none;
					cursor:pointer;
				}
				
				.principal {	
					width:650px;
					background-color:#DDDDDD;
					margin:0 auto;
				}
				
				.banner {
					width:100%;
					text-align:right;
					font-size:10px;
					background-color:#FFFFFF;
				}
							
				.box{
					width:100%;
				}
				
				.noticia {
					width:100%;
					font-size:12px;
					background-color:#FFFFFF;
				}
				
				.titulo {
					font-size:14px;
					font-weight:bold;
					text-transform:uppercase;
					text-align:left;
				}
				
				.rodape {
					width:100%;
					font-size:10px;
					text-align:center;
					background-color:#FFFFFF;
					color:#FFFFFF;
				}
			</style>
			<body>
				<table cellpadding=\"0\" cellspacing=\"2\" align=\"center\" class=\"principal\">
					<tbody>
						<tr>
							<td>
							<table class=\"banner\">
								<tbody>
									<tr>
										<td style=\"text-align: center\"> 
											<img src=\"" . CAM_IMG2 . "_cabecalho.png\" />
										</td>
									</tr>
								</tbody>
							</table></td>
						</tr>
						<tr>
							<td class=\"noticia\">
							<table cellspacing=\"0\" class=\"box\" style=\"margin-top: 0px\">
								<tbody>
									<tr class=\"titulo\">
		
										<td class=\"fcinza\"> $assunto</td>
									</tr>
							</TABLE></td>
						</tr>
						<tr>
							<td class=\"noticia\">
							$mensagem
							</td>
						</tr>
						<tr>
							<td class=\"rodape\">
							<a href=\"http://www.companhiadeidiomas.com.br\" target=\"_blank\">							
							<img alt=\"Companhia de Idiomas\" border=\"0\" src=\"" . CAM_IMG2 . "_rodape.png\" /></a>
							</td>
						</tr>
					</tbody>
				</table>
			</body>
		</html>		
		";

		return $mensagem_final;

	}

	//DATAS NO FORMATO AAAA-MM-DD
	static function gravarData($data) {
		if ($data != "") {
			$data2 = explode("/", $data);
			return $data2[2] . "-" . $data2[1] . "-" . $data2[0];
		}
	}

	//DATAS NO FORMATO DD/MM/AAAA
	static function exibirData($data) {
		if ($data != "") {
			$data2 = explode(" ", $data . " ");
			$data = explode("-", $data2[0]);
			return $data[2] . "/" . $data[1] . "/" . $data[0];
		}
	}

	//DATA/HORA NO FORMATO AAAA-MM-DD HH:MM:SS
	static function gravarDataHora($datatime) {
		if ($datatime != "") {
			$res = explode(" ", $datatime);
			$hora = $res[1];
			$data = explode("/", $res[0]);
			$data_r = $data[2] . "-" . $data[1] . "-" . $data[0];
			return $data_r . " " . $hora;
		}
	}

	//DATA/HORA NO FORMATO DD/MM/AAAA ÁS HH:MM:SS
	static function exibirDataHora($value) {
		$val = explode(" ", $value);
		return self::exibirData($val[0]) . " às " . self::exibirHoras(self::gravarHoras($val[1]));
	}

	//IMPRIME CÓDIGO JS PARA ALERT OU ALERTA PERSONALIZADO
	static function alertJava($msg, $js = false) {
		if ($js == true) {
			echo "<script type=\"text/javascript\">alert('" . $msg . "')</script>";
		} else {
			echo "<script type=\"text/javascript\">alerta('" . $msg . "')</script>";
		}
	}

	//EXECUTAR UMA QUERY NO BANCO
	static function executarQuery($sql) {
		$Database = new Database();
		return $Database -> executarQuery($sql);
	}

	//HORAS EM INT (converte para minutos)
	static function gravarHoras($horas) {
		$horas = explode(":", $horas);
		return $horas[0] * 60 + $horas[1];
	}

	//USADO INTERNAMENTE PARA CALULAR UM INT EM HORAS (array com [0]horas e [1]minutos)
	private static function montarHoras($value, $mostrarVazio = false) {
		if ($value == '' || is_null($value)) {
			if ($mostrarVazio == true) {
				$resArray = "";
			} else {
				$resArray[0] = "00";
				$resArray[1] = "00";
			}
		} else {
			$hora = intval($value / 60);
			$min = $value % 60;
			$resArray[0] = str_pad($hora, 2, '0', STR_PAD_LEFT);
			$resArray[1] = str_pad($min, 2, '0', STR_PAD_LEFT);
		}
		return $resArray;
	}

	//HORAS NO FORMATO hh:mm
	static function exibirHoras($value, $mostrarVazio = false) {
		$horas = self::montarHoras($value, $mostrarVazio);
		$res = $horas ? $horas[0] . ":" . $horas[1] . "" : "";
		return $res;
	}

	//HORAS NO FORMATO hh:mm (para input text)
	static function exibirHorasInput($value) {
		$horas = self::montarHoras($value, true);
		$res = $horas ? $horas[0] . ":" . $horas[1] . "" : "";
		return $res;
	}

	//SEM VIRGULA E COM '.' COMO SEPARADOR DECIMAL
	static function gravarMoeda($val) {
		$val = str_replace(',', '.', $val);
		if (self::eNumerico($val))
			return $val;
	}

	//SUBSTITUI PONTO POR VIRGULA
	static function exibirMoeda($val) {
		return str_replace('.', ',', $val);
	}

	//FORMATAR COMO MOEDA (duas casas depois da virgula)
	static function formatarMoeda($value, $retornaVazio = false) {
		if ($value != '') {
			return trim(self::exibirMoeda(number_format($value, '2', '.', '')));
		} else {
			if (!$retornaVazio) {
				return "0,00";
			} else {
				return "";
			}
		}
	}

	//CONFERE COM EXXPRESSÃO REGULAR SE O VALOR É NÚMERICO (aceita ponto a cada tres numeros, e vigula como separador decimal)
	static function eNumerico($val) {
		if (preg_match("/^(-){0,1}([0-9]+)([.][0-9]){0,1}([0-9]*)$/", $val)) {
			return 1;
		} else {
			return 0;
		}
	}

	//INT PARA DIA DE SEMANA POR EXTENSO (de 1 - domingo a 7 -> sabado)
	static function exibirDiaSemana($diasemana) {
		switch ($diasemana) {
			case 1 :
				$diasemana = "Domingo";
				break;
			case 2 :
				$diasemana = "Segunda-Feira";
				break;
			case 3 :
				$diasemana = "Terça-Feira";
				break;
			case 4 :
				$diasemana = "Quarta-Feira";
				break;
			case 5 :
				$diasemana = "Quinta-Feira";
				break;
			case 6 :
				$diasemana = "Sexta-Feira";
				break;
			case 7 :
				$diasemana = "Sábado";
				break;
		}

		return $diasemana;
	}

	//CALCULA A DIFERENCA ENTRE DUAS DATAS (só em meses)
	static function diferencaEntreDatas($dataIni, $dataFim) {
		$diasNoMes = date("d", strtotime($dataIni)) - 1;
		$dataIni = date("Y-m-d", strtotime("-$diasNoMes days", strtotime($dataIni)));

		$diasNoMes = date("d", strtotime($dataFim)) - 1;
		$dataFim = date("Y-m-d", strtotime("-$diasNoMes days", strtotime($dataFim)));

		$m = 2592000;
		//mes em segundos
		$res = round((strtotime($dataFim) - strtotime($dataIni)) / $m);

		return $res;
	}

	//INT PARA DIA DE MESES POR EXTENSO (de 1 - janeiro a 12 -> dezembro)
	static function retornaNomeMes($mes) {
		switch ($mes) {
			case 1 :
				$nomeMes = "Janeiro";
				break;
			case 2 :
				$nomeMes = "Fevereiro";
				break;
			case 3 :
				$nomeMes = "Março";
				break;
			case 4 :
				$nomeMes = "Abril";
				break;
			case 5 :
				$nomeMes = "Maio";
				break;
			case 6 :
				$nomeMes = "Junho";
				break;
			case 7 :
				$nomeMes = "Julho";
				break;
			case 8 :
				$nomeMes = "Agosto";
				break;
			case 9 :
				$nomeMes = "Setembro";
				break;
			case 10 :
				$nomeMes = "Outubro";
				break;
			case 11 :
				$nomeMes = "Novembro";
				break;
			case 12 :
				$nomeMes = "Dezembro";
				break;
		}
		return $nomeMes;
	}

	//TOTAL DE DIAS EXISTENTES EM UM MES/ANO
	static function totalDiasMes($m, $a) {
		//echo "$a-$m";
		return date("t", strtotime($a . "-" . $m . "-01"));
	}

	//STATUS DO CADASTRO (ativo ou inativo)
	static function exibirStatus($bool, $mostraImg = true) {
		if ($mostraImg)
			return "<img src=\"" . CAM_IMG . ($bool ? "ativo" : "inativo") . ".png\" />";
		else
			return ($bool ? "Sim" : "Não");
	}

	//STATUS DE APROVAÇÃO
	static function exibirStatusAprovacao($status, $mostraImg = true) {

		$res = "";

		if ($status == "1")
			$legenda = "Em aberto";
		elseif ($status == "2")
			$legenda = "Aprovado";
		elseif ($status == "3")
			$legenda = "Reprovado";

		if ($mostraImg) {

			if ($status == "1")
				$res = "none.png";
			elseif ($status == "2")
				$res = "ativo.png";
			elseif ($status == "3")
				$res = "inativo.png";

			return $res ? "<img src=\"" . CAM_IMG . $res . "\" title=\"$legenda\" />" : "";

		} else {

			return $legenda;

		}

	}

	//RESUMIR UMA STRING
	static function resumir($string, $chars = 40) {
		if (strlen($string) > $chars) {
			return mb_substr($string, 0, $chars) . "...";
		} else {
			return $string;
		}
	}

	//MOSTRAR O SEXO
	static function exibirSexo($sexo) {
		return ($sexo == "F" ? "Feminino" : "Masculino");
	}

	//CRIPTOGRAFIA
	static function base64_url_encode($input) {
		return strtr(base64_encode($input), '+/=', '-_,');
	}

	//DESFAZ CRIPTOGRAFIA
	static function base64_url_decode($input) {
		return base64_decode(strtr($input, '-_,', '+/='));
	}

	//VERIFICA SE A DATA É VALIDA
	static function verificarData($data) {
		if (date('Y-m-d', strtotime($data)) == $data) {
			$bool = 1;
		} else {
			$bool = 0;
		}
		return $bool;
	}
	
	static function verificaChecked($bool) {
		return ($bool) ? "checked" : "";
	}
	
	
	static function pr($arr, $exit = 0) {
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		if ($exit)
			exit ;
	}

}
