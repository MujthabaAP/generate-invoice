/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $('#invoice-number').text(Date.now());
    
    var table = $('#example').DataTable({
        "searching": false,
        "paging": false,
        "info": false,
        columnDefs: [{
                orderable: false,
                targets: [0, 1, 2, 3, 4, 5, 6],
                "width": "20%"
            }]
    });
    var counter = 1;

    $('#addRow').on('click', function () {
        table.row.add([
            '<input type="text" class="form-control" id="item-name_' + counter + '" name="item[' + counter + '][name]" data-row-index="' + counter + '">',
            '<input type="number" class="form-control" id="item-quantity_' + counter + '" name="item[' + counter + '][quantity]" data-row-index="' + counter + '">',
            '<input type="text" class="form-control" id="item-unit-price_' + counter + '" name="item[' + counter + '][unit-price]" data-row-index="' + counter + '">',
            '<select size="1" class="custom-select-option" id="item-tax_' + counter + '" name="item[' + counter + '][tax]" data-row-index="' + counter + '"><option value="0" selected="selected">0%</option><option value="1">1%</option><option value="5">5%</option><option value="10">10%</option></select>',
            '<label id="line-total_' + counter + '" class="line-total">0</label>',
            //'<label id="line-sub-total-without-tax_' + counter + '">0</label>',
            '<label id="line-sub-total-with-tax_' + counter + '" class="line-total-with-tax">0</label>',
            '<i class="fa fa-trash-o remove-a-row" aria-hidden="true"></i>'
        ]).draw(false);

        counter++;

        //update values
        $("input").change(function () {
            computeDynamicValues(this);
        });

        $('select').on('change', function (e) {
            computeDynamicValues(this);
        });
    });

// Automatically add a first row of data
    $('#addRow').click();

//to remove selected row
    $('#example tbody').on('click', 'i.remove-a-row', function () {
        table.row($(this).parents('tr')).remove().draw();

        //update total
        calcAndUpdateTotal();
    });

//to submit
    $('#submitForm').click(function () {
        var formdata = table.$('input, select').serializeArray();
        //console.log(formdata);

        var discountGiven = parseFloat($('#discount-input').val());
        var sumWithoutTax = parseFloat($('#line-sub-total-with-tax').text());
        var sumWithTax = parseFloat($('#line-sub-total-with-tax').text());
        var selectedDiscountOpt = $('#select-discount-opt').find('option:selected');
        var DiscountOptVal = selectedDiscountOpt.val();
        var netAmount = parseFloat($('#net-total').text());
        var invoiceTo = $('textarea.custom-text-area').text();
        var invoiceNo = $('#invoice-number').text();

        formdata.push({name: 'discount_given', value: discountGiven},
                {name: 'selected_discount_opt', value: DiscountOptVal},
                {name: 'total_without_tax', value: sumWithoutTax},
                {name: 'total_with_tax', value: sumWithTax},
                {name: 'grand_total', value: netAmount},
                {name: 'invoice_to', value: invoiceTo},
                {name: 'invoice_no', value: invoiceNo});

        $.ajax({
            type: "POST",
            url: 'test.php',
            data: formdata,
            success: function (data)
            {
//                var result = JSON.parse(data);
                console.log(data);
            }
        });
    });

    function computeDynamicValues(obj) {
        //alert("The text has been changed.");
        //console.log('value :', $(obj).val());

//        console.log('index :', $(obj).attr("data-row-index"));
        var lineTotal = 0;
        var subTotalWithoutTax = 0;
        var subTotalWitTax = 0;
        var rowIndex = $(obj).attr("data-row-index");
        var itemQuantity = $('#item-quantity_' + rowIndex).val();
        //console.log('itemQuantity', itemQuantity);
        var itemUnitPrice = $('#item-unit-price_' + rowIndex).val();
//        console.log('itemUnitPrice', itemUnitPrice);
//            var itemTax = $('#item-tax_' + rowIndex).val();
        var itemTaxOpt = $('#item-tax_' + rowIndex).find('option:selected');
        var itemTax = itemTaxOpt.val();
//        console.log('itemTax', itemTax);

        if (typeof itemQuantity !== 'undefined' && typeof itemUnitPrice !== 'undefined') {
            lineTotal = itemQuantity * itemUnitPrice;
            subTotalWithoutTax = itemQuantity * itemUnitPrice;
//                subTotalWitTax
            if (itemTax != 0) {
                subTotalWitTax = lineTotal + ((lineTotal * itemTax) / 100);
            } else {
                subTotalWitTax = subTotalWithoutTax;
            }

            $("#line-total_" + rowIndex).text(lineTotal);
            //$("#line-sub-total-without-tax_" + rowIndex).text(subTotalWithoutTax);
            $("#line-sub-total-with-tax_" + rowIndex).text(subTotalWitTax);

            calcAndUpdateTotal();

            computeNetTotal();
        }
    }

    /*
     * Used to update Subtotal with tax & Subtotal without tax
     */
    function calcAndUpdateTotal() {
        //compute sub total without tax
        var sum = 0;
        $(".line-total").each(function () {
            sum += parseFloat($(this).text());
        });
        $('#line-sub-total-without-tax').text(sum);

        //compute sub total with tax
        var sumWithTax = 0;
        $(".line-total-with-tax").each(function () {
            sumWithTax += parseFloat($(this).text());
        });
        $('#line-sub-total-with-tax').text(sumWithTax);


    }

    //compute net amount when selecting discount option
    $('#select-discount-opt').on('change', function (e) {
        computeNetTotal();
    });
    //compute net amount when inputing discount value
    $("input").change(function () {
        computeNetTotal();
    });

    function computeNetTotal() {
        var discountGiven = parseFloat($('#discount-input').val());
        var sumWithTax = parseFloat($('#line-sub-total-with-tax').text());
        var selectedDiscountOpt = $('#select-discount-opt').find('option:selected');
        var DiscountOptVal = selectedDiscountOpt.val();
        var netAmount = 0;
//        console.log('itemTax', itemTax);
//        alert(DiscountOptVal);
        if (DiscountOptVal === 'AMOUNT') { //selected AMOUNT
            netAmount = sumWithTax - discountGiven;
        } else { //selected PERCENTAGE
            netAmount = (sumWithTax - ((sumWithTax * discountGiven) / 100));
        }
        $('#net-total').text(netAmount);
    }
}
);


//