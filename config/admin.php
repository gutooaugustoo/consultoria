<?php
//PASTAS
require_once "padrao.php";

require_once "_config.php";

define("NOME_APP", "Administrativo");

$Login = new Login();

if ($Login -> verificarLogin() && isset($pgLogin)) {
	header('Location:'.CAM_ROOT.'/admin/');
} elseif (!($Login -> verificarLogin()) && !isset($pgLogin)) {
	header('Location:'.CAM_ROOT.'/admin/login.php');
}
