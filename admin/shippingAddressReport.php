<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

    include "../connection.php";
    $odrId = $_GET['odrId'];
    $invoice_id = $_GET['invoice_id'];
    $e = $_GET['e'];

?>
<!DOCTYPE html>
<html lang="en">
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neo Mobile || Invoice</title>

    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap.css">
    <script>
        function printInvoice() {

            document.addEventListener('DOMContentLoaded', function() {
                function generateQRCode(text) {
                    document.getElementById('qrcodeContainer').innerHTML = '';

                    var qrCode = new QRCode(document.getElementById('qrcodeContainer'), {
                        width: 100,
                        height: 100
                    });

                    qrCode.makeCode(text);

                    window.print();
                }
                var textToEncode = document.getElementById('odrId').innerHTML;

                if (textToEncode) {
                    generateQRCode(textToEncode);
                } else {
                    alert('Please enter text to generate QR code.');
                }

            });

        }
        printInvoice();
    </script>
</head>

<body>
    <div class="container p-2">
        <div class="row">

            <div class="invoice-header">
                <h1 class="text-center">Neo Mobile</h1>
                <h1>Invoice</h1>
                <div class="d-flex justify-content-between">
                    <p>
                        212/2 Raja Veediya, <br>
                        Kandy <br>
                        <?php
                            $d = new DateTime();
                            $date = $d->format('y-M-d');
                            echo ($date);
                        ?> <br>
                        To : <?php echo ($e); ?>
                    </p>
                    <div>
                        <p>
                            Reference : <span id="odrId"><?php echo ($invoice_id); ?></span>
                        </p>
                        <div class="col-1 d-flex gap-3">
                            <img src="resource/logo.webp" alt="logo" style="width: 100px;">
                            <div id="qrcodeContainer"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">

                    <table class="table border border-1 border-black">
                        <thead>
                            <tr class="border border-3 border-black text-center">
                                <th scope="col">Product Id</th>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Color</th>
                                <th scope="col">Price</th>
                                <th scope="col">Purched Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $items = Database::search("SELECT * FROM `order` WHERE `user_email` = '" . $e . "' AND `invoice_id` = '". $invoice_id ."' AND `order_status_id` != '4' ");
                            $item_num = $items->num_rows;
                            for ($i = 0; $i < $item_num; $i++) {
                                $item_data = $items->fetch_assoc();
                            ?>
                                <tr class="border border-3 border-black">
                                    <td><?php echo ($item_data['product_id']); ?></td>
                                    <?php
                                                                            
                                    $product        = Database::search("SELECT * FROM `product` WHERE `id` = '" . $item_data['product_id'] . "' ");
                                    $product_data   = $product->fetch_assoc();

                                    $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $product_data['brand_id'] . "' ");
                                    $brand_name = $brand->fetch_assoc();

                                    $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product_data['model_id'] . "' ");
                                    $model_name = $model->fetch_assoc();

                                    ?>
                                    <td><?php echo $brand_name['brand'] . ' ' . $model_name['model'] ?></td>
                                    <td><?php echo ($item_data['qty']); ?></td>
                                    <?php
                                    $pColor = Database::search("SELECT * FROM `color` WHERE `id` = '" . $item_data['color_id'] . "' ");
                                    $clr_n = $pColor->num_rows;
                                    if ($clr_n > 0) {
                                        $clr_data = $pColor->fetch_assoc();
                                    ?>
                                        <td><?php echo ($clr_data['color']); ?></td>
                                    <?php
                                    }
                                    ?>
                                    <td><?php echo ($item_data['price']); ?></td>
                                    <td><?php echo ($item_data['date']); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>

                <div class="mt-4 d-flex justify-content-between">

                    <div>
                        <p class="invoice-footer">
                            <label class="fw-bold">Shipping Address</label> <br>
                            <?php
                               
                                $address = Database::search("SELECT * FROM `address` WHERE `user_email` = '" . $e . "' AND `id` = '". $item_data['address_id'] ."' ");

                                $num = $address->num_rows;

                                if ($num > 0) {
                                        $address_data = $address->fetch_assoc();

                                        $district = Database::search("SELECT * FROM `district` WHERE `id` = '" . $address_data['district_id'] . "' ");
                                        $district_data = $district->fetch_assoc();

                                        $province = Database::search("SELECT * FROM `province` WHERE `id` = '" . $district_data['province_id'] . "' ");
                                        $province_data = $province->fetch_assoc();
                                ?>
                                    <span><?php echo($address_data['line_1']); ?></span> <br>
                                    <span><?php echo($address_data['line_2']); ?></span> <br>
                                    <span>District : <?php echo($district_data['district']); ?></span>, <br>
                                    <span>Province : <?php echo($province_data['province']); ?></span>
                                <?php
                                    } else {
                                        ?>
                                        <script>
                                            alert('Please set a shipping address.');
                                            window.location = 'pendingOrders.php';
                                        </script>
                                        <?php
                                    }
                                ?>
                        </p>
                    </div>

                    <div>
                        <p class="invoice-footer">
                            <span class="fw-bold">Shipping : </span> Rs 5 000 <br>
                            <span class="fw-bold">Item Amount : </span> Rs <?php echo ($item_data['price']); ?> <br>
                            <span class="fw-bold">Total Amount : </span> Rs <?php echo ($item_data['price'] + 5000); ?>
                        </p>

                    </div>


                </div>

            </div>
        </div>

        <script src="script.js"></script>
</body>

</html>