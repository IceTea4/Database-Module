<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('title' => 'Kelionės'));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

<div class="d-flex flex-row-reverse gap-3">
    <a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja kelionė</a>
</div>

<?php if(isset($_GET['remove_error'])) { ?>
    <div class="errorBox">
        Kelionė nebuvo pašalinta nes turi rezervacijų.
    </div>
<?php } ?>

<table class="table">
	<tr>
		<th>Id</th>
		<th>Pavadinimas</th>
        <th>Organizatorius</th>
        <th>Pradžios data</th>
        <th>Pabaigos data</th>
        <th>Vietų skaičius</th>
        <th>Kaina</th>
        <th>Gidas</th>
        <th></th>
	</tr>
    <?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['keliones_id']}</td>"
                    . "<td>{$val['pavadinimas']}</td>"
                    . "<td>{$val['organizatorius']}</td>"
                    . "<td>{$val['pradzios_data']}</td>"
					. "<td>{$val['pabaigos_data']}</td>"
                    . "<td>{$val['vietu_skaicius']}</td>"
					. "<td>{$val['kaina']}</td>"
                    . "<td>{$val['gidas']}</td>"
                    . "<td class='d-flex flex-row-reverse gap-2'>"
                    . "<a href='index.php?module={$module}&action=edit&id={$val['keliones_id']}'>redaguoti</a>"
                    . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['keliones_id']}\"); return false;'>šalinti</a>&nbsp;"
                    . "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/common/paging.tpl.php';
?>