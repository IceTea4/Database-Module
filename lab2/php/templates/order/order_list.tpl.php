<?php
	// suformuojame puslapių kelio (breadcrumb) elementų masyvą
	$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('title' => 'Rezervacijos'));
	
	// puslapių kelio šabloną
	include 'templates/common/breadcrumb.tpl.php';
?>

<div class="d-flex flex-row-reverse gap-3">
    <a href='index.php?module=<?php echo $module; ?>&action=create'>Nauja rezervacija</a>
</div>

<?php if(isset($_GET['remove_error'])) { ?>
    <div class="errorBox">
        Rezervacija nebuvo pašalinta nes turi mokėjimų.
    </div>
<?php } ?>

<table class="table">
	<tr>
		<th>Id</th>
		<th>Kelionė</th>
        <th>Klientas</th>
        <th>Data</th>
        <th>Būsena</th>
        <th></th>
	</tr>
    <?php
		// suformuojame lentelę
		foreach($data as $key => $val) {
			echo
				"<tr>"
					. "<td>{$val['rezervacijos_id']}</td>"
                    . "<td>{$val['kelione']}</td>"
                    . "<td>{$val['klientas']}</td>"
                    . "<td>{$val['rezervacijos_data']}</td>"
                    . "<td>{$val['rezervacijos_busena']}</td>"
                    . "<td class='d-flex flex-row-reverse gap-2'>"
                    . "<a href='index.php?module={$module}&action=edit&id={$val['rezervacijos_id']}'>redaguoti</a>"
                    . "<a href='#' onclick='showConfirmDialog(\"{$module}\", \"{$val['rezervacijos_id']}\"); return false;'>šalinti</a>&nbsp;"
                    . "</td>"
				. "</tr>";
		}
	?>
</table>

<?php
	// įtraukiame puslapių šabloną
	include 'templates/common/paging.tpl.php';
?>