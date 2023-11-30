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
                            <h4 class="card-title mb-0">Update Color</h4>
                        </div>
                        <div>
                            <h4 class="card-title add-btn mb-0"><a href="color_list.php" class="bg-dark rounded-1 p-1"><i class="bi bi-arrow-90deg-left"></i> Back</a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <?php
                    $color_id = $_GET['id'];
                    $select_color = mysqli_query($conn, "SELECT * FROM `tbl_color` where color_id='$color_id'");
                    if (mysqli_num_rows($select_color) > 0) {
                        while ($color_row = mysqli_fetch_assoc($select_color)) {
                    ?>
                            <form action="save_color.php" method="post">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Color Code / Name </label>
                                            <input type="hidden" name="color_id" value="<?= $color_row['color_id'] ?>">
                                            <input type="color" class="form-control" value="<?= $color_row['color_name'] ?>" name="color_name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" name="update_color" class="form-control btn btn-secondary mt-2 mb-2 fw-bold">Update Color</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="card">
                            <?php echo "No Color Found"; ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>