<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class helper {

    public $mysqli;

    function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "test";
        $dbname = "fingent";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$sql = "INSERT INTO users (name, email, points, referal_code) VALUES ('John', 'john@example.com',0, 'ghj')";
            // use exec() because no results are returned
            //$conn->exec($sql);
            //echo "New record created successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $this->mysqli = $conn;
    }

    public function getInvoiceDetails($invoiceNumber) {
        $response = ['status' => 'failed', 'message' => 'The invoice number is empty.'];
        if (!empty($invoiceNumber)) {
            $sql = "SELECT * FROM `invoices` WHERE `invoice_no`='{$invoiceNumber}' and is_active=true";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            if (!empty($result)) {
                $response = ['status' => 'success', 'message' => 'data fetched successfully.', 'data' => $result[0]];
            }
        }

        return $response;
    }

    public function getInvoiceDetailsById($id) {
        $response = ['status' => 'failed', 'message' => 'The invoice id is empty.'];
        if (!empty($id)) {
            $sql = "SELECT * FROM `invoices`
                    left join invoice_items on invoice_items.invoice_id=invoices.id
                    where invoice_items.is_active=true 
                    and invoices.is_active=true
                    and invoices.id='{$id}';";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();

            if (!empty($result)) {
                $response = ['status' => 'success', 'message' => 'data fetched successfully.', 'data' => $result];
            }
        }

        return $response;
    }

    public function getAllInvoices() {
        $response = ['status' => 'failed', 'message' => 'The invoice number is empty.'];
        $sql = "SELECT * FROM `invoices` WHERE is_active=true";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        if (!empty($result)) {
            $response = ['status' => 'success', 'message' => 'data fetched successfully.', 'data' => $result];
        }
        return $response;
    }

}
