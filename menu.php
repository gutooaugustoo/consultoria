<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/verificar.php";

$Modulo = new Modulo();

$logado = $_SESSION['logado'];
$id_session = $_SESSION["id" . ucfirst($logado)];

switch ( $logado ) {
	case 'funcionario' :
		$Pessoa = new Funcionario($id_session);
		break;
	case 'candidato' :
		$Pessoa = new Candidato($id_session);
		break;
	case 'gestor' :
		$Pessoa = new Gestor($id_session);
		break;
	case 'avaliador' :
		$Pessoa = new Avaliador($id_session);
		break;
}
?>

<?php
$menu = "";

$id_ultimo = array();
$id_jaFoi = array("0");
$id_jaFoi2 = array("0");

$where = " AND M.modulo_id IS NULL ";
$rsModulo = $Modulo -> selectModulo_permissao($logado, $where, $id_session);

if ($rsModulo) {
	foreach ($rsModulo as $valorModulo) {

		$id_ultimo[] = $valorModulo["id"];
		sort($id_ultimo);
		//ORDENA DO MENOR PARA O MAIOR

		for ($x = 1; $x > 0; $x++) {

			$pos = count($id_ultimo) - 1;

			if ($pos >= 0) {

				$id = $id_ultimo[$pos];
				$where = " AND M.modulo_id = " . $id . " AND M.id NOT IN (" . implode(",", $id_jaFoi) . ") ";
				$rsModulo_sub = $Modulo -> selectModulo_permissao($logado, $where, $id_session);

			} else {

				$id_jaFoi = array_merge($id_jaFoi, $id_jaFoi2);
				$id_jaFoi2 = array("0");
				break;

			}

			if ($rsModulo_sub) {

				$id_ultimo[] = $rsModulo_sub[0]["id"];

				if (in_array($id, $id_jaFoi2))
					continue;

				$where = " AND M.id = " . $id;
				$rsModulo_n = $Modulo -> selectModulo_permissao($logado, $where, $id_session);

				$nome_menu = $rsModulo_n[0]["nome"];
				$link_menu = $rsModulo_n[0]["link"];

				$id_jaFoi2[] = $id;

				$menu .= "<li class=\"has-sub\">
					<a href=\"#\">
						<span>" . $nome_menu . "</span>
					 	<span class=\"has-sub-indicator\"></span>
					</a>
				<ul>";

			} else {

				$id = $id_ultimo[$pos];

				$id_jaFoi[] = $id;
				unset($id_ultimo[$pos]);
				sort($id_ultimo);

				if (in_array($id, $id_jaFoi2)) {
					$menu .= "</ul></li>";
					continue;
				}

				$where = " AND M.id = " . $id;
				$rsModulo_n = $Modulo -> selectModulo_permissao($logado, $where, $id_session);

				$nome_menu = $rsModulo_n[0]["nome"];
				$link_menu = $rsModulo_n[0]["link"];

				$onclick = ($link_menu && $link_menu != "#") ? " onclick=\"carregarModulo('" . CAM_VIEW . $link_menu . "', '#centro')\" " : " href=\"#\" ";

				$menu .= "<li>
					<a $onclick >
						<span>" . $nome_menu . "</span>
					</a>
				</li>";

			}
			
			//$cont++;//CONTA O ITEM
			
		}
	}
}
?>

<ul>
	<?php echo $menu; ?>
</ul>

<div class="logoff" >
	Companhia de Idiomas | Consultoria
	<?php echo ICON_SEPARATOR;?>
	<?php if( is_object($Pessoa) ) echo $Pessoa -> get_nomePessoa(); ?>
	<?php echo ICON_SEPARATOR;?>
	<img src="<?php echo CAM_IMG."sair.png"?>" title="Sair do sistema" onclick="$('#logoff').click()"/>
</div>

<form id="login" class="validate" action="logoff.php" method="post" style="display:none;">
	<input type="submit" name="logoff" id="logoff" />
</form>

