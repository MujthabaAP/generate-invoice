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
        <link rel="stylesheet" href="css/generate-invoice.css" >

        <title>Create invoice</title>
    </head>
    <body>
        <h1>CREATE INVOICE</h1>

        <div class="container">
            <div class="create-new-contianer">
                <a href="list-invoices.php"><button class="btn btn-success">List of invoices generated</button></a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p class="invoice-to-address"><strong>INVOICE TO</strong></p>
                    <textarea class="custom-text-area" aria-label="With textarea"></textarea>
                </div>
                <div class="col-md-6">
                    <div class="invoice-detail">
                        <label for="basic-url"><strong>INVOICE</strong></label>
                        <address>
                            Invoice no: <label id="invoice-number">87364578</label><br>
                            Date : <label><?= date('Y-m-d'); ?></label>
                        </address>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <table id="example" class="display table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Item Quantity</th>
                                <th>Unit Price (in $)</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Total with tax</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="7"><button id="addRow" class="btn btn-primary">Add new row</button></td>
                            </tr>
                            <tr>
                                <th colspan="5">Discount:</th>
                                <th>
                                    <select size="1" id="select-discount-opt" name="discount-option" class="custom-select-option">
                                        <option value="PERCENTAGE" selected="selected">Percentage (%)</option>
                                        <option value="AMOUNT">Amount ($)</option>
                                    </select></th>
                                <th><input type="text" class="form-control" id="discount-input" name="discount-value" value="0"></th>
                            </tr>
                            <tr>
                                <th colspan="5">Subtotal with tax:</th>
                                <th colspan="2"><label id="line-sub-total-with-tax">0</label></th>
                            </tr>
                            <tr>
                                <th colspan="5">Subtotal without tax:</th>
                                <th colspan="2"><label id="line-sub-total-without-tax">0</label></th>
                            </tr>
                            <tr>
                                <th colspan="5">Total amount:</th>
                                <th colspan="2"><label id="net-total">0</label></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="generate-btn-container">
                        <button id="submitForm" class="btn btn-success">Generate Invoice</button>
                    </div>
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
        <script src="js/generate-invoice.js"></script>
        <!--icons-->
        <script src="https://kit.fontawesome.com/b501d0006e.js" crossorigin="anonymous"></script>
    </body>
</html>
