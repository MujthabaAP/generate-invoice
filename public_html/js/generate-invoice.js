/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    var table = $('#example').DataTable({
        columnDefs: [{
                orderable: false,
                targets: [1, 2, 3, 4, 5, 6, 7]
            }]
    });
    var counter = 1;

    $('#addRow').on('click', function () {
        table.row.add([
            '<input type="text" id="item-name_' + counter + '" name="item-name[]" data-row-index="' + counter + '">',
            '<input type="number" id="item-quantity_' + counter + '" name="item-quantity[]" data-row-index="' + counter + '">',
            '<input type="text" id="item-unit-price_' + counter + '" name="item-unit-price[]" data-row-index="' + counter + '">',
            '<select size="1" id="item-tax_' + counter + '" name="item-tax[]" data-row-index="' + counter + '"><option value="0" selected="selected">0%</option><option value="1">1%</option><option value="5">5%</option><option value="10">10%</option></select>',
            '<label id="line-total_' + counter + '">0</label>',
            '<label id="line-sub-total-without-tax_' + counter + '">0</label>',
            '<label id="line-sub-total-with-tax_' + counter + '">0</label>',
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
    });

    //to submit
    $('#submitForm').click(function () {
        var data = table.$('input, select').serialize();
        console.log(data);
//        alert(
//                "The following data would have been submitted to the server: \n\n" +
//                data.substr(0, 120) + '...'
//                );
        $.post('test.php', data, function (data, status) {
            console.log(data);
        });
        return false;
    });

    function computeDynamicValues(obj) {
        alert("The text has been changed.");
        console.log('value :', $(obj).val());

        console.log('index :', $(obj).attr("data-row-index"));
        var lineTotal = 0;
        var subTotalWithoutTax = 0;
        var subTotalWitTax = 0;
        var rowIndex = $(obj).attr("data-row-index");
        var itemQuantity = $('#item-quantity_' + rowIndex).val();
        console.log('itemQuantity', itemQuantity);
        var itemUnitPrice = $('#item-unit-price_' + rowIndex).val();
        console.log('itemUnitPrice', itemUnitPrice);
//            var itemTax = $('#item-tax_' + rowIndex).val();
        var itemTaxOpt = $('#item-tax_' + rowIndex).find('option:selected');
        var itemTax = itemTaxOpt.val();
        console.log('itemTax', itemTax);

        if (typeof itemQuantity !== 'undefined' && typeof itemUnitPrice !== 'undefined') {
            lineTotal = itemQuantity * itemUnitPrice;
            subTotalWithoutTax = itemQuantity * itemUnitPrice;
//                subTotalWitTax
            if (itemTax != 0) {
                subTotalWitTax = lineTotal + ((lineTotal * itemTax) / 100);
            }

            $("#line-total_" + rowIndex).text(lineTotal);
            $("#line-sub-total-without-tax_" + rowIndex).text(subTotalWithoutTax);
            $("#line-sub-total-with-tax_" + rowIndex).text(subTotalWitTax);
        }
    }

});