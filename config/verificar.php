<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/padrao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/config.php";

define("NOME_APP", ucfirst($_SESSION['logado']) );
define("CAM_VIEW", CAM_ROOT."/view_".$_SESSION['logado']."/");

$Login = new Login();

if ( $Login -> verificarLogin() && isset($pgLogin) ) {
	header('Location:'.CAM_ROOT.'/');
} elseif (!($Login -> verificarLogin()) && !isset($pgLogin)) {
	header('Location:'.CAM_ROOT.'/login.php');
}
