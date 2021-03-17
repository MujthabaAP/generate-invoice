<?php

class helper {

    public $mysqli;

    function __construct() {
        $servername = "db";
        $username = "root";
        $password = "test";
        $dbname = "invoices";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $sql = "INSERT INTO users (name, email, points, referal_code) VALUES ('John', 'john@example.com',0, 'ghj')";
//            // use exec() because no results are returned
//            $conn->exec($sql);
//            echo "New record created successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $this->mysqli = $conn;
    }

}
