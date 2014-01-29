<?php
//CONGFIGUYRAÇOES DE SESSÃO
session_name('companhiadeidiomas');
session_start();
ob_start();
//echo "".session_id();

require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/padrao.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php";

//phpinfo();
//Uteis::pr($_SESSION);
//Uteis::pr($_COOKIE);
?>