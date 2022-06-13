<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<style>
table, th, td {
  border: 1px solid black;
  padding: 5px;
  text-align: center;
}

table.center {
  margin-left: auto; 
  margin-right: auto;
}
</style>       
<section class="main-content-wrapper">
    <input type="button" id="create_pdf" value="Generate PDF">
        <form class="form">
            <h1 style="text-align: center;">Food Mohalla</h1>
            <h6 style="text-align: center;">India’s Most Cheesy Pizza Burger Brand</h6>
            <h6 style="text-align: center;">Shop No 3, Raj Empire Complex, Luncikui Road Navsari 396445</h6>
            <h6 style="text-align: center;">GST – 24CLPPS2375L2ZD</h6>
            <img src="<?php echo base_url(); ?>images/fmimage.png" style="display: block;margin-left: auto;margin-right: auto;height: 70px;width: 250px;">
            <h6 style="text-align: center;">Basic Monthly Royalty - <?php echo escape_output($table_information->royaltymonth) ?></h6>
            <h6>Name - <?php echo escape_output(getOutletNameById($table_information->storeid))?></h6>
            <h6>Address - <?php echo escape_output(getOutletAddressById($table_information->storeid))?></h6>
            <h6><b>Support of Franchise</b></h6>
            <ul>
                <?php 
                    $selected_modules =  explode(',',$table_information->item_check);
                    foreach ($selected_modules as $item){?>
                        <li><?=$item;?></li>
                <?php }
                ?>
            </ul>
            <h6><b>Franchise Royalty Calculations</b></h6>
            <ul>
                <li>Sell of the month <?php echo escape_output($table_information->royaltymonth) ?></li>
                <li>Here Sell amount calculated <?php echo escape_output($table_information->royaltymonth) ?></li>
            </ul>
            <table class="center">
                <tbody>
                    <tr>
                        <th>Monthly Sell</th>
                        <th>4% Royalty</th>
                        <th>18% GST on Royalty Amount</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td><?php echo escape_output($table_information->totalsale) ?></td>
                        <td><?php echo escape_output($table_information->royaltyamount) ?></td>
                        <td><?php echo escape_output(($table_information->royaltyamount)*18/100) ?></td>
                        <td><?php echo escape_output($table_information->gstroyaltyamount) ?></td>
                    </tr>
                </tbody>
            </table>
            <h6><b>Pay this amount within 2 days of receiving letter.</b></h6>
            <h6>Payment Mode - Cheque Or NEFT Or Money Transfer</h6>
            <h6>Bank Details – Food Mohalla PVT LTD</li>
            <h6>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;Kotak Mahindra Bank, 1115072017</h6>
            <h6>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;IFSC CODE – KKBK0003040</h6>
            <h6>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;BRANCH – NAVSARI</h6>
            
            <h6 style="text-align: right;margin-right: 10%;"><b>Regards</b></h6>
            <h6 style="text-align: right;margin-right: 10%;"><b>Management, FooD Mohalla</b></h6>
            <h6 style="text-align: right;margin-right: 10%;"><b>+91 93751 01090</b></h6>      
            <h6 style="text-align: right;margin-right: 10%;"><b>_______________</b></h6>      
        </form>

        
</section>
<script>
    (function () {
        var
         form = $('.form'),
         cache_width = form.width(),
         a4 = [595.28, 841.89]; // for a4 size paper width and height

        $('#create_pdf').on('click', function () {
            $('body').scrollTop(0);
            createPDF();
        });
        //create pdf
        function createPDF() {
            getCanvas().then(function (canvas) {
                var
                 img = canvas.toDataURL("image/png"),
                 doc = new jsPDF({
                     unit: 'px',
                     format: 'a4'
                 });
                doc.addImage(img, 'JPEG', 20, 20);
                doc.save('Food Mohalla Royalty Sheet.pdf');
                form.width(cache_width);
            });
        }

        // create canvas object
        function getCanvas() {
            form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
            return html2canvas(form, {
                imageTimeout: 2000,
                removeContainer: true
            });
        }

    }());
</script>
<script>
    (function ($) {
        $.fn.html2canvas = function (options) {
            var date = new Date(),
            $message = null,
            timeoutTimer = false,
            timer = date.getTime();
            html2canvas.logging = options && options.logging;
            html2canvas.Preload(this[0], $.extend({
                complete: function (images) {
                    var queue = html2canvas.Parse(this[0], images, options),
                    $canvas = $(html2canvas.Renderer(queue, options)),
                    finishTime = new Date();

                    $canvas.css({ position: 'absolute', left: 0, top: 0 }).appendTo(document.body);
                    $canvas.siblings().toggle();

                    $(window).click(function () {
                        if (!$canvas.is(':visible')) {
                            $canvas.toggle().siblings().toggle();
                            throwMessage("Canvas Render visible");
                        } else {
                            $canvas.siblings().toggle();
                            $canvas.toggle();
                            throwMessage("Canvas Render hidden");
                        }
                    });
                    throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);
                }
            }, options));

            function throwMessage(msg, duration) {
                window.clearTimeout(timeoutTimer);
                timeoutTimer = window.setTimeout(function () {
                    $message.fadeOut(function () {
                        $message.remove();
                    });
                }, duration || 2000);
                if ($message)
                    $message.remove();
                $message = $('<div ></div>').html(msg).css({
                    margin: 0,
                    padding: 10,
                    background: "#000",
                    opacity: 0.7,
                    position: "fixed",
                    top: 10,
                    right: 10,
                    fontFamily: 'Tahoma',
                    color: '#fff',
                    fontSize: 12,
                    borderRadius: 12,
                    width: 'auto',
                    height: 'auto',
                    textAlign: 'center',
                    textDecoration: 'none'
                }).hide().fadeIn().appendTo('body');
            }
        };
    })(jQuery);
</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>