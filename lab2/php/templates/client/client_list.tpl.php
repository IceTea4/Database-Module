<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('title' => 'Klientai'));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

<div class="d-flex flex-row-reverse gap-3">
    <a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas klientas</a>
</div>

<?php if(isset($_GET['remove_error'])) { ?>
    <div class="errorBox">
        Klientas nebuvo pašalintas nes turi rezervacijų.
    </div>
<?php } ?>

<table class="table">
	<tr>
		<th>El paštas</th>
		<th>Vardas</th>
		<th>Pavardė</th>
        <th>Telefono nr</th>
        <th>Adresas</th>
        <th>Registracijos data</th>
        <th></th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['el_pastas']}</td>"
                    . "<td>{$val['vardas']}</td>"
                    . "<td>{$val['pavarde']}</td>"
                    . "<td>{$val['telefono_nr']}</td>"
                    . "<td>{$val['adresas']}</td>"
					. "<td>{$val['registracijos_data']}</td>"
                    . "<td class='d-flex flex-row-reverse gap-2'>"
                    . "<a href='index.php?module={$module}&action=edit&id={$val['el_pastas']}'>redaguoti</a>"
                    . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['el_pastas']}\"); return false;'>šalinti</a>&nbsp;"
                    . "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/common/paging.tpl.php';
?>