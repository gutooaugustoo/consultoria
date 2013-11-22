<?php
//PASTAS
require_once "padrao.php";

define("NOME_APP", "Administrativo");
	
define("CAMINHO_MODULO", "/consultoria/admin/modulos/");
	define("CAMINHO_CAD", CAMINHO_MODULO."cadastro/");
	define("CAMINHO_CONFIG", CAMINHO_MODULO."configuracoes/");
	define("CAMINHO_VENDAS", CAMINHO_MODULO."vendas/");
	define("CAMINHO_REL", CAMINHO_MODULO."relacionamento/");
	define("CAMINHO_COBRANCA", CAMINHO_MODULO."cobranca/");
	define("CAMINHO_PAG", CAMINHO_MODULO."pagamento/");
	define("CAMINHO_RELAT", CAMINHO_MODULO."relatorios/");	

require_once "_config.php";

$Login = new Login();

if( $Login->verificarLogin() && $pgLogin ){

	header('Location:/consultoria/admin/index.php');		

}elseif( !($Login->verificarLogin()) && !$pgLogin ){	

	header('Location:/consultoria/admin/login.php');

}

?>