<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "vendor/autoload.php";
echo "<pre>";



/**
 * Filetools get with filtered or non filtered on directory and subdirectories
 * 
 */
$files = new FileTools();

/**
 * DbpG give postgresql interface from php with auth 
 * 
 */
$dba= new DbPg( );

$db= $dba->interface();
/**
 * 
 * get file list 
 * 
 */
$as = $files->get_file_list_recursively(__DIR__, "xml");

        /**
         *  get filelist and each file parse with simplexml 
         * 
         */
foreach ($as as $key => $value) {

    $books = simplexml_load_file($value);

    foreach ($books as $book) {


        /**
         * 
         * add author authors table if not exist
         * 
         */
        $q = "INSERT INTO authors (anames) VALUES ('$book->author') ON CONFLICT DO NOTHING";
        $ret = pg_query($db, $q);
        if (!$ret) {

        /**
         * 
         * add book authors if new created
         * 
         */
            echo $ret;
            $qb = "INSERT INTO books (author,bnames) VALUES ('$book->author',$book->name ) ON CONFLICT DO NOTHING";
            $retb = pg_query($db, $qb);
            if (!$retb) {
                echo "kitap ok" . $retb;

            } else {

                echo $retb;
            }


        } else {
        /**
         * 
         * add book authors if before created
         * 
         */
            $author = "SELECT * from authors where anames = '$book->author' ";
            
            $reta = pg_query($db, $author);
            while ($row = pg_fetch_row($reta)) {
                $au= $row[0];
            }
            $qb = "INSERT INTO books (author,bnames) VALUES ($au,'$book->name' ) ON CONFLICT DO NOTHING";
            $retb = pg_query($db, $qb);
            if (!$retb) {
                echo "kitap ok" . $retb;

            } else {

                echo $book->author ." ==> ". $book->name. " NOT inserted on ". $value. PHP_EOL;
            }

        }


    }
}

?>