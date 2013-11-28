<?php
$pgLogin = true;
require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");

$documento = $_POST['documento'];
$password = $_POST['password'];

if( $documento != '' && $password != ''){		
	if( !$Login->efetuarLogin($documento, $password) ){ 			
		Uteis::alertJava("Login ou senha inválidos.", true);
	}
}

if( !EMPRESA ){
	$login_temp = "414.428.868-46";
	$senha_temp = "123456";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo NOME_APP?></title>
<link rel="shortcut icon" href="logoico.ico" />

<?php
require_once($_SERVER['DOCUMENT_ROOT'].CAM_CFG."include/css.php");
require_once($_SERVER['DOCUMENT_ROOT'].CAM_CFG."include/js.php");
?>

</head>

<style>
#div_login {
	margin: auto auto;
	width: 350px;
}
</style>

<body>
<div id="centro"> <br />
  <div id="alertas"></div>
  <div id="div_login">
    <form id="login" class="validate" action="login.php" method="post" >
      <p><strong>Sistema administrativo</strong></p> 
      <p>
        <label>CPF:</label>
        <input type="text" name="documento" id="documento" class="required cpf" value="<?php echo $login_temp?>"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Senha</label>
        <input type="password" name="password" id="password" class="required" value="<?php echo $senha_temp?>"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue submit">Efetuar Login</button>
      </p>
      <p onClick="enviarSenha('#documento', 'admin')" class="onlink" >Não sabe a sua senha?</p> 
    </form>
    <script>$('#documento').focus();</script> 
  </div>
</div>
</body>
</html>
<script>
	ativarForm();
</script>