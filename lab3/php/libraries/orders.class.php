<?php
/**
 * Darbuotojų redagavimo klasė
 *
 * @author ISK
 */

class orders {

    private $rezervacija_table = '';
    private $draudimas_table = '';
    private $draudimo_polisas_table = '';
    private $kelione_table = '';
    private $klientas_table = '';
    private $rezervacijos_busena_table = '';

    public function __construct() {
        $this->rezervacija_table = config::DB_PREFIX . 'rezervacija';
        $this->draudimas_table = config::DB_PREFIX . 'draudimas';
        $this->draudimo_polisas_table = config::DB_PREFIX . 'draudimo_polisas';
        $this->kelione_table = config::DB_PREFIX . 'kelione';
        $this->klientas_table = config::DB_PREFIX . 'klientas';
        $this->rezervacijos_busena_table = config::DB_PREFIX . 'rezervacijos_busena';
    }

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

    public function getCustomerOrder($dateFrom, $dateTo, $state, $price) {
        $dateFrom = mysql::escapeFieldForSQL($dateFrom);
        $dateTo = mysql::escapeFieldForSQL($dateTo);
        $state = mysql::escapeFieldForSQL($state);
        $price = mysql::escapeFieldForSQL($price);

        $whereDraudimas = "";
        $whereKelione = "";
        if(!empty($dateFrom)) {
            $whereDraudimas .= " WHERE `{$this->rezervacija_table}`.`rezervacijos_data`>='{$dateFrom}'";

            if(!empty($dateTo)) {
                $whereDraudimas .= " AND `{$this->rezervacija_table}`.`rezervacijos_data`<='{$dateTo}'";
            }
        } else {
            if(!empty($dateTo)) {
                $whereDraudimas .= " WHERE `{$this->rezervacija_table}`.`rezervacijos_data`<='{$dateTo}'";
            }
        }

        if (!empty($state)) {
            $whereDraudimas .= (empty($whereDraudimas) ? " WHERE " : " AND ") . "`{$this->rezervacija_table}`.`busena`='{$state}'";
        }

        if (!empty($price)) {
            $whereKelione .= (empty($whereDraudimas) ? " WHERE " : " AND ") . "`{$this->kelione_table}`.`kaina`<='{$price}'";
        }

        $query = "SELECT rezervacija.rezervacijos_id,
                           rezervacija.rezervacijos_data,
                           klientas.el_pastas,
                           kelione.kaina AS keliones_kaina,
                           d.bendra_draudimo_kaina,
                           klientas.vardas,
                           klientas.pavarde,
                           s.bendra_kliento_draudimo_kaina,
                           t.bendra_kliento_kelioniu_kaina,
                           s.max_kliento_draudimo_kaina,
                           t.avg_kliento_kelioniu_kaina
                    FROM rezervacija
                    INNER JOIN klientas ON rezervacija.fk_Klientas=klientas.el_pastas
                    INNER JOIN kelione ON rezervacija.fk_Kelione=kelione.keliones_id
                    LEFT JOIN (
                        SELECT draudimo_polisas.fk_Rezervacija,
                            SUM(draudimas.kaina) AS bendra_draudimo_kaina
                        FROM draudimo_polisas
                        INNER JOIN draudimas ON draudimas.draudimo_id=draudimo_polisas.fk_Draudimas
                        GROUP BY draudimo_polisas.fk_Rezervacija
                    ) d ON rezervacija.rezervacijos_id=d.fk_Rezervacija
                    INNER JOIN (
                        SELECT rezervacija.fk_Klientas,
                            IFNULL(SUM(kelione.kaina), 0) AS bendra_kliento_kelioniu_kaina,
                            IFNULL(MAX(kelione.kaina), 0) AS avg_kliento_kelioniu_kaina
                        FROM kelione
                        INNER JOIN rezervacija ON rezervacija.fk_Kelione=kelione.keliones_id
                        {$whereDraudimas}
                        {$whereKelione}
                        GROUP BY rezervacija.fk_Klientas
                    ) t ON t.fk_Klientas=klientas.el_pastas
                    INNER JOIN (
                        SELECT rezervacija.fk_Klientas,
                            IFNULL(SUM(draudimas.kaina), 0) AS bendra_kliento_draudimo_kaina,
                            IFNULL(ROUND(AVG(draudimas.kaina)), 0) AS max_kliento_draudimo_kaina
                        FROM rezervacija
                        LEFT JOIN (draudimo_polisas
                            INNER JOIN draudimas ON draudimo_polisas.fk_Draudimas=draudimas.draudimo_id
                        ) ON rezervacija.rezervacijos_id=draudimo_polisas.fk_Rezervacija
                        {$whereDraudimas}
                        GROUP BY rezervacija.fk_Klientas
                    ) s ON s.fk_Klientas=klientas.el_pastas
                    {$whereDraudimas}
                    {$whereKelione}
                    ORDER BY LOWER(klientas.pavarde),
         rezervacija.rezervacijos_data";
        $data = mysql::select($query);

        return $data;
    }

    public function getSumPriceOfOrders($dateFrom, $dateTo, $state, $price) {
        $dateFrom = mysql::escapeFieldForSQL($dateFrom);
        $dateTo = mysql::escapeFieldForSQL($dateTo);
        $state = mysql::escapeFieldForSQL($state);
        $price = mysql::escapeFieldForSQL($price);

        $whereDraudimas = "";
        $whereKelione = "";
        if(!empty($dateFrom)) {
            $whereDraudimas .= " WHERE `{$this->rezervacija_table}`.`rezervacijos_data`>='{$dateFrom}'";

            if(!empty($dateTo)) {
                $whereDraudimas .= " AND `{$this->rezervacija_table}`.`rezervacijos_data`<='{$dateTo}'";
            }
        } else {
            if(!empty($dateTo)) {
                $whereDraudimas .= " WHERE `{$this->rezervacija_table}`.`rezervacijos_data`<='{$dateTo}'";
            }
        }

        if (!empty($state)) {
            $whereDraudimas .= (empty($whereDraudimas) ? " WHERE " : " AND ") . "`{$this->rezervacija_table}`.`busena`='{$state}'";
        }

        if (!empty($price)) {
            $whereKelione .= (empty($whereDraudimas) ? " WHERE " : " AND ") . "`{$this->kelione_table}`.`kaina`<='{$price}'";
        }

        $query = "SELECT
                    (SELECT SUM(kelione.kaina) FROM kelione INNER JOIN rezervacija ON rezervacija.fk_Kelione=kelione.keliones_id {$whereKelione} {$whereDraudimas}) AS kelioniu_suma,
                    (SELECT SUM(draudimas.kaina)
                     FROM rezervacija 
                     LEFT JOIN (draudimo_polisas 
                         INNER JOIN draudimas ON draudimo_polisas.fk_Draudimas = draudimas.draudimo_id
                     ) ON rezervacija.rezervacijos_id = draudimo_polisas.fk_Rezervacija
                     INNER JOIN kelione ON rezervacija.fk_Kelione=kelione.keliones_id
                     {$whereDraudimas}
                     {$whereKelione}
                     ) AS draudimo_suma";
        $data = mysql::select($query);

        return $data;
    }
}
