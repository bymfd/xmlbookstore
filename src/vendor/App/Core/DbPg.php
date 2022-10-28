<?php

/**
 * @param string $host connection host
 * @param string $p connection port 
 * @param string $dbn connection database
 * @param string $dbu connection user for database
 * @param string $dbp connection user password for database
 * @return string[] mixed
 */
class DbPg
{

    function __construct($host = "db", $p = "5432", $dbn = "dbname", $dbu = "dbuser", $dbp = "dbpwd")
    {

        $this->host = "host = $host"; // docker service name
        $this->port = "port = $p";
        $this->dbname = "dbname = $dbn";
        $this->credentials = "user = $dbu password=$dbp";
        $this->db = pg_connect("$this->host $this->port $this->dbname $this->credentials");

        /**
         * 
         * if database not created create;
         * 
         */
        $q = "CREATE TABLE IF NOT EXISTS  authors (author serial PRIMARY KEY,anames VARCHAR ( 250 ) UNIQUE NOT NULL);
        CREATE TABLE IF NOT EXISTS  books (author serial PRIMARY KEY,	bnames VARCHAR ( 250 ) NOT NULL,  CONSTRAINT fk_author FOREIGN KEY(author) REFERENCES authors(author))";
        $ret = pg_query($this->db, $q);
        if (!$ret) {
            return pg_last_error($this->db);
        } else {
            return true;
        }

    }

    /**
     * 
     * return genrated interface for use 
     * 
     */
    public function interface ()
    {


        return $this->db;

    }


}