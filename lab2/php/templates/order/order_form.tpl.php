<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Pradžia</a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?module=<?php echo $module; ?>&action=list">Rezervacijos</a></li>
		<li class="breadcrumb-item active" aria-current="page"><?php if(!empty($id)) echo "Rezervacijos redagavimas"; else echo "Nauja rezervacija"; ?></li>
	</ol>
</nav>

<?php if($formErrors != null) { ?>
	<div class="alert alert-danger" role="alert">
		Neįvesti arba neteisingai įvesti šie laukai:
		<?php 
			echo $formErrors;
		?>
	</div>
<?php } ?>

<form action="" method="post" class="d-grid gap-3">
	<div class="form-group">
		<label for="rezervacijos_id">Id<?php echo in_array('rezervacijos_id', $required) ? '<span> *</span>' : ''; ?></label>
		<input type="text" id="rezervacijos_id" name="rezervacijos_id" class="form-control"
               value="<?php echo isset($data['rezervacijos_id']) ? $data['rezervacijos_id'] : ''; ?>"
                <?php if($action == 'edit') { ?>readonly<?php } ?>
        >
	</div>

    <div class="form-group">
        <label for="fk_Kelione">Kelionė<?php echo in_array('fk_Kelione', $required) ? '<span> *</span>' : ''; ?></label>
        <?php if($action == 'create') { ?>
            <select id="fk_Kelione" name="fk_Kelione" class="form-select form-control">
                <option value="">---------------</option>
                <?php
                // išrenkame klientus
                $trips = $tripsObj->getList();
                foreach($trips as $key => $val) {
                    $selected = "";
                    if(isset($data['fk_Kelione']) && $data['fk_Kelione'] == $val['keliones_id']) {
                        $selected = " selected='selected'";
                    }
                    echo "<option{$selected} value='{$val['keliones_id']}'>{$val['pavadinimas']}</option>";
                }
                ?>
            </select>
        <?php } else { ?>
            <input type="text" id="fk_Kelione" name="fk_Kelione" class="form-control"
                   value="<?php echo $data['kelione']; ?>"
                   readonly>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="fk_Klientas">Klientas<?php echo in_array('fk_Klientas', $required) ? '<span> *</span>' : ''; ?></label>
        <?php if($action == 'create') { ?>
            <select id="fk_Klientas" name="fk_Klientas" class="form-select form-control">
                <option value="">---------------</option>
                <?php
                // išrenkame klientus
                $clients = $clientsObj->getList();
                foreach($clients as $key => $val) {
                    $selected = "";
                    if(isset($data['fk_Klientas']) && $data['fk_Klientas'] == $val['el_pastas']) {
                        $selected = " selected='selected'";
                    }
                    echo "<option{$selected} value='{$val['el_pastas']}'>{$val['vardas']} {$val['pavarde']}</option>";
                }
                ?>
            </select>
        <?php } else { ?>
            <input type="text" id="fk_Klientas" name="fk_Klientas" class="form-control"
                   value="<?php echo $data['klientas']; ?>"
                   readonly>
        <?php } ?>
    </div>

    <div class="form-group">
        <label for="rezervacijos_data">Rezervacijos data<?php echo in_array('rezervacijos_data', $required) ? '<span> *</span>' : ''; ?></label>
        <input type="text" id="rezervacijos_data" name="rezervacijos_data" class="form-control datepicker" value="<?php echo isset($data['rezervacijos_data']) ? $data['rezervacijos_data'] : ''; ?>">
	</div>

    <?php if(isset($data['id'])) { ?>
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
    <?php } ?>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>