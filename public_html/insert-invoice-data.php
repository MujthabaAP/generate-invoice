<?php

include './config/helper.php';


$obj = new helper();

$errors = [];
if (empty($_POST['invoice_no'])) {
    $errors[] = 'Invoice number is empty.';
}
if (empty($_POST['selected_discount_opt'])) {
    $errors[] = 'selected_discount_opt is empty.';
}
if (empty($_POST['total_without_tax'])) {
    $errors[] = 'total_without_tax is empty.';
}
if (empty($_POST['total_with_tax'])) {
    $errors[] = 'total_with_tax is empty.';
}
if (empty($_POST['grand_total'])) {
    $errors[] = 'grand_total is empty.';
}
if (empty($_POST['invoice_to'])) {
    $errors[] = 'invoice_to is empty.';
}
if (empty($_POST['invoice_no'])) {
    $errors[] = 'invoice_no is empty.';
}

foreach ($_POST['item'] as $item) {
    if (empty($item['name'])) {
        $errors[] = 'Item name is empty.';
    }
    if (empty($item['quantity'])) {
        $errors[] = 'quantity is empty.';
    }
    if (empty($item['unit-price'])) {
        $errors[] = 'unit-price is empty.';
    }
}

$response = '';
if (empty($errors)) {
    $invoiceNo = trim($_POST['invoice_no']);
    $invoiceTo = trim($_POST['invoice_to']);
    $discountOption = trim($_POST['selected_discount_opt']);
    $subTotalTax = trim($_POST['total_with_tax']);
    $subTotalWithoutTax = trim($_POST['total_without_tax']);
    $netTotal = trim($_POST['grand_total']);
    $discountValue = trim($_POST['discount_given']);

    $sql = "INSERT INTO `invoices`(`invoice_no`, `created_at`, `is_active`, `invoice_to`, `discount_type`, `sub_total_tax`, `sub_total_without_tax`, `net_total`, `discount_value`) "
            . "VALUES ('{$invoiceNo}', now(), true,'{$invoiceTo}','{$discountOption}','{$subTotalTax}','{$subTotalWithoutTax}','{$netTotal}','{$discountValue}')";
    if ($obj->mysqli->exec($sql)) {
        $invoiceDataResponse = $obj->getInvoiceDetails($invoiceNo);
        if (!empty($invoiceDataResponse['data']['id'])) {
            $invoiceId = $invoiceDataResponse['data']['id'];

            //insert invoice items
            $queryParam = '';
            foreach ($_POST['item'] as $key => $item) {
                $queryParam .= " ('{$invoiceId}','{$item['name']}','{$item['quantity']}','{$item['unit-price']}','{$item['tax']}', true) ";
                if (count($_POST['item']) > $key) {
                    $queryParam .= ",";
                }
            }

            $sqlItem = "INSERT INTO `invoice_items`(`invoice_id`, `item_name`, `quantity`, `unit_price`, `tax`, `is_active`) "
                    . "VALUES $queryParam";
            if ($obj->mysqli->exec($sqlItem)) {
                $response = ['status' => 'success', 'message' => 'Generated the invoice', 'invoice_id' => $invoiceId];
            }
        }
    }
} else {
    $response = ['status' => 'failed', 'message' => $errors];
}

echo json_encode($response);
?>