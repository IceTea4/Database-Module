<ul id="reportInfo">
    <li class="title">Sudarytų rezervacijų ataskaita</li>
    <li>Sudarymo data: <span><?php echo date("Y-m-d"); ?></span></li>
    <li>Rezervacijų sudarymo laikotarpis:
        <span>
		<?php
        if(!empty($data['dataNuo'])) {
            if(!empty($data['dataIki'])) {
                echo "nuo {$data['dataNuo']} iki {$data['dataIki']}";
            } else {
                echo "nuo {$data['dataNuo']}";
            }
        } else {
            if(!empty($data['dataIki'])) {
                echo "iki {$data['dataIki']}";
            } else {
                echo "nenurodyta";
            }
        }
        ?>
		</span>
    </li>
    <li>Rezervacijų būsena:
        <span>
    <?php
    if (!empty($data['busena'])) {
        echo htmlspecialchars($data['busena']);
    } else {
        echo "nenurodyta";
    }
    ?>
    </span>
    </li>
    <li>Rezervacijų kelionių kainos riba:
        <span>
		<?php
        if (!empty($data['kainaMax'])) {
            echo htmlspecialchars($data['kainaMax']);
        } else {
            echo "nenurodyta";
        }
        ?>
		</span>
    </li>
</ul>
<?php
if(!empty($ordersData) && isset($ordersData[0]['rezervacijos_id'])) { ?>
    <table class="table" style="table-layout: fixed; width: 100%;">
        <colgroup>
            <col style="width: 25%;">
            <col style="width: 25%;">
            <col style="width: 25%;">
            <col style="width: 25%;">
        </colgroup>
        <thead>
        <tr>
            <th>Rezervacija</th>
            <th>Data</th>
            <th>Kelionės kaina</th>
            <th>Užsakyto draudimo kaina</th>
        </tr>
        </thead>

        <tbody>
        <?php
        // suformuojame lentelę
        for($i = 0; $i < sizeof($ordersData); $i++) {

            if($i == 0 || $ordersData[$i]['el_pastas'] != $ordersData[$i-1]['el_pastas']) {
                echo
                    "<tr class='table-primary'>"
                    . "<td colspan='4'>{$ordersData[$i]['vardas']} {$ordersData[$i]['pavarde']}</td>"
                    . "</tr>";
            }

            if($ordersData[$i]['bendra_draudimo_kaina'] == 0) {
                $ordersData[$i]['bendra_draudimo_kaina'] = "neužsakyta";
            } else {
                $ordersData[$i]['bendra_draudimo_kaina'] .= " &euro;";
            }

            echo
                "<tr>"
                . "<td>{$ordersData[$i]['rezervacijos_id']}</td>"
                . "<td>{$ordersData[$i]['rezervacijos_data']}</td>"
                . "<td>{$ordersData[$i]['keliones_kaina']} &euro;</td>"
                . "<td>{$ordersData[$i]['bendra_draudimo_kaina']}</td>"
                . "</tr>";
            if($i == (sizeof($ordersData) - 1) || $ordersData[$i]['el_pastas'] != $ordersData[$i+1]['el_pastas']) {
                if($ordersData[$i]['bendra_kliento_draudimo_kaina'] == 0) {
                    $ordersData[$i]['bendra_kliento_draudimo_kaina'] = "neužsakyta";
                } else {
                    $ordersData[$i]['bendra_kliento_draudimo_kaina'] .= " &euro;";
                }

                if($ordersData[$i]['max_kliento_draudimo_kaina'] == 0) {
                    $ordersData[$i]['max_kliento_draudimo_kaina'] = "nėra";
                } else {
                    $ordersData[$i]['max_kliento_draudimo_kaina'] .= " &euro;";
                }

                echo "<tr>"
                    . "<td colspan='2'></td>"
                    . "<td>{$ordersData[$i]['bendra_kliento_kelioniu_kaina']} - {$ordersData[$i]['avg_kliento_kelioniu_kaina']} &euro;</td>"
                    . "<td>{$ordersData[$i]['bendra_kliento_draudimo_kaina']} - {$ordersData[$i]['max_kliento_draudimo_kaina']}</td>"
                    . "</tr>";
            }
        }
        ?>

        <tr>
            <td colspan='4'>Bendra suma</td>
        </tr>

        <tr>
            <td colspan="2"></td>
            <td><?php echo $totalPrice[0]['kelioniu_suma']; ?> &euro;</td>
            <td>
                <?php
                if($totalPrice[0]['draudimo_suma'] == 0) {
                    $totalPrice[0]['draudimo_suma'] = "neužsakyta";
                } else {
                    $totalPrice[0]['draudimo_suma'] .= " &euro;";
                }

                echo $totalPrice[0]['draudimo_suma'];
                ?>
            </td>
        </tr>
        </tbody>
    </table>
    <a href="index.php?module=report&action=list" title="Nauja ataskaita" style="margin-bottom: 15px" class="button large float-right">nauja ataskaita</a>
    <?php
} else {
    ?>
    <div class="warningBox">
        Pagal nurodytus parametrus tokių rezervacijų nebuvo sudaryta.
    </div>
    <?php
}
?>