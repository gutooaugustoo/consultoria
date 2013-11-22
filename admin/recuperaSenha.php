<?php
$pgLogin = true;

require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/class/Uteis.class.php");

$arrayRetorno = array();

$emails = array();
$paraQuem = array();

$origem = $_POST['origem'];
$doc = $_POST['doc'];

if($origem == "admin"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/class/Funcionario.class.php");
	$Funcionario = new Funcionario();
	
	$rs = $Funcionario->selectFuncionario(" WHERE documentoUnico = '".($doc)."'");
	if($rs){
		$idFuncionario = $rs[0]["idFuncionario"];
		$nome = $rs[0]["nome"];
		$senhaAcesso = $rs[0]["senhaAcesso"];
		$emails = $Funcionario->getEmail($idFuncionario);
	}
	
}elseif($origem == "aluno"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/class/ClientePf.class.php");
	$ClientePf = new ClientePf();
	
	$rs = $ClientePf->selectClientepf(" WHERE documentoUnico = '".($doc)."'");
	if($rs){
		$idClientePf = $rs[0]["idClientePf"];
		$nome = $rs[0]["nome"];
		$senhaAcesso = $rs[0]["senhaAcesso"];
		$emails = $ClientePf->getEmail($idClientePf);
	}
	
}elseif($origem == "professor"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/class/Professor.class.php");
	$Professor = new Professor();
	
	$rs = $Professor->selectProfessor(" WHERE documentoUnico = '".($doc)."'");
	if($rs){
		$idProfessor = $rs[0]["idProfessor"];
		$nome = $rs[0]["nome"];
		$senhaAcesso = $rs[0]["senha"];
		$emails = $Professor->getEmail($idProfessor);
	}
	
}elseif($origem == "rh"){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/consultoria/config/class/ClientePj.class.php");
	$ClientePj = new ClientePj();
	
	$rs = $ClientePj->selectClientePj(" WHERE cnpj = '".($doc)."'");
	if($rs){
		$idClientePj = $rs[0]["idClientePj"];
		$nome = $rs[0]["razaoSocial"];
		$senhaAcesso = $rs[0]["senhaAcesso"];
		$emails = $ClientePj->getEmail($idClientePj);
	}
	
}

if( count($emails)>0 ){
	
	$assunto = "Recuperação de senha";
	
	$msg = "<p>Sua senha é $senhaAcesso</p>";
	
	if($emails) foreach($emails as $email) $paraQuem[] = array("nome" => $nome, "email" => $email);	

	Uteis::enviarEmail($assunto, $msg, $paraQuem, "");
	
	$arrayRetorno["mensagem"] = "Sua senha foi enviada para o e-mail cadastrado.";
	
}else{
	$arrayRetorno["mensagem"] = "Não foi possível enviar a sua senha.";	
}
 
echo json_encode($arrayRetorno);
?>