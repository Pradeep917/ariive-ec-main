<?php
include './control-panel/config.php';
if ($conn) {
    // $category_id = $_POST['category_id'];
    $selectedPrice = $_POST['price'];
    $id = $_POST['id'];
    $flag = $_POST['flag'];    
    if ($flag == 1) {
        $query = "SELECT p.`prod_id`, p.`category_id`, p.`product_name`, p.`product_code`, p.`product_color`, p.`product_price`,
        p.`product_discount`, p.`product_desc`, p.`gender`, p.`created_at`, i.`img_id`, i.`image_path`, c.`cat_id`, c.`cat_name`
        FROM `tbl_product` p JOIN `category` c ON p.`category_id` = c.`cat_id` JOIN `tbl_image` i ON p.`prod_id` = i.`product_id`
        WHERE c.`cat_id` = '$id';";
        $result = mysqli_query($conn, $query);
        $displayedProducts = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row_sort = mysqli_fetch_assoc($result)) {
                $product_id = $row_sort['prod_id'];

                // Check if the product has already been displayed
                if (!in_array($product_id, $displayedProducts)) {
                    $displayedProducts[] = $product_id;

                    $product_name = $row_sort['product_name'];
                    $product_name_slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $product_name);

                    echo '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="400">';
                    echo '<div class="product">';
                    echo '<div class="thumb">';
                    echo '<a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '" class="image">';
                    echo '<img src="./control-panel/' . $row_sort['image_path'] . '" alt="' . $row_sort['image_path'] . '" />';
                    echo '<img class="hover-image" src="./control-panel/' . $row_sort['image_path'] . '" alt="' . $row_sort['image_path'] . '" />';
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h5 class="title"><a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '">' . $product_name . '</a></h5>';
                    echo '<span class="price">';
                    echo '<span class="new">&#8377;' . $row_sort['product_price'] . '</span>';
                    echo '<span class="old">&#8377;' . $row_sort['product_discount'] . '</span>';
                    echo '</span>';
                    echo '</div>';
                    echo '<button title="View Product" class="add-to-cart btn btn-primary" style="background-color:skyblue;">View Product</button>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            ?>
                <div class="card p-5 align-items-center fw-bold" style="font-size: xxx-large;">
                    <?php echo 'No products found !'; ?>
                </div>
            <?php
        }
    } elseif ($flag == 2) {
        $query_size = "SELECT
                p.`prod_id`,
                p.`category_id`,
                p.`product_name`,
                p.`product_code`,
                p.`product_color`,
                p.`product_price`,
                p.`product_discount`,
                p.`product_desc`,
                p.`gender`,
                p.`created_at`,
                i.`img_id`,
                i.`image_path`,
                s.`sizeqty_id`,
                s.`size_id`,
                s.`quantity`
            FROM
                `tbl_product` p
            JOIN
                `product_size_quantity` s ON p.`prod_id` = s.`product_id`
            JOIN
                (
                    SELECT `product_id`, MAX(`img_id`) AS `max_img_id`
                    FROM `tbl_image`
                    GROUP BY `product_id`
                ) max_images ON p.`prod_id` = max_images.`product_id`
            JOIN
                `tbl_image` i ON p.`prod_id` = i.`product_id` AND i.`img_id` = max_images.`max_img_id`
            WHERE
                s.`size_id` = '$id'";

        $result = mysqli_query($conn, $query_size);

        if (mysqli_num_rows($result) > 0) {
            while ($row_price = mysqli_fetch_assoc($result)) {
                $product_name = $row_price['product_name'];
                $product_name_slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $product_name);
                echo '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="400">';
                echo '<div class="product">';
                echo '<div class="thumb">';
                echo '<a href="product-details.php?id=' . $row_price['prod_id'] . '&amp;' . $product_name_slug . '" class="image">';
                echo '<img src="./control-panel/' . $row_price['image_path'] . '" alt="' . $row_price['image_path'] . '" />';
                echo '<img class="hover-image" src="./control-panel/' . $row_price['image_path'] . '" alt="' . $row_price['image_path'] . '" />';
                echo '</a>';
                echo '</div>';
                echo '<div class="content">';
                echo '<h5 class="title"><a href="product-details.php?id=' . $row_price['prod_id'] . '&amp;' . $product_name_slug . '">' . $product_name . '</a></h5>';
                echo '<span class="price">';
                echo '<span class="new">&#8377;' . $row_price['product_price'] . '</span>';
                echo '<span class="old">&#8377;' . $row_price['product_discount'] . '</span>';
                echo '</span>';
                echo '</div>';
                echo '<button title="View Product" class="add-to-cart btn btn-primary" style="background-color:skyblue;">View Product</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            ?>
                <div class="card p-5 align-items-center fw-bold" style="font-size: xxx-large;">
                    <?php echo 'No products found ! !'; ?>
                </div>
            <?php
        }
    } elseif ($flag == 3) {
        $query_price = "SELECT
        p.`prod_id`,
        p.`category_id`,
        p.`product_name`,
        p.`product_code`,
        p.`product_color`,
        p.`product_price`,
        p.`product_discount`,
        p.`product_desc`,
        p.`gender`,
        p.`created_at`,
        i.`img_id`,
        i.`image_path`,
        s.`sizeqty_id`,
        s.`size_id`,
        s.`quantity`
        FROM
            `tbl_product` p
        JOIN
            `product_size_quantity` s ON p.`prod_id` = s.`product_id`
        JOIN
            (
                SELECT `product_id`, MAX(`img_id`) AS `max_img_id`
                FROM `tbl_image`
                GROUP BY `product_id`
            ) max_images ON p.`prod_id` = max_images.`product_id`
        JOIN
            `tbl_image` i ON p.`prod_id` = i.`product_id` AND i.`img_id` = max_images.`max_img_id`
        WHERE
        p.`product_price` <= '$selectedPrice'";
        $result = mysqli_query($conn, $query_price);
        // Create an array to keep track of displayed product IDs
        $displayedProducts = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row_price = mysqli_fetch_assoc($result)) {
                $product_id = $row_price['prod_id'];

                // Check if the product has already been displayed
                if (!in_array($product_id, $displayedProducts)) {
                    $displayedProducts[] = $product_id;

                    $product_name = $row_price['product_name'];
                    $product_name_slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $product_name);

                    echo '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="400">';
                    echo '<div class="product">';
                    echo '<div class="thumb">';
                    echo '<a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '" class="image">';
                    echo '<img src="./control-panel/' . $row_price['image_path'] . '" alt="' . $row_price['image_path'] . '" />';
                    echo '<img class="hover-image" src="./control-panel/' . $row_price['image_path'] . '" alt="' . $row_price['image_path'] . '" />';
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h5 class="title"><a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '">' . $product_name . '</a></h5>';
                    echo '<span class="price">';
                    echo '<span class="new">&#8377;' . $row_price['product_price'] . '</span>';
                    echo '<span class="old">&#8377;' . $row_price['product_discount'] . '</span>';
                    echo '</span>';
                    echo '</div>';
                    echo '<button title="View Product" class="add-to-cart btn btn-primary" style="background-color:skyblue;">View Product</button>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            ?>
                <div class="card p-5 align-items-center fw-bold" style="font-size: xxx-large;">
                    <?php echo 'No products found !'; ?>
                </div>
            <?php
        }
    } elseif ($flag == 4) {
        $query_sort = "SELECT
        p.`prod_id`,
        p.`category_id`,
        p.`product_name`,
        p.`product_code`,
        p.`product_color`,
        p.`product_price`,
        p.`product_discount`,
        p.`product_desc`,
        p.`gender`,
        p.`created_at`,
        i.`img_id`,
        i.`image_path`,
        s.`sizeqty_id`,
        s.`size_id`,
        s.`quantity`
        FROM
            `tbl_product` p
        JOIN
            `product_size_quantity` s ON p.`prod_id` = s.`product_id`
        JOIN
            (
                SELECT `product_id`, MAX(`img_id`) AS `max_img_id`
                FROM `tbl_image`
                GROUP BY `product_id`
            ) max_images ON p.`prod_id` = max_images.`product_id`
        JOIN
            `tbl_image` i ON p.`prod_id` = i.`product_id` AND i.`img_id` = max_images.`max_img_id`
        WHERE 1=1"; // We add "WHERE 1=1" to allow for easier appending of conditions

        // Depending on the selected sort option, add the appropriate ORDER BY clause
        if ($id == 1) {
            // Price, low to high
            $query_sort .= " ORDER BY p.`product_price` ASC";
        } elseif ($id == 2) {
            // Price, high to low
            $query_sort .= " ORDER BY p.`product_price` DESC";
        }
        $result = mysqli_query($conn, $query_sort);
        // Create an array to keep track of displayed product IDs
        $displayedProducts = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row_sort = mysqli_fetch_assoc($result)) {
                $product_id = $row_sort['prod_id'];

                // Check if the product has already been displayed
                if (!in_array($product_id, $displayedProducts)) {
                    $displayedProducts[] = $product_id;

                    $product_name = $row_sort['product_name'];
                    $product_name_slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $product_name);

                    echo '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="400">';
                    echo '<div class="product">';
                    echo '<div class="thumb">';
                    echo '<a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '" class="image">';
                    echo '<img src="./control-panel/' . $row_sort['image_path'] . '" alt="' . $row_sort['image_path'] . '" />';
                    echo '<img class="hover-image" src="./control-panel/' . $row_sort['image_path'] . '" alt="' . $row_sort['image_path'] . '" />';
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h5 class="title"><a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '">' . $product_name . '</a></h5>';
                    echo '<span class="price">';
                    echo '<span class="new">&#8377;' . $row_sort['product_price'] . '</span>';
                    echo '<span class="old">&#8377;' . $row_sort['product_discount'] . '</span>';
                    echo '</span>';
                    echo '</div>';
                    echo '<button title="View Product" class="add-to-cart btn btn-primary" style="background-color:skyblue;">View Product</button>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            ?>
                <div class="card p-5 align-items-center fw-bold" style="font-size: xxx-large;">
                    <?php echo 'No products found !'; ?>
                </div>
            <?php
        }
    }elseif ($flag == 5) {

        if ($id == 1) {
            $genderCondition = "Male";
        } elseif ($id == 2) {
            $genderCondition = "Female";
        } elseif ($id == 3) {
            $genderCondition = "Unisex";
        } else {
            $genderCondition = "Some Default Value";
        }
        
        $query_gender = "SELECT 
            p.`prod_id`, 
            p.`category_id`, 
            p.`product_name`, 
            p.`product_code`, 
            p.`product_color`, 
            p.`product_price`, 
            p.`product_discount`, 
            p.`product_desc`, 
            p.`gender`, 
            c.`cat_name` AS `category_name`,
            i.`image_path`,
            psq.`size_id`,
            psq.`quantity`
        FROM 
            `tbl_product` p
        LEFT JOIN 
            `category` c ON p.`category_id` = c.`cat_id`
        LEFT JOIN 
            `tbl_image` i ON p.`prod_id` = i.`product_id`
        LEFT JOIN 
            `product_size_quantity` psq ON p.`prod_id` = psq.`product_id`
        WHERE 
            p.`gender` = '$genderCondition'";
        
        $result = mysqli_query($conn, $query_gender);
        $displayedProducts = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row_sort = mysqli_fetch_assoc($result)) {
                $product_id = $row_sort['prod_id'];

                // Check if the product has already been displayed
                if (!in_array($product_id, $displayedProducts)) {
                    $displayedProducts[] = $product_id;

                    $product_name = $row_sort['product_name'];
                    $product_name_slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $product_name);

                    echo '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="400">';
                    echo '<div class="product">';
                    echo '<div class="thumb">';
                    echo '<a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '" class="image">';
                    echo '<img src="./control-panel/' . $row_sort['image_path'] . '" alt="' . $row_sort['image_path'] . '" />';
                    echo '<img class="hover-image" src="./control-panel/' . $row_sort['image_path'] . '" alt="' . $row_sort['image_path'] . '" />';
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h5 class="title"><a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '">' . $product_name . '</a></h5>';
                    echo '<span class="price">';
                    echo '<span class="new">&#8377;' . $row_sort['product_price'] . '</span>';
                    echo '<span class="old">&#8377;' . $row_sort['product_discount'] . '</span>';
                    echo '</span>';
                    echo '</div>';
                    echo '<button title="View Product" class="add-to-cart btn btn-primary" style="background-color:skyblue;">View Product</button>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
            ?>
                <div class="card p-5 align-items-center fw-bold" style="font-size: xxx-large;">
                    <?php echo 'No products found !'; ?>
                </div>
            <?php
        }
    }elseif ($flag == 6) {
         $query_color = "SELECT
                p.`prod_id`,
                p.`category_id`,
                p.`product_name`,
                p.`product_code`,
                p.`product_color`,
                p.`product_price`,
                p.`product_discount`,
                p.`product_desc`,
                p.`gender`,
                p.`created_at`,
                i.`img_id`,
                i.`image_path`,
                s.`sizeqty_id`,
                s.`size_id`,
                s.`quantity`
            FROM
                `tbl_product` p
            JOIN
                `product_size_quantity` s ON p.`prod_id` = s.`product_id`
            JOIN
                (
                    SELECT `product_id`, MAX(`img_id`) AS `max_img_id`
                    FROM `tbl_image`
                    GROUP BY `product_id`
                ) max_images ON p.`prod_id` = max_images.`product_id`
            JOIN
                `tbl_image` i ON p.`prod_id` = i.`product_id` AND i.`img_id` = max_images.`max_img_id`
            WHERE
                p.`product_color` = '$id'";


            $result = mysqli_query($conn, $query_color);
            $displayedProducts = array();

        if (mysqli_num_rows($result) > 0) {
            while ($row_color = mysqli_fetch_assoc($result)) {
                $product_id = $row_color['prod_id'];

                // Check if the product has already been displayed
                if (!in_array($product_id, $displayedProducts)) {
                    $displayedProducts[] = $product_id;

                    $product_name = $row_color['product_name'];
                    $product_name_slug = preg_replace('/[^a-zA-Z0-9]+/', '-', $product_name);

                    echo '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="400">';
                    echo '<div class="product">';
                    echo '<div class="thumb">';
                    echo '<a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '" class="image">';
                    echo '<img src="./control-panel/' .$row_color['image_path'] . '" alt="' . $row_color['image_path'] . '" />';
                    echo '<img class="hover-image" src="./control-panel/' . $row_color['image_path'] . '" alt="' . $row_color['image_path'] . '" />';
                    echo '</a>';
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<h5 class="title"><a href="product-details.php?id=' . $product_id . '&amp;' . $product_name_slug . '">' . $product_name . '</a></h5>';
                    echo '<span class="price">';
                    echo '<span class="new">&#8377;' . $row_color['product_price'] . '</span>';
                    echo '<span class="old">&#8377;' . $row_color['product_discount'] . '</span>';
                    echo '</span>';
                    echo '</div>';
                    echo '<button title="View Product" class="add-to-cart btn btn-primary" style="background-color:skyblue;">View Product</button>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        } else {
           ?>
                <div class="card p-5 align-items-center fw-bold" style="font-size: xxx-large;">
                    <?php echo 'No products found !'; ?>
                </div>
            <?php
        }
    } 
} else {
    echo 'Server connection error';
}
