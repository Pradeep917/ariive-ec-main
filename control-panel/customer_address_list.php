<?php 
include 'nav.php';
?>
<div class="wrapper d-flex flex-column bg-light">
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Customer Address List</h4>
                        </div>
                        <!-- <div>
                            <h4 class="card-title add-btn mb-0"><a href="color_list.php" class="bg-dark rounded-1 p-1"><i class="bi bi-arrow-90deg-left"></i> Back</a>
                            </h4>
                        </div> -->
                    </div>
                </div>
                <div class="card-footer" style="overflow-x: scroll; width:100%;">
                    <table class="table table-bordered">    
                    <?php
                                $count = 0;
                                $select_address = mysqli_query($conn, "SELECT * FROM customer_address ORDER BY customer_id DESC");
                                if (mysqli_num_rows($select_address) > 0) {
                                ?>                    
                        <thead>
                            <tr class="text-nowrap">
                            <th class="px-4" style="color: red; font-weight:bold;">Customer Id</th>
                            <th class="px-4">First Name</th>
                            <th class="px-4">Last Name</th>
                            <th class="px-4">Email</th>
                            <th class="px-4">Phone </th>
                            <th class="px-4">State</th>
                            <th class="px-4">City </th>
                            <th class="px-4">Landmark</th>
                            <th class="px-4">Address</th>
                            <th class="px-4">Pincode</th>
                            <th class="px-4">Message</th>
                            <th class="px-4">Time</th>
                            <!-- <th class="px-4">Action</th> -->
                            
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           
                                $counter = 1; // Initialize a counter for serial numbers
                                while ($select_address_row = mysqli_fetch_assoc($select_address)) {
                            ?>
                            <tr>
                                <td class="px-4" style="background:#3C4B64; font-weight:bold; color:white;"><?= $select_address_row['customer_id'] ?></td>
                                <td class="px-4"><?= $select_address_row['c_fname'] ?></td>
                                <td class="px-4"><?= $select_address_row['c_lname'] ?></td>
                                <td class="px-4"><?= $select_address_row['c_email'] ?></td>
                                <td class="px-4"><?= $select_address_row['c_phone'] ?></td>
                                <td class="px-4"><?= $select_address_row['c_state'] ?></td>                               
                                <td class="px-4"><?= $select_address_row['c_city'] ?></td>
                                <td class="px-4"><?= $select_address_row['c_landmark'] ?></td>
                                <td class="px-4"><?= $select_address_row['c_address'] ?></td>
                                <td class="px-4"><?= $select_address_row['c_pincode'] ?></td>
                                <td class="px-4"><?= $select_address_row['c_message'] ?></td>
                                <td class="px-4"><?= $select_address_row['created_at'] ?></td>
                                <!-- <td class="px-4"><a href="" class="view text-dark"><i class="bi bi-pen-fill"></i></a></td> -->
                            </tr> 
                            <?php
                                    $counter++; // Increment the counter for each row
                                }                          
                            ?>
                        </tbody>
                        <?php 
                         } else {
                            ?>
                                <tr class="product-status fw-bold">
                                    <td colspan="7">Details Not Found</td>
                                </tr>
                            <?php
                            }
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>