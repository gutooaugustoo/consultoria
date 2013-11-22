<!-- JQuery -->
<script src="<?php echo CAMINHO_CFG?>js/jquery.min.js" language="javascript" type="text/javascript"></script>

<!-- JQuery Ui -->
<script src="<?php echo CAMINHO_CFG?>js/jquery-ui.custom.min.js" language="javascript" type="text/javascript"></script>

<!-- Editor -->
<script src="<?php echo CAMINHO_CFG?>tinymce_4.0.1/tinymce.min.js" language="javascript" type="text/javascript" ></script>

<!-- data Tables -->
<script src="<?php echo CAMINHO_CFG?>js/dataTable/jquery.dataTables.min.js" language="javascript" type="text/javascript" ></script>

<!-- Funções form -->
<script src="<?php echo CAMINHO_CFG?>js/form.js" language="javascript" type="text/javascript"></script>

<!-- Funções uteis -->
<script src="<?php echo CAMINHO_CFG?>js/uteis.js" language="javascript" type="text/javascript"></script>

<!-- Eventos gerais-->
<script src="<?php echo CAMINHO_CFG?>js/eventos.js" language="javascript" type="text/javascript"></script>

<!-- Mask-->
<script src="/consultoria/config/js/jsValidate/jquery.mask.min.js" type="text/javascript"></script>

<!-- Validação -->
<script src="<?php echo CAMINHO_CFG?>js/jsValidate/jquery.validate.js" language="javascript" type="text/javascript"></script>

<!-- PRINT ELEMENT-->
<script src="<?php echo CAMINHO_CFG?>js/jquery.printArea.js" language="javascript" type="text/javascript"></script>

<!--MENU RH-->
<script type="text/javascript" src="<?php echo CAMINHO_CFG?>include/menu_area/ddsmoothmenu.js"></script>

<script type="text/javascript">
	$(document).ready(function(){		
		eventAbas();
		eventFechar();
		eventRolarParaTopo();	
		eventValidateForm();	
		eventFocoForm();
		eventMostrarTitle();
	});//.tooltip();
</script>