<?php
define("EMPRESA", 
	//FALSE
	"CIA"	
);   

error_reporting(
	//0	
	E_ERROR | E_PARSE | E_RECOVERABLE_ERROR | E_CORE_ERROR //| E_WARNING
	//E_ALL
);

//BANCO
define("DATABASE_SERVER", "186.202.152.113");
define("DATABASE_USER", "companhiadeidi23");
define("DATABASE_PASS", "con1456@");
define("DATABASE_DB", "companhiadeidi23");

//EMAIL
define("HOST", "");     
define("USERNAME", "");     
define("PASSWORD", "");
define("FROMNAME", "");
define("FROM", "");
  
//ENDERECO DEFAULT
define("ID_PAIS", 33);
define("ID_CIDADE", 9422);
define("ID_UF", 26);
  
define("ENVIO_TESTE", "augusto@companhiadeidiomas.com.br");
define("REPLYTO", "augusto@companhiadeidiomas.com.br");