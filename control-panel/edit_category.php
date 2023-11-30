<?php
include 'nav.php';
$category_id = $_GET['id'];
?>
<div class="wrapper d-flex flex-column bg-light">
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Update Category Name</h4>
                        </div>
                        <div>
                            <h4 class="card-title mb-0"><a href="category_list.php" class="bg-success rounded-1 p-1"><i class="bi bi-arrow-90deg-left">Back</i></a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <?php
                    $category = mysqli_query($conn, "SELECT * FROM `category` where cat_id='$category_id'");
                    if (mysqli_num_rows($category) > 0) {
                        while ($cat_row = mysqli_fetch_assoc($category)) {
                    ?>
                            <form action="save_category.php" method="post">
                                <div class="row">
                                    <input type="hidden" name="cat_id" value="<?= $cat_row['cat_id'] ?>">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Category Name</label>
                                            <input type="text" class="form-control" name="cat_name" value="<?= $cat_row['cat_name'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" name="cat_update" class="form-control btn btn-secondary mt-2 mb-2 fw-bold">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    <?php
                        }
                    } else {
                        echo "No Category FOund";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>