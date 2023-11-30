<?php
include 'nav.php';
?>
<!DOCTYPE html>
<body>
    <div class="wrapper d-flex flex-column bg-light">
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                <div class="row">                   
                    <div class="col-sm-6 col-lg-4">
                        <?php
                        $query = "SELECT COUNT(*) as total_products FROM tbl_product";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $totalProducts = $row['total_products'];
                        } else {
                            $totalProducts = "N/A"; 
                        }
                        ?>
                        <div class="card mb-4 text-white bg-primary">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fs-4 fw-semibold "><?= $totalProducts ;?></div>
                                    </div>
                                    <div><span class="fs-100 fw-normal"><i class="bi bi-diagram-3"></i>
                                </span></div>
                            </div>
                            <div class="mx-2 mt-1 text-nowrap"><h3>Total Product</h3></div>
                            <div class="c-chart-wrapper mx-3" style="height:25px;">
                                <canvas class="chart" id="card-chart1" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-4">
                        <?php
                        $query = "SELECT COUNT(*) as total_customer FROM user_login_details";
                        $result = mysqli_query($conn, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $totalCustomer = $row['total_customer'];
                        } else {
                            $totalCustomer = "N/A"; 
                        }
                        ?>
                        <div class="card mb-4 text-white bg-primary">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fs-4 fw-semibold "><?= $totalCustomer ;?></div>
                                    </div>
                                    <div><span class="fs-100 fw-normal"><i class="bi bi-people"></i>
                                </span></div>
                            </div>
                            <div class="mx-2 mt-1 text-nowrap"><h3>Total Customer</h3></div>
                            <div class="c-chart-wrapper mx-3" style="height:25px;">
                                <canvas class="chart" id="card-chart1" height="70"></canvas>
                            </div>
                        </div>                        
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-4">
                        <?php
                            $query = "SELECT COUNT(*) as total_order FROM tbl_order_item";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $totalOrder = $row['total_order'];
                            } else {
                                $totalOrder = "N/A"; 
                            }
                        ?>
                        <div class="card mb-4 text-white bg-primary">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fs-4 fw-semibold "><?= $totalOrder ;?></div>
                                    </div>
                                    <div><span class="fs-100 fw-normal"><i class="bi bi-cart3"></i>
                                </span></div>
                            </div>
                            <div class="mx-2 mt-1 text-nowrap"><h3>Total Order</h3></div>
                            <div class="c-chart-wrapper mx-3" style="height:25px;">
                                <canvas class="chart" id="card-chart1" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-4">
                        <?php
                            $query = "SELECT COUNT(*) as total_order FROM return_product";
                            $result = mysqli_query($conn, $query);

                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $totalOrder = $row['total_order'];
                            } else {
                                $totalOrder = "N/A"; 
                            }
                        ?>
                        <div class="card mb-4 text-white bg-primary">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fs-4 fw-semibold "><?= $totalOrder ;?></div>
                                    </div>
                                    <div><span class="fs-100 fw-normal"><i class="bi bi-cart3"></i>
                                </span></div>
                            </div>
                            <div class="mx-2 mt-1 text-nowrap"><h3>Order Return</h3></div>
                            <div class="c-chart-wrapper mx-3" style="height:25px;">
                                <canvas class="chart" id="card-chart1" height="70"></canvas>
                            </div>
                        </div>                        
                    </div>
                    <!-- /.col-->
                </div>
                <!-- /.row-->
            </div>
        </div>
    </div>
</body>

</html>