<?php
/**
 * Darbuotojų redagavimo klasė
 *
 * @author ISK
 */

class insurances {

    public function get($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    *
				FROM draudimas
				WHERE draudimo_id='{$id}'";
        $data = mysql::select($query);

        //
        return isset($data) && isset($data[0]) ? $data[0] : null;
    }

    public function countPolicies($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    COUNT(id) AS kiekis
				FROM draudimo_polisas
				WHERE fk_Draudimas='{$id}'";
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
                    *
				FROM draudimas
				ORDER BY draudimo_id
				{$limitOffsetString}";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	
	public function getListCount() {
		$query = "SELECT COUNT(draudimo_id) as kiekis
				FROM draudimas";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}

    public function insert($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "INSERT INTO draudimas 
						  (draudimo_id,
						   pavadinimas,
						   aprasymas,
						   kaina) 
				VALUES	  ('{$data['draudimo_id']}',
						   '{$data['pavadinimas']}',"
                           .(empty($data['aprasymas']) ? 'NULL,' : "'{$data['aprasymas']}',")
						   ."'{$data['kaina']}')";
        mysql::query($query);
    }

    public function update($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "UPDATE draudimas
				SET pavadinimas='{$data['pavadinimas']}',
				    aprasymas=".(empty($data['aprasymas']) ? 'NULL,' : "'{$data['aprasymas']}',")
				    ."kaina='{$data['kaina']}'
				WHERE draudimo_id='{$data['draudimo_id']}'";
        mysql::query($query);
    }

    public function delete($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "DELETE
                FROM draudimas
                WHERE draudimo_id='{$id}'";
        mysql::query($query);
    }
}