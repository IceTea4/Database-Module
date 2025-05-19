<?php
/**
 * Darbuotojų redagavimo klasė
 *
 * @author ISK
 */

class orders {

    public function get($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    rezervacija.*,
                    kelione.pavadinimas AS kelione,
                    CONCAT(klientas.vardas,' ',klientas.pavarde) AS klientas,
                    rezervacijos_busena.name as rezervacijos_busena
				FROM rezervacija
				LEFT OUTER JOIN kelione 
				    ON rezervacija.fk_Kelione=kelione.keliones_id
				LEFT OUTER JOIN klientas 
				    ON rezervacija.fk_Klientas=klientas.el_pastas
				LEFT OUTER JOIN rezervacijos_busena 
				    ON rezervacija.busena=rezervacijos_busena.code
				WHERE rezervacijos_id='{$id}'";
        $data = mysql::select($query);

        //
        return isset($data) && isset($data[0]) ? $data[0] : null;
    }

    public function countPayments($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    COUNT(id) AS kiekis
				FROM mokejimas
				WHERE fk_Rezervacija='{$id}'";
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
                    rezervacija.*,
                    kelione.pavadinimas AS kelione,
                    CONCAT(klientas.vardas,' ',klientas.pavarde) AS klientas,
                    rezervacijos_busena.name as rezervacijos_busena
				FROM rezervacija
				LEFT OUTER JOIN kelione 
				    ON rezervacija.fk_Kelione=kelione.keliones_id
				LEFT OUTER JOIN klientas 
				    ON rezervacija.fk_Klientas=klientas.el_pastas
				LEFT OUTER JOIN rezervacijos_busena 
				    ON rezervacija.busena=rezervacijos_busena.code
				ORDER BY rezervacijos_id
				{$limitOffsetString}";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	
	public function getListCount() {
		$query = "SELECT COUNT(rezervacijos_id) as kiekis
				FROM rezervacija";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}

    public function getStates() {
        $query = "SELECT
                    *
				FROM rezervacijos_busena";
        $data = mysql::select($query);

        //
        return $data;
    }

    public function insert($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "INSERT INTO rezervacija 
						  (rezervacijos_id,
						   fk_Kelione,
						   fk_Klientas,
						   rezervacijos_data,
						   busena) 
				VALUES	  ('{$data['rezervacijos_id']}',
						   '{$data['fk_Kelione']}',
						   '{$data['fk_Klientas']}',
						   '{$data['rezervacijos_data']}',
				           'pending')";
        mysql::query($query);
    }

    public function update($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "UPDATE rezervacija
				SET rezervacijos_data='{$data['rezervacijos_data']}',
				    busena='{$data['busena']}'
				WHERE rezervacijos_id='{$data['rezervacijos_id']}'";
        mysql::query($query);
    }

    public function delete($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "DELETE
                FROM rezervacija
                WHERE rezervacijos_id='{$id}'";
        mysql::query($query);
    }

    public function getInsurances($id) {
        $query = "SELECT 
                    draudimo_polisas.fk_Draudimas,
                    draudimo_polisas.numeris
				FROM draudimo_polisas
				WHERE fk_Rezervacija='{$id}'";
        $data = mysql::select($query);

        //
        return $data;
    }

    public function insertInsurances($data) {
        $values = array_map(function ($item) {
            $item = mysql::escapeFieldsArrayForSQL($item);
            return "('{$item['numeris']}','{$item['fk_Draudimas']}','{$item['fk_Rezervacija']}')";
        }, $data);
        $allValues = implode(',', $values);

        $query = "INSERT INTO draudimo_polisas 
				    (numeris, fk_Draudimas, fk_Rezervacija) 
				  VALUES {$allValues}";
        mysql::query($query);
    }

    public function deleteInsurances($id) {
        $query = "DELETE FROM draudimo_polisas
                  WHERE fk_Rezervacija='{$id}'";
        mysql::query($query);
    }
}
