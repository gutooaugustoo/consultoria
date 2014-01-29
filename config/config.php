<?php 
//CONFIGURAÇOES DO PHP
ini_set("register_globals", "Off");
ini_set("session.hash_function", "1");
ini_set("session.gc_maxlifetime", "3600");
 
//CONFIGURA DE LOCAL
mb_internal_encoding("UTF-8");
define("LOCALE", (strpos($_SERVER["SERVER_SOFTWARE"], "Win32") ? "ptb" : "pt_BR")); 
setlocale(LC_ALL, LOCALE);

error_reporting(
  //0 
  E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR //| E_WARNING
  //E_ALL
);