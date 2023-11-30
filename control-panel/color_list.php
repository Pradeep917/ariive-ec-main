<body>
<?php 
    include 'nav.php';    
    $data="select * from `tbl_color` ORDER BY `color_id` ASC";
    $result = mysqli_query($conn,$data);    
?>
<div class="wrapper flex-column bg-light">
    <div class="body">
        <div class="container">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between header-btn">                        
                        <h4 class="card-title mb-0">Product Color List</h4>
                        <h4 class="card-title add-btn mb-0"><a href="add_color.php" class="">Add Color</a><i class="bi bi-plus"></i></h4>                        
                    </div>
                </div>
                <div class="card-footer">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Color Name</th>                                              
                                <th>Edit</th>                                
                                <th>Delete</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (mysqli_num_rows($result) > 0) {
                                $counter = 1; 
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $hexColorCode=$row['color_name'];
                                    // echo $hexColorCode;
                            ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td class="d-flex">
                                        <div class="text-nowrap rounded-5 p-3 mx-3" style="width: 15px; height: 15px; background-color:<?= $hexColorCode?>"></div><div><?php echo $row['color_name']; ?></div>
                                    </td>                                                                   
                                    <td><a href="edit_color.php?id=<?= $row['color_id']?>" class="text-dark"><i class="bi bi-pen-fill"></i></a></td>                                    
                                    <td><a href="save_color.php?id=<?= $row['color_id']?>" class="text-dark"><i class="bi bi-trash-fill"></i></a></td>
                                </tr>
                            <?php
                                    $counter++; // Increment the counter for each row
                                }
                            } else {
                            ?>
                                <tr class="product-status fw-bold">
                                    <td colspan="5" >No Color Found</td>
                                </tr>
                            <?php 
                            }
                            ?>    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>