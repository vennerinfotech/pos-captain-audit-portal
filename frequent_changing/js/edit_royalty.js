let base_url_ = $("#base_url_").val();

function changeDate(){
    let outid = $('#outlet').val();
    let roymonth = $('#months').val();
    var values = roymonth.split("-");
    $.ajax({
        type: "get",
        url: base_url_+'Royalty/outletsalesamount',
        data: {
            id: outid,
            year: values[0],
            month: values[1]
        },
        dataType: "json",
        success: function(saleamt) {
            //amount = saleamt[0].paid_amount-saleamt[0].vat-saleamt[0].delivery_charge_actual_charge;
			amount = saleamt[0].paid_amount-(saleamt[0].vat * 0)-(saleamt[0].delivery_charge_actual_charge * 0);
            decamount = amount.toFixed(2)
            $('#saleamount').val(decamount);
            $.ajax({
                type: "get",
                url: base_url_+'Royalty/getfoodmenuid',
                data: {
                    id: outid,
                    year: values[0],
                    month: values[1]
                },
                dataType: "json",
                success: function(bevamt) {
                    amt = ((decamount-bevamt.ids)*4)/100;
                    amtgst = ((amt*18)/100)+amt;
                    $('#royaltyamount').val(amt.toFixed(0));
                    $('#gstroyaltyamount').val(amtgst.toFixed(0));
                }
            });
        }
    });
}

$('#months').on('change', changeDate);
$('#outlet').on('change', changeDate);
$(document).ready(changeDate);

