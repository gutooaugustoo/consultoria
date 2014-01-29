<?php
//
define("EMPRESA", 
  FALSE
  //"CIA" 
);   

//PASTAS PADRAO
define("CAM_ROOT", "/consultoria");
define("CAM_ROOT_COMPLETO", "http://".$_SERVER['SERVER_NAME'].CAM_ROOT."/");
  define("CAM_CFG", CAM_ROOT."/config/");
  define("CAM_CLASS", CAM_ROOT."/class/");
	define("CAM_UP", CAM_ROOT."/upload/");
	define("CAM_UP_ROOT", $_SERVER['DOCUMENT_ROOT'].CAM_ROOT."/upload/");	
	define("CAM_IMG", CAM_ROOT."/images/");
	define("CAM_IMG2", "http://".$_SERVER['SERVER_NAME'].CAM_ROOT."/images/");
		define("ICON_SEPARATOR", "<img src=\"" . CAM_IMG . "separator.png\" />");
			
//MENSAGENS PADRÃO	
define("MSG_CADNEW", "Cadastro efetuado com sucesso.");
define("MSG_CADUP", "Cadastro atualizado com sucesso.");
define("MSG_CADDEL", "Cadastro deletado com sucesso.");
define("MSG_OBRIGAT", "Preenchimento obrigat&oacute;rio:");
define("MSG_ERR", "Não foi possível completar a a&ccedil;&atilde;o");

//EMAIL
define("HOST", "");     
define("USERNAME", "");     
define("PASSWORD", "");
define("FROMNAME", "");
define("FROM", "");
define("ENVIO_TESTE", "augusto@companhiadeidiomas.com.br");
define("REPLYTO", "augusto@companhiadeidiomas.com.br");
  
//ENDERECO DEFAULT
define("ID_PAIS", 33);
define("ID_CIDADE", 9422);
define("ID_UF", 26);

if( isset($_SESSION['logado']) ){
  define("NOME_APP", "Portal do ".ucfirst($_SESSION['logado']) );
  define("CAM_VIEW", CAM_ROOT."/view_".$_SESSION['logado']."/");
}  

//AUTOLOAD DE CLASSES
function __autoload($class) {
  
  $caminhoClass = $_SERVER['DOCUMENT_ROOT'].CAM_CLASS."/".$class.".class.php";
  if( file_exists($caminhoClass) ){ 
    require_once $caminhoClass;
    return true;
  }
  
  $caminhoClass = $_SERVER['DOCUMENT_ROOT'].CAM_CLASS."controller/".$class.".class.php";    
  if( file_exists($caminhoClass) ){ 
    require_once $caminhoClass;
    return true; 
  }
  
  $caminhoClass = $_SERVER['DOCUMENT_ROOT'].CAM_CLASS."model/".$class.".class.php";   
  if( file_exists($caminhoClass) ){ 
    require_once $caminhoClass;
    return true; 
  }
  
  echo "Erro: Classe não encontrada ($class)";
  
  exit;
    
}