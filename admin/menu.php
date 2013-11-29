<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/consultoria/config/admin.php";
$Modulo = new Modulo();
//$Funcionario = new Funcionario($_SESSION["idFuncionario"]);
?>

<ul>

	<?php $andFunc = " AND F.id = " . $_SESSION["idFuncionario"];

	$id_ultimo = array();
	$id_jaFoi = array("0");
	$id_jaFoi2 = array("0");

	$rsModulo = $Modulo -> selectModulo_permissao(" AND M.modulo_id IS NULL " . $andFunc);
	if ($rsModulo) {
		foreach ($rsModulo as $valorModulo) {

			$id_ultimo[] = $valorModulo["id"];
			sort($id_ultimo);

			for ($x = 1; $x > 0; $x++) {

				$pos = count($id_ultimo) - 1;

				if ($pos >= 0) {

					$id = $id_ultimo[$pos];
					$where = " AND M.modulo_id = " . $id . "
					 AND M.id NOT IN (" . implode(",", $id_jaFoi) . ") " . $andFunc;
					$rsModulo_sub = $Modulo -> selectModulo_permissao($where);

				} else {

					$id_jaFoi = array_merge($id_jaFoi, $id_jaFoi2);
					$id_jaFoi2 = array("0");
					break;

				}

				if ($rsModulo_sub) {

					$id_ultimo[] = $rsModulo_sub[0]["id"];

					if (in_array($id, $id_jaFoi2))
						continue;

					$where = " AND M.id = " . $id . " " . $andFunc;
					$rsModulo_n = $Modulo -> selectModulo_permissao($where);

					$nome_menu = $rsModulo_n[0]["nome"];
					$link_menu = $rsModulo_n[0]["link"];

					$id_jaFoi2[] = $id;

					echo "<li class=\"has-sub\">
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
						echo "</ul></li>";
						continue;
					}

					$where = " AND M.id = " . $id . " " . $andFunc;
					$rsModulo_n = $Modulo -> selectModulo_permissao($where);

					$nome_menu = $rsModulo_n[0]["nome"];
					$link_menu = $rsModulo_n[0]["link"];

					$onclick = ($link_menu) ? " onclick=\"carregarModulo('" . CAM_VIEW . $link_menu . "', '#centro')\" " : " href=\"#\" ";

					echo "<li><a $onclick >
						<span>" . $nome_menu . "</span></a>
					</li>";

				}
				//CONTA O ITEM
				$cont++;
			}
		}
	}
	?>
</ul>

<div class="logoff" >
	<small><?php //echo $Funcionario->	?>
		&nbsp;&nbsp;</small>
	<img src="<?php echo CAM_IMG."sair.png"?>" title="Sair do sistema" onclick="$('#logoff').click()"/>
</div>

<form id="login" class="validate" action="logoff.php" method="post" style="display:none;">
	<input type="submit" name="logoff" id="logoff" />
</form>
