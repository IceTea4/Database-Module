<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('title' => 'Draudimai'));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

<div class="d-flex flex-row-reverse gap-3">
    <a href='index.php?module=<?php echo $module; ?>&action=create'>Naujas draudimas</a>
</div>

<?php if(isset($_GET['remove_error'])) { ?>
    <div class="errorBox">
        Draudimas nebuvo pašalintas nes turi polisų.
    </div>
<?php } ?>

<table class="table">
	<tr>
		<th>Id</th>
		<th>Pavadinimas</th>
        <th>Kaina</th>
        <th></th>
	</tr>
	<?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['draudimo_id']}</td>"
                    . "<td>{$val['pavadinimas']}</td>"
					. "<td>{$val['kaina']}</td>"
                    . "<td class='d-flex flex-row-reverse gap-2'>"
                    . "<a href='index.php?module={$module}&action=edit&id={$val['draudimo_id']}'>redaguoti</a>"
                    . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['draudimo_id']}\"); return false;'>šalinti</a>&nbsp;"
                    . "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/common/paging.tpl.php';
?>