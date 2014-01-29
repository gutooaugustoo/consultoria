<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/padrao.php";

Login::efetuarLogoff(false);

$documentoUnico = $_POST['documento'];
$senhaAcesso = $_POST['password'];

if ($documentoUnico != '' && $senhaAcesso != '') {
  $Login = new Login();
	switch ($_POST['quem']) {
		case 'candidato' :      
			$res = $Login -> efetuarLogin_candidato($documentoUnico, $senhaAcesso, $_REQUEST['hash']);			
			break;
		case 'avaliador' :
			$res = $Login -> efetuarLogin_avaliador($documentoUnico, $senhaAcesso);
			break;
		case 'gestor' :
			$res = $Login -> efetuarLogin_gestor($documentoUnico, $senhaAcesso);
			break;
		case 'funcionario' :			
			$res = $Login -> efetuarLogin_funcionario($documentoUnico, $senhaAcesso);
			break;
	}
  
  if( $res[0] == false){
    Uteis::alertJava($res[1], true);
  }
  
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Companhia de Idiomas</title>
		<link rel="shortcut icon" href="logoico.ico" />

		<?php
		require_once ($_SERVER['DOCUMENT_ROOT'] . CAM_CFG . "bibliotecas.php");		
		?>
	</head>

	<style>
		#div_login {
			margin: auto auto;
			width: 350px;
		}
	</style>

	<body>
		<div id="centro" class="body">
			<br />
			<div id="alertas"></div>
			<div id="div_login" >
				<form id="login" class="validate" action="" method="post" >
					<p>
					  <?php
            if (!EMPRESA) {
              $quemSelec = "funcionario";
              $login_temp = "414.428.868-46";
              $senha_temp = "123456";
            }
            ?>
						<label>Quem é você ?</label>
						<select class="required" id="quem" name="quem">
							<option value="">Selecione</option>							
							<option value="avaliador" <?php echo $quemSelec == "avaliador" ? "selected" : "" ?>>Avaliador</option>
							<option value="gestor" <?php echo $quemSelec == "gestor" ? "selected" : "" ?>>Gestor de empresa</option>
							<option value="funcionario" <?php echo $quemSelec == "funcionario" ? "selected" : "" ?>>Funcionário</option>
							<option value="candidato" <?php echo ($quemSelec == "candidato" || isset($_REQUEST['hash'])) ? "selected" : "" ?> >Candidato</option>

						</select>
						<span class="placeholder">Campo Obrigatório</span>
					</p>
					<p>
						<label>CPF:</label>
						<input type="text" name="documento" id="documento" class="required cpf" value="<?php echo $login_temp?>"/>
						<span class="placeholder">Campo Obrigatório</span>
					</p>
					<p>
						<label>Senha</label>
						<input type="password" name="password" id="password" class="required" value="<?php echo $senha_temp?>"/>
						<span class="placeholder">Campo Obrigatório</span>
					</p>
					<p>
						<button class="button blue submit">
							Efetuar Login
						</button>
					</p>
					<!--<p onClick="enviarSenha('#documento', 'admin')" class="onlink" >
						Não lembra a sua senha?
					</p>-->
				</form>
				<script>
					$('#documento').focus();
				</script>
			</div>
		</div>
	</body>
</html>
<script>ativarForm();</script>