<?php
/**
 * Darbuotojų redagavimo klasė
 *
 * @author ISK
 */

class trips {

    public function get($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    *
				FROM kelione
				WHERE keliones_id='{$id}'";
        $data = mysql::select($query);

        //
        return isset($data) && isset($data[0]) ? $data[0] : null;
    }

    public function countOrders($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    COUNT(rezervacijos_id) AS kiekis
				FROM rezervacija
				WHERE fk_Kelione='{$id}'";
        $data = mysql::select($query);

        //
        return $data[0]['kiekis'];
    }

    public function getList($limit = null, $offset = null) {
		if($limit) {
			$limit = mysql::escapeFieldForSQL($limit);
		}
		if($offset) {
			$offset = mysql::escapeFieldForSQL($offset);
		}

		$limitOffsetString = "";
		if(isset($limit)) {
			$limitOffsetString .= " LIMIT {$limit}";
		}
		if(isset($offset)) {
			$limitOffsetString .= " OFFSET {$offset}";
		}
		
		$query = "SELECT 
                    kelione.*,
                    CONCAT(gidas.vardas,' ',gidas.pavarde) AS gidas
				FROM kelione
				LEFT OUTER JOIN gidas 
				    ON kelione.fk_Gidas=gidas.el_pastas
                ORDER BY keliones_id
				{$limitOffsetString}";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	
	public function getListCount() {
		$query = "SELECT COUNT(keliones_id) as kiekis
				FROM kelione";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}

    public function insert($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "INSERT INTO kelione 
						  (keliones_id,
						   pavadinimas,
						   aprasymas,
						   organizatorius,
						   pradzios_data,
						   pabaigos_data,
						   vietu_skaicius,
						   kaina,
						   fk_Gidas) 
				VALUES	  ('{$data['keliones_id']}',
						   '{$data['pavadinimas']}',
						   '{$data['aprasymas']}',
						   '{$data['organizatorius']}',
						   '{$data['pradzios_data']}',
						   '{$data['pabaigos_data']}',
						   '{$data['vietu_skaicius']}',
						   '{$data['kaina']}',
						   '{$data['fk_Gidas']}')";
        mysql::query($query);
    }

    public function update($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "UPDATE kelione
				SET pavadinimas='{$data['pavadinimas']}',
				    aprasymas='{$data['aprasymas']}',
				    organizatorius='{$data['organizatorius']}',
				    pradzios_data='{$data['pradzios_data']}',
				    pabaigos_data='{$data['pabaigos_data']}',
				    vietu_skaicius='{$data['vietu_skaicius']}',
				    kaina='{$data['kaina']}',
				    fk_Gidas='{$data['fk_Gidas']}'
				WHERE keliones_id='{$data['keliones_id']}'";
        mysql::query($query);
    }

    public function delete($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "DELETE
                FROM kelione
                WHERE keliones_id='{$id}'";
        mysql::query($query);
    }
}