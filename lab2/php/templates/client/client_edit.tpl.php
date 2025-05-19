<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Pradžia</a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?module=<?php echo $module; ?>&action=list">Klientai</a></li>
		<li class="breadcrumb-item active" aria-current="page">Kliento duomenų redagavimas</li>
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
		<label for="el_pastas">El paštas</label>
		<input type="text" id="el_pastas" name="el_pastas" class="form-control"
               value="<?php echo $data['el_pastas']; ?>"
               readonly>
	</div>

    <div class="form-group">
        <label for="vardas">Vardas *</label>
        <input type="text" id="vardas" name="vardas" class="form-control"
               value="<?php echo isset($data['vardas']) ? $data['vardas'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="pavarde">Pavardė *</label>
        <input type="text" id="pavarde" name="pavarde" class="form-control"
               value="<?php echo isset($data['pavarde']) ? $data['pavarde'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="telefono_nr">Telefonas *</label>
        <input type="text" id="telefono_nr" name="telefono_nr" class="form-control"
               value="<?php echo isset($data['telefono_nr']) ? $data['telefono_nr'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="adresas">Adresas</label>
        <input type="text" id="adresas" name="adresas" class="form-control"
               value="<?php echo isset($data['adresas']) ? $data['adresas'] : ''; ?>">
    </div>

	<p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

	<input type="submit" class="btn btn-primary w-25" name="submit" value="Išsaugoti">
</form>