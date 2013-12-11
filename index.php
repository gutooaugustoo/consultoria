<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo NOME_APP?></title>  
  	<?php require_once ($_SERVER['DOCUMENT_ROOT'] . CAM_CFG . "include.php"); ?>  
  </head>
  
  <body class="body" >
    <div id="divs_jquery"></div>
    <div id="cssmenu">
      <?php require_once "menu.php";?>  
      <!--<font onclick="carregarModulo('<?php echo CAM_VIEW."pergunta/filtro.php?tipoPergunta_id=1" ?>', '#centro')">TEMP</font>-->
    </div>
    <div id="alertas"></div>
    <div class="camada" nivel="0">
      <div id="centro"><?php //echo CAM_VIEW; ?></div>
    </div>
  </body>
</html>