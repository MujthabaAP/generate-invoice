<?php
include './config/helper.php';


$obj = new helper();
$invoiceData = '';
if (!empty($_GET['invoice_id'])) {
    $invoiceData = $obj->getInvoiceDetailsById(trim($_GET['invoice_id']));
    if (!empty($invoiceData)) {
        $invoiceData = $invoiceData['data'];
    } else {
        echo 'Sorry, invoice data is not found.';
        die;
    }
} else {
    echo 'The invoice id is missing.';
    die;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Print Invoice</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="css/print-invoice.css">
    </head>
    <!--onload="window.print();"-->
    <body onload="window.print();">
        <div class="create-new-contianer">
            <a href="index.php"><button id="submitForm" class="btn btn-success">Create a new invoice</button></a>
        </div>

        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> Lorem Ipsum, Inc.
                            <small class="pull-right">Date: <?= $invoiceData[0]['created_at'] ?></small>
                        </h2>

                    </div>
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Admin, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@yopmail.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <?= $invoiceData[0]['invoice_to'] ?>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #<?= $invoiceData[0]['invoice_no'] ?></b><br>
                        <br>
                        <b>Order ID:</b> 4F3S8J<br>
                        <b>Payment Due:</b> 2021-05-17<br>
                        <b>Account:</b> 968-34567-345686
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Product name</th>
                                    <th>Quantity</th>
                                    <th>Unit price</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    <th>Total with tax</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($invoiceData as $key => $invoice) {
                                    $lineTotal = ($invoice['quantity'] * $invoice['unit_price']);
                                    if ($invoice['tax'] != 0) {
                                        $subTotalWitTax = ($lineTotal) + (($lineTotal * $invoice['tax']) / 100);
                                    } else {
                                        $subTotalWitTax = $lineTotal;
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $invoice['item_name'] ?></td>
                                        <td><?= $invoice['quantity'] ?></td>
                                        <td><?= $invoice['unit_price'] ?></td>
                                        <td><?= $invoice['tax'] ?></td>
                                        <td><?= '$' . ($lineTotal) ?></td>
                                        <td><?= '$' . $subTotalWitTax ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-sm-6">
                        <p class="lead">Payment Methods:</p>

                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            Lorem ipsum dolor sit amet,dolore magna aliqua. Ut enim ad minim venialamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <p class="lead">Amount details</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Discount <?= ($invoiceData[0]['discount_type'] == 'PERCENTAGE') ? '(%)' : '($)' ?>:</th>
                                    <td><?= $invoiceData[0]['discount_value'] ?></td>
                                </tr>
                                <tr>
                                    <th>Subtotal with tax</th>
                                    <td>$<?= $invoiceData[0]['sub_total_tax'] ?></td>
                                </tr>
                                <tr>
                                    <th>Subtotal without tax:</th>
                                    <td>$<?= $invoiceData[0]['sub_total_without_tax'] ?></td>
                                </tr>
                                <tr>
                                    <th>Total amount:</th>
                                    <td>$<?= $invoiceData[0]['net_total'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->

        <!--icons-->
        <script src="https://kit.fontawesome.com/b501d0006e.js" crossorigin="anonymous"></script>
    </body>
</html>
