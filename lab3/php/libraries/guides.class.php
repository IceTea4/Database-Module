<?php
/**
 * Darbuotojų redagavimo klasė
 *
 * @author ISK
 */

class guides {

    public function get($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    *
				FROM gidas
				WHERE el_pastas='{$id}'";
        $data = mysql::select($query);

        //
        return isset($data) && isset($data[0]) ? $data[0] : null;
    }

    public function countTrips($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    COUNT(keliones_id) AS kiekis
				FROM kelione
				WHERE fk_Gidas='{$id}'";
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
		
		$query = "SELECT *
				FROM gidas
				ORDER BY el_pastas
				{$limitOffsetString}";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	
	public function getListCount() {
		$query = "SELECT COUNT(el_pastas) as kiekis
				FROM gidas";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}

    public function insert($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "INSERT INTO gidas 
						  (el_pastas,
						   vardas,
						   pavarde,
						   telefono_nr,
						   kalbos,
						   kaina,
						   patirtis_metais) 
				VALUES	  ('{$data['el_pastas']}',
						   '{$data['vardas']}',
						   '{$data['pavarde']}',
						   '{$data['telefono_nr']}',
						   '{$data['kalbos']}',
						   '{$data['kaina']}',"
						   .(empty($data['patirtis_metais']) ? 'NULL' : "'{$data['patirtis_metais']}'")
                           .')';
        mysql::query($query);
    }

    public function update($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "UPDATE gidas
				SET vardas='{$data['vardas']}',
				    pavarde='{$data['pavarde']}',
				    telefono_nr='{$data['telefono_nr']}',
				    kalbos='{$data['kalbos']}',
				    kaina='{$data['kaina']}',
                    patirtis_metais=".(empty($data['patirtis_metais']) ? 'NULL ' : "'{$data['patirtis_metais']}' ")
				."WHERE el_pastas='{$data['el_pastas']}'";
        mysql::query($query);
    }

    public function delete($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "DELETE
                FROM gidas
                WHERE el_pastas='{$id}'";
        mysql::query($query);
    }
}