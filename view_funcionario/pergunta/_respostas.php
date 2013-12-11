<?php $Pergunta = new Pergunta($idPergunta); ?>
<p>
	<label>Enunciado:</label>
	<?php echo $Pergunta->get_tituloPergunta();
	?>
</p>
<?php if( $Pergunta->get_enunciadoPergunta() ){?>
<p>
	<label>Complemento:</label>
	<?php echo $Pergunta->get_enunciadoPergunta()
	?>
</p>
<?php } ?>