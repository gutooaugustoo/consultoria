<?php
if ( !Login::verificarLogin() ) {	
	header('Location:'.CAM_ROOT.'/login.php');	
}

