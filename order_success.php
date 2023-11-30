

<!DOCTYPE html>

<html lang="zxx">



</html>



<head>

    <meta charset="UTF-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <meta name="robots" content="index, follow" />

    <?php include 'header.php'; ?>

    <?php

    $select_query = mysqli_query($conn, "SELECT * FROM web_setting");

    while ($select_query_row = mysqli_fetch_assoc($select_query)) {

    ?>

        <title><?= $select_query_row['title'] ?></title>

        <link rel="shortcut icon" href="./control-panel/<?= $select_query_row['web_logo'] ?>" type="image/x-icon">

        <meta name="Title" content="<?= $select_query_row['meta_title'] ?>" />

        <meta name="Description" content="<?= $select_query_row['meta_description'] ?>" />

    <?php } ?>

</head>

<?php include 'navbar.php'; ?>

<style>

    #success-checkmark {

        margin-left: 50%;

        margin-top: 15%;

        transform: translate(-50%, -50%);

        animation: zoomIn 0.5s ease-in-out 1;

    }



    @keyframes zoomIn {

        0% {

            transform: translate(-50%, -50%) scale(0);

        }



        100% {

            transform: translate(-50%, -50%) scale(1);

        }

    }

</style>



<body>

    <div class="section-title text-center m-0">

        <div id="success-checkmark" class="d-none">

            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 48 48" fill="#4CAF50">

                <path d="M24 44c-11.046 0-20-8.954-20-20s8.954-20 20-20 20 8.954 20 20-8.954 20-20 20zm0-46C11.85 2 2 11.85 2 24s9.85 22 22 22 22-9.85 22-22S36.15 2 24 2zm-4 33l-8-8 3-3 5 5 12-12 3 3-15 15z" />

            </svg>

        </div>

        <script>

            document.getElementById('success-checkmark').classList.remove('d-none');

        </script>

    </div>

    <div class="product-area ">

        <div class="container mb-2">

            <div class="row">

                <div class="col">

                    <div class="row text-center">

                        <?php

                        $select_order = mysqli_query($conn, "SELECT o.product_size, o.product_qty, o.product_price, o.user_id, o.order_status,

                        o.payment_method, o.tracking_id, p.product_name, i.image_path, o.created_at

                        FROM tbl_order_item o

                        JOIN tbl_product p ON o.product_id = p.prod_id

                        JOIN tbl_image i ON o.product_id = i.product_id

                        WHERE user_id = $user_id

                        ORDER BY o.created_at DESC

                        LIMIT 1;");



                        if (mysqli_num_rows($select_order) > 0) {

                        ?>

                            <div class="col-sm-12 mb-5">

                                <table class="table">

                                    <thead>

                                        <tr>

                                            <th scope="col">Image</th>

                                            <th scope="col">Product Name</th>

                                            <th scope="col">Size</th>

                                            <th scope="col">Quantity</th>

                                            <th scope="col">Price</th>

                                            <th scope="col">Tracking Id</th>

                                            <th scope="col">Date</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php

                                        $select_order_row = mysqli_fetch_assoc($select_order); {

                                            $price=$select_order_row['product_price'];

                                            $cart_price=number_format($price,2);

                                        ?>

                                            <tr>

                                                <td><img src="./control-panel/<?= $select_order_row['image_path'] ?>" alt="" class="card-img-top rounded-2" height="50px" width="40px"></td>

                                                <td><?= $select_order_row['product_name'] ?></td>

                                                <td><?= $select_order_row['product_size'] ?></td>

                                                <td><?= $select_order_row['product_qty'] ?></td>

                                                <td>₹ <?= $cart_price ?></td>

                                                <td><?= $select_order_row['tracking_id'] ?></td>

                                                <td><?= $select_order_row['created_at'] ?></td>

                                            </tr>

                                        <?php } ?>

                                    </tbody>

                                </table>

                                <a href="index.php" class="bg-gray px-5 p-3 text-bg-dark rounded-1">Go To Home <i class="fa fa-house"></i></a>

                            </div>

                        <?php

                        } else {

                        ?>

                            <div class="col-md-12 text-center">

                                <div class="card text-center fw-bold">

                                    <?php echo "<p>No orders found.</p>"; ?>

                                </div>

                            </div>

                        <?php

                        }

                        ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php

    include 'footer.php';

    ?>

</body>

</html>