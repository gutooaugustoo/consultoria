<?php
include 'config.php';

$_POST["database"] = "consultoria";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Anarcho</title>
<script src="jquery.min.js" ></script>
<script>
	function submitF() {
		$('#submit').click()
	}

	function postForm(idForm, pagina, onde) {

		var form = $('#' + idForm);
		form.submit();

		$.post(pagina, form.serialize(), function(e) {
			$(onde).html(e)

		}).fail(function() {
			alert('Erro durante o processamento');
		}).always(function() {
			submitForm = false;
		});

		return false;

	}

</script>
</head>

<body class="body" >
<div id="divs_jquery"></div>
<div id="alertas"></div>
<div id="centro">
	
	<form name="geraCodigo" id="geraCodigo" method="post" >
	<?php if ($conn) { 
		
		//echo "<pre>";print_r($_POST);echo"</pre>";?>
		
    <p><label for="database">Database:</label>
    <select name="database" id="database" onchange="submitF()" >
    	<?php $list_dbs = mysql_list_dbs($conn);
			while ($row = mysql_fetch_object($list_dbs)) { 
				?>
				<option value="<?php echo $row -> Database; ?>" <?php
				if ($_POST["database"] == $row -> Database)
					echo 'selected="selected"';
 ?> >
				<?php echo $row -> Database; ?></option>				
			<?php } ?>
    </select></p>
    
    <?php if ($_POST["database"]) {
				
				mysql_select_db($_POST["database"]); ?>
				
        <p><label for="table">Tables:</label>
				<select name="table[]" id="table" multiple="multiple" size="10" >
					<?php
					$list_tables = mysql_query("SHOW TABLES FROM ".$_POST["database"]);
					while ($row = mysql_fetch_row($list_tables)) {
						$array_tables[] = $row[0]; ?>
            
						<option value="<?php echo $row[0]; ?>" <?php echo ( in_array($row[0], $_POST["table"]) ) ? "selected" : ""?> >
						<?php echo $row[0]; ?></option>
            
					<?php } ?>
				</select></p>
				
				<input type="submit" id="submit" value="Carregar" />
        
        <?php if ($_POST["table"]) {
				
					mysql_select_db($_POST["database"]); ?>
					
					<p>Gerar códigos da(s) tabela(s): <b><?php foreach($_POST["table"] as $table_post) echo "<li>$table_post</li>"?></b></p>
					
					<p><label for="sobrescrever">
					<input type="checkbox" name="sobrescrever" id="sobrescrever" value="1" <?php echo isset($_POST["sobrescrever"]) ? "checked" : ""?>  />
          Sobrescrever arquivos:</label></p>
          
          
					<label for="classm">
					<input type="checkbox" name="classm" id="classm" value="1" <?php echo isset($_POST["classm"]) ? "checked" : ""?>  />
          Class model:</label>
          
          <label for="class">
					<input type="checkbox" name="class" id="class" value="1" <?php echo isset($_POST["class"]) ? "checked" : ""?> />
          Class controller:</label>
          
          <label for="filtro">
					<input type="checkbox" name="filtro" id="filtro" value="1" <?php echo isset($_POST["filtro"]) ? "checked" : ""?> />
          Filtro:</label>
          
          <label for="lista">
					<input type="checkbox" name="lista" id="lista" value="1" <?php echo isset($_POST["lista"]) ? "checked" : ""?> />
          Lista:</label>
          
          <label for="formulario">
					<input type="checkbox" name="formulario" id="formulario" value="1" <?php echo isset($_POST["formulario"]) ? "checked" : ""?> />
          Form:</label>
          
          <label for="acao">
					<input type="checkbox" name="acao" id="acao" value="1" <?php echo isset($_POST["acao"]) ? "checked" : ""?> />
          Ação:</label>
          
				<?php } ?>
      
			<?php } ?>
	      
  <?php } ?>     
  
  </form>
  
<?php if ($_POST["table"]) {?>	
   <p><input type="submit" id="gerar" name="gerar" value="Gerar códigos" onclick="postForm('geraCodigo', '_gerador.php', '#res')" />   
   </p>
   <div id="res"></div>
<?php } ?>
          
</div>
</body>
</html>