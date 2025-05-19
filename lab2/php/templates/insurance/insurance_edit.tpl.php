<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Pradžia</a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?module=<?php echo $module; ?>&action=list">Draudimai</a></li>
		<li class="breadcrumb-item active" aria-current="page">Draudimo redagavimas</li>
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
		<label for="draudimo_id">Id</label>
		<input type="text" id="draudimo_id" name="draudimo_id" class="form-control"
               value="<?php echo isset($data['draudimo_id']) ? $data['draudimo_id'] : ''; ?>"
                readonly>
	</div>

    <div class="form-group">
        <label for="pavadinimas">Pavadinimas *</label>
        <input type="text" id="pavadinimas" name="pavadinimas" class="form-control"
               value="<?php echo isset($data['pavadinimas']) ? $data['pavadinimas'] : ''; ?>">
	</div>

    <div class="form-group">
        <label for="aprasymas">Aprašymas</label>
        <textarea type="text" id="aprasymas" name="aprasymas" class="form-control">
            <?php echo isset($data['aprasymas']) ? $data['aprasymas'] : ''; ?>
        </textarea>
    </div>

    <div class="form-group">
        <label for="kaina">Kaina *</label>
        <input type="text" id="kaina" name="kaina" class="form-control"
               value="<?php echo isset($data['kaina']) ? $data['kaina'] : ''; ?>">
	</div>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>