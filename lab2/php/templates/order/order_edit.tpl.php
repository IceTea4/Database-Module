<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Pradžia</a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?module=<?php echo $module; ?>&action=list">Rezervacijos</a></li>
		<li class="breadcrumb-item active" aria-current="page">Rezervacijos redagavimas</li>
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
		<label for="rezervacijos_id">Id</label>
		<input type="text" id="rezervacijos_id" name="rezervacijos_id" class="form-control"
               value="<?php echo $data['rezervacijos_id']; ?>"
               readonly>
	</div>

    <div class="form-group">
        <label for="fk_Kelione">Kelionė</label>
        <input type="text" id="kelione" name="kelione" class="form-control"
               value="<?php echo $data['kelione']; ?>"
               readonly>
    </div>

    <div class="form-group">
        <label for="fk_Klientas">Klientas</label>
        <input type="text" id="klientas" name="klientas" class="form-control"
               value="<?php echo $data['klientas']; ?>"
               readonly>
    </div>

    <div class="form-group">
        <label for="rezervacijos_data">Rezervacijos data *</label>
        <input type="text" id="rezervacijos_data" name="rezervacijos_data" class="form-control datepicker"
               value="<?php echo isset($data['rezervacijos_data']) ? $data['rezervacijos_data'] : ''; ?>">
	</div>

    <div class="form-group">
        <label for="busena">Būsena *</label>
        <select id="busena" name="busena" class="form-select form-control">
            <?php
            $states = $ordersObj->getStates();
            foreach($states as $key => $val) {
                $selected = "";
                if(isset($data['busena']) && $data['busena'] == $val['code']) {
                    $selected = " selected='selected'";
                }
                echo "<option{$selected} value='{$val['code']}'>{$val['name']}</option>";
            }
            ?>
        </select>
    </div>

    <h4 class="mt-3">Draudimo paslaugos</h4>

    <div class="row w-75">
        <div class="formRowsContainer column">
            <div class="row headerRow d-none">
                <div class="col-5">Draudimas</div>
                <div class="col-4">Numeris</div>
                <div class="col-4"></div>
            </div>
            <?php
            foreach($data['draudimai'] as $index => $draudimas) {
                ?>
                <div class="formRow row col-14 <?php echo ($index > 0 ? '' : 'd-none') ?>">
                    <div class="col-5">
                        <select name="draudimas[]" class="elementSelector form-select form-control <?php echo ($index > 0 ? '' : 'disabled') ?>">
                            <option value="">---------------</option>
                            <?php
                            $insurances = $insurancesObj->getList();
                            foreach($insurances as $key => $val) {
                                $selected = "";
                                if(isset($draudimas['fk_Draudimas']) && $draudimas['fk_Draudimas'] == $val['draudimo_id']) {
                                    $selected = " selected='selected'";
                                }
                                echo "<option{$selected} value='{$val['draudimo_id']}'>{$val['pavadinimas']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-4">
                        <input type="text" name="draudimo_numeris[]" class="form-control"
                               value="<?php echo (isset($draudimas['numeris']) ? $draudimas['numeris'] : '') ?>" />
                    </div>
                    <div class="col-2">
                        <a href="#" class="removeChild">šalinti</a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="w-100">
            <a href="#" class="addChild">Pridėti</a>
        </div>
    </div>

    <input type="hidden" name="id" value="<?php echo $data['rezervacijos_id']; ?>" />

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>