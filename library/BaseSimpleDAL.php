<?php

class BaseSimpleDAL extends Singleton {

    protected $_connection = null;

    public function __construct() {

    }

    public function init() {
        $this->setConnection(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    }

    public function setConnection( $host, $user, $password, $database ) {
        $this->_connection = new mysqli( $host, $user, $password, $database );
        if( mysqli_connect_errno() )
        {
            trigger_error('CONNECTION ERROR: . '.$this->connections[$connection_id]->error, E_USER_ERROR);
        }   
         
        return $this->_connection;
    }

    public function closeConnection() {
        $this->_connection->close();
    }

    public function updateRecords( $table, $changes, $condition ) {
        $update = "UPDATE " . $table . " SET ";
        foreach( $changes as $field => $value )
        {
            $update .= "`" . $field . "`='{$value}',";
        }
             
        // remove our trailing ,
        $update = substr($update, 0, -1);
        if( $condition != '' )
        {
            $update .= "WHERE " . $condition;
        }
         
        $this->executeQuery( $update );
         
        return true;
         
    }

    public function insertRecords( $table, $data ) {
        // setup some variables for fields and values
        $fields  = "";
        $values = "";
         
        // populate them
        foreach ($data as $f => $v)
        {
             
            $fields  .= "`$f`,";
            $values .= ( is_numeric( $v ) && ( intval( $v ) == $v ) ) ? $v."," : "'$v',";
         
        }
         
        // remove our trailing ,
        $fields = substr($fields, 0, -1);
        // remove our trailing ,
        $values = substr($values, 0, -1);
         
        $insert = "INSERT INTO $table ({$fields}) VALUES({$values})";
        $this->executeQuery( $insert );
        return true;
    }

    public function executeQuery( $queryStr ) {
        if( !$result = $this->_connection->query( $queryStr ) )
        {
            trigger_error('QUERY ERROR: '.$this->_connection->error, E_USER_ERROR);
        }
        else
        {
            $this->last = $result;
        }
         
    }

    public function getRows() {
        return $this->last->fetch_array(MYSQLI_ASSOC);
    }

    public function __deconstruct() {
        $this->_connection->close();
    }    

}