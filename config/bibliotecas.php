<!-- CSS ---------------------------------->
		<link rel="stylesheet" href="<?php echo CAM_CFG?>css/zerar.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo CAM_CFG?>css/estilo.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo CAM_CFG?>css/menu.css" type="text/css" />	
		<!-- JQuery Ui -->
		<link href="<?php echo CAM_CFG?>css/jquery/jquery-ui.custom.min.css" rel="stylesheet" type="text/css" />	
		<!-- data Tables -->
		<link rel="stylesheet" href="<?php echo CAM_CFG?>css/dataTables/table_jui.css" />	
		<!-- Validação -->
		<link href="<?php echo CAM_CFG?>css/cssValidate/validate.css" type="text/css" media="screen" rel="stylesheet" />
		<link href="<?php echo CAM_CFG?>css/cssValidate/button.css" type="text/css" media="screen" rel="stylesheet" />
	
	<!-- JS ---------------------------------->	
		<!-- JQuery -->
		<script src="<?php echo CAM_CFG?>js/jquery.min.js" language="javascript" type="text/javascript"></script>
		<!-- JQuery Ui -->
		<script src="<?php echo CAM_CFG?>js/jquery-ui.custom.min.js" language="javascript" type="text/javascript"></script>
		<!-- Editor -->
		<script src="<?php echo CAM_CFG?>tinymce_4.0.1/tinymce.min.js" language="javascript" type="text/javascript" ></script>
		<!-- data Tables -->
		<script src="<?php echo CAM_CFG?>js/dataTable/jquery.dataTables.min.js" language="javascript" type="text/javascript" ></script>
		<!-- Funções form -->
		<script src="<?php echo CAM_CFG?>js/form.js" language="javascript" type="text/javascript"></script>
		<!-- Funções uteis -->
		<script src="<?php echo CAM_CFG?>js/uteis.js" language="javascript" type="text/javascript"></script>
		<!-- Eventos gerais-->
		<script src="<?php echo CAM_CFG?>js/eventos.js" language="javascript" type="text/javascript"></script>
		<!-- Mask-->
		<script src="<?php echo CAM_CFG?>js/jsValidate/jquery.mask.min.js" type="text/javascript"></script>		
		<!-- Validação -->
		<script src="<?php echo CAM_CFG?>js/jsValidate/jquery.validate.js" language="javascript" type="text/javascript"></script>
		<!-- PRINT ELEMENT-->
		<script src="<?php echo CAM_CFG?>js/jquery.printArea.js" language="javascript" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				eventAbas();
				eventFechar();
				eventRolarParaTopo();
				eventValidateForm();
				eventFocoForm();
				eventMostrarTitle();
			});
			//.tooltip();
		</script>