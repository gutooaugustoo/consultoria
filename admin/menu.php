
<ul>
<?php 
/*$modulo = new Modulo(1);

echo $modulo->renderModulo($modulo->getModulo());*/
?>

<div class="logoff" >
	<?php echo $_SESSION['nome_SS']?>&nbsp;&nbsp;
	<img src="<?php echo CAM_IMG."sair.png"?>" title="Sair do sistema" onclick="$('#logoff').click()"/>
</div>

<form id="login" class="validate" action="logoff.php" method="post" style="display:none;">
  <input type="submit" name="logoff" id="logoff" />
</form>
