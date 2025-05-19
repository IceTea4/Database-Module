<?php
// suformuojame puslapių kelio (breadcrumb) elementų masyvą
$breadcrumbItems = array(array('link' => 'index.php', 'title' => 'Pradžia'), array('link' => "index.php?module=report&action=list", 'title' => "Ataskaita"), array("title" => "Rezervacijų ataskaita"));

// puslapių kelio šabloną
include 'templates/common/breadcrumb.tpl.php';
?>

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
        <label for="dataNuo">Rezervacijos sudarytos nuo:</label>
        <input type="text" id="dataNuo" name="dataNuo" class="form-control datepicker" value="<?php echo isset($fields['dataNuo']) ? htmlspecialchars($fields['dataNuo']) : ''; ?>">
    </div>

    <div class="form-group">
        <label for="dataIki">Rezervacijos sudarytos iki:</label>
        <input type="text" id="dataIki" name="dataIki" class="form-control datepicker" value="<?php echo isset($fields['dataIki']) ? htmlspecialchars($fields['dataIki']) : ''; ?>">
    </div>

    <div class="form-group">
        <label for="busena">Rezervacijos, kurių būsena:</label>
        <select id="busena" name="busena" class="form-select form-control">
            <option value="">---------------</option>
            <?php
            $states = $orderObj->getStates();
            foreach($states as $key => $val) {
                $selected = "";
                if(isset($fields['busena']) && $fields['busena'] == $val['code']) {
                    $selected = " selected='selected'";
                }
                echo "<option{$selected} value='{$val['code']}'>{$val['name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="kainaMax">Rezervacijos, kurių kelionės maximali kaina yra: *(kaina negali būti neigiama)</label>
        <input type="text" id="kainaMax" name="kainaMax" class="form-control" value="<?php echo isset($fields['kainaMax']) ? htmlspecialchars($fields['kainaMax']) : ''; ?>">
    </div>

    <p class="required-note">* pažymėtus laukus užpildyti privaloma</p>

    <input type="submit" class="btn btn-primary w-25" name="submit" value="Sudaryti ataskaitą">
</form>