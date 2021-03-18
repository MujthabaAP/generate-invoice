<?php
include './config/helper.php';

$obj = new helper();
$invoiceData = '';

$invoiceData = $obj->getAllInvoices();
if (!empty($invoiceData['data'])) {
    $invoiceData = $invoiceData['data'];
} else {
    echo 'Sorry, invoice data is not found.';
    die;
}
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--dataTables CSS-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
        <!--google font-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <!--custom external style sheet-->
        <link rel="stylesheet" href="css/list-invoices.css" >
        <title>List invoices</title>
    </head>
    <body>
        <h1>List of invoices</h1>

        <div class="container">
            <div class="create-new-contianer">
                <a href="index.php"><button id="submitForm" class="btn btn-success">Create a new invoice</button></a>
            </div>
            <div class="row">
                <div class="col">
                    <table id="example" class="display table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl.No</th>
                                <th>Invoice number</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($invoiceData as $key => $invoice) {
                                ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $invoice['invoice_no'] ?></td>
                                    <td><?= $invoice['created_at'] ?></td>
                                    <td><a href="print-invoice.php?invoice_id=<?= $invoice['id'] ?>"><i class="fa fa-print success" aria-hidden="true"></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!--To generate table using jquery plugin-->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="js/list-invoices.js"></script>
        <!--icons-->
        <script src="https://kit.fontawesome.com/b501d0006e.js" crossorigin="anonymous"></script>
    </body>
</html>