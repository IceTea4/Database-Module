<?php
/**
 * Darbuotojų redagavimo klasė
 *
 * @author ISK
 */

class clients {

    public function get($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    *
				FROM klientas
				WHERE el_pastas='{$id}'";
        $data = mysql::select($query);

        //
        return isset($data) && isset($data[0]) ? $data[0] : null;
    }

    public function countOrders($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "SELECT 
                    COUNT(rezervacijos_id) AS kiekis
				FROM rezervacija
				WHERE fk_Klientas='{$id}'";
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
				FROM klientas
				ORDER BY el_pastas
				{$limitOffsetString}";
		$data = mysql::select($query);
		
		//
		return $data;
	}
	
	public function getListCount() {
		$query = "SELECT COUNT(el_pastas) as kiekis
				FROM klientas";
		$data = mysql::select($query);
		
		//
		return $data[0]['kiekis'];
	}

    public function insert($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "INSERT INTO klientas 
						  (el_pastas,
						   vardas,
						   pavarde,
						   telefono_nr,
						   adresas,
						   registracijos_data) 
				VALUES	  ('{$data['el_pastas']}',
						   '{$data['vardas']}',
						   '{$data['pavarde']}',
						   '{$data['telefono_nr']}',"
                           .(empty($data['adresas']) ? 'NULL,' : "'{$data['adresas']}',")
				           ."CURRENT_DATE)";
        mysql::query($query);
    }

    public function update($data) {
        $data = mysql::escapeFieldsArrayForSQL($data);

        $query = "UPDATE klientas
				SET vardas='{$data['vardas']}',
				    pavarde='{$data['pavarde']}',
				    telefono_nr='{$data['telefono_nr']}',
                    adresas=".(empty($data['adresas']) ? 'NULL ' : "'{$data['adresas']}' ")
				."WHERE el_pastas='{$data['el_pastas']}'";
        mysql::query($query);
    }

    public function delete($id) {
        $id = mysql::escapeFieldForSQL($id);

        $query = "DELETE
                FROM klientas
                WHERE el_pastas='{$id}'";
        mysql::query($query);
    }
}