<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Pradžia</a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?module=<?php echo $module; ?>&action=list">Kelionės</a></li>
		<li class="breadcrumb-item active" aria-current="page">Kelionės redagavimas</li>
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
		<label for="keliones_id">Id</label>
		<input type="text" id="keliones_id" name="keliones_id" class="form-control"
               value="<?php echo $data['keliones_id']; ?>"
                readonly>
	</div>

    <div class="form-group">
        <label for="pavadinimas">Pavadinimas *</label>
        <input type="text" id="pavadinimas" name="pavadinimas" class="form-control"
               value="<?php echo isset($data['pavadinimas']) ? $data['pavadinimas'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="organizatorius">Organizatorius *</label>
        <input type="text" id="organizatorius" name="organizatorius" class="form-control"
               value="<?php echo isset($data['organizatorius']) ? $data['organizatorius'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="fk_Gidas">Gidas *</label>
        <select id="fk_Gidas" name="fk_Gidas" class="form-select form-control">
            <option value="">---------------</option>
            <?php
            $clients = $guidesObj->getList();
            foreach($clients as $key => $val) {
                $selected = "";
                if(isset($data['fk_Gidas']) && $data['fk_Gidas'] == $val['el_pastas']) {
                    $selected = " selected='selected'";
                }
                echo "<option{$selected} value='{$val['el_pastas']}'>{$val['vardas']} {$val['pavarde']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="pradzios_data">Pradžios data *</label>
        <input type="text" id="pradzios_data" name="pradzios_data" class="form-control datepicker"
               value="<?php echo isset($data['pradzios_data']) ? $data['pradzios_data'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="pabaigos_data">Pabaigos data *</label>
        <input type="text" id="pabaigos_data" name="pabaigos_data" class="form-control datepicker"
               value="<?php echo isset($data['pabaigos_data']) ? $data['pabaigos_data'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="vietu_skaicius">Vietų skaičius *</label>
        <input type="text" id="vietu_skaicius" name="vietu_skaicius" class="form-control"
               value="<?php echo isset($data['vietu_skaicius']) ? $data['vietu_skaicius'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="kaina">Kaina *</label>
        <input type="text" id="kaina" name="kaina" class="form-control"
               value="<?php echo isset($data['kaina']) ? $data['kaina'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="aprasymas">Aprašymas</label>
        <textarea type="text" id="aprasymas" name="aprasymas" class="form-control">
            <?php echo isset($data['aprasymas']) ? $data['aprasymas'] : ''; ?>
        </textarea>
    </div>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>