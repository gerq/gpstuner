<?php

class BookingModel extends BaseSimpleDAL {

    protected $_table = 'booking';

    public function insert($data) {

        $res = null;
        $dateStart = DateTime::createFromFormat(DATE_FORMAT, $data['bookingDate']);

        $dateEnd = clone $dateStart;
        $dateEnd->modify('+2 hours');

        if(isset($data['tableIds'])){
            foreach ($data['tableIds'] as $key => $table) {
                $insertData = array(
                    'bookingFrom' => $dateStart->format(DATE_FORMAT),
                    'bookingTo' => $dateEnd->format(DATE_FORMAT),
                    'tableId' => $table,
                    'bookingDataName' => $data['bookingName'],
                    'bookingEmail' => $data['bookingEmail'],
                    'bookingAddress' => $data['bookingAddress'],
                    'bookingComment' => $data['bookingComment'],
                );
                $res = $this->insertRecords($this->_table, $insertData);
            }
        }

        return $res;
    }

    public function checkReservation($start, $end, $person) {
        $sql = "
            SELECT 
                tableId, 
                tableName, 
                tablePerson 
            FROM tables 
            WHERE 
                tableId not in (
                    SELECT 
                        t.tableId ti
                    FROM 
                        booking b
                    LEFT JOIN
                        tables t USING(tableId)
                    WHERE
                        NOT ((bookingTo <= ?) OR (bookingFrom >= ?))
                )
                
            ORDER BY tablePerson DESC

        ";

        $stmt = $this->_connection->prepare($sql);
        $stmt->bind_param('ss', $start, $end);
        $stmt->execute();

        $stmt->bind_result($tableId, $tableName, $tablePerson);
        $return = array();

        $tables = array();
        while($stmt->fetch()) {
                        $tables[] = array(
                            $tableId,
                            $tableName,
                            $tablePerson
                        );
        }

        $return = array();
        while($person > 0) {
            $minTable = PHP_INT_MAX;
            $tableKey = PHP_INT_MAX;
            foreach ($tables as $key => $table) {
                if(abs($person - $table[2]) < $minTable) {
                    $minTable = abs($person - $table[2]);
                    $tableKey = $key;
                }
            }
            if(isset($tables[$tableKey])){
                $person -= $tables[$tableKey][2];
                $return['tables'][] = $tables[$tableKey];
                unset($tables[$tableKey]);
            } else {
                $person = -1;
            }
        }

        return $return;
    }

    public function reservationList($date) {
        $dateStart = DateTime::createFromFormat(DATE_FORMAT, $date);

        $sql = "
            SELECT 
                t.tableId, 
                t.tableName, 
                t.tablePerson,
                b.bookingFrom,
                b.bookingTo
            FROM tables t
            LEFT JOIN booking b USING(tableId)
            WHERE 
                bookingFrom >= ? AND bookingTo <= ?
            ORDER BY b.bookingFrom, tablePerson

        ";

        $start = $dateStart->format("Y-m-d 00:00:00");
        $end = $dateStart->format("Y-m-d 23:59:59");

        $stmt = $this->_connection->prepare($sql);
        $stmt->bind_param('ss', $start, $end);
        $stmt->execute();

        $stmt->bind_result($tableId, $tableName, $tablePerson, $bookingFrom, $bookingTo);
        
        $t = Translator::getInstance();
        
        $tables = array();
        while($stmt->fetch()) {
                        $tables[] = array(
                            $tableId,
                            $t->translate($tableName),
                            $tablePerson,
                            $bookingFrom,
                            $bookingTo
                        );
        }

        return $tables;       
    }

}