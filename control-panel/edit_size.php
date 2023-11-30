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
                            <h4 class="card-title mb-0">Update Size</h4>
                        </div>
                        <div>
                            <h4 class="card-title add-btn mb-0"><a href="size_list.php" class="bg-dark rounded-1 p-1"><i class="bi bi-arrow-90deg-left"></i> Back</a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <?php
                    $size_id = $_GET['id'];
                    $select_size = mysqli_query($conn, "SELECT * FROM `tbl_size` where size_id='$size_id'");
                    if (mysqli_num_rows($select_size) > 0) {
                        while ($size_row = mysqli_fetch_assoc($select_size)) {
                    ?>
                            <form action="save_size.php" method="post">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Size Name</label>
                                            <input type="hidden" name="size_id" value="<?= $size_row['size_id'] ?>">
                                            <select name="size_name" class="form-select">
                                                <option value="S" <?php if ($size_row['size_name'] == 'S') {
                                                                        echo 'selected';
                                                                    } ?>>S</option>
                                                <option value="M" <?php if ($size_row['size_name'] == 'M') {
                                                                        echo 'selected';
                                                                    } ?>>M</option>
                                                <option value="L" <?php if ($size_row['size_name'] == 'L') {
                                                                        echo 'selected';
                                                                    } ?>>L</option>
                                                <option value="XL" <?php if ($size_row['size_name'] == 'XL') {
                                                                        echo 'selected';
                                                                    } ?>>XL</option>
                                                <option value="XXL" <?php if ($size_row['size_name'] == 'XXL') {
                                                                        echo 'selected';
                                                                    } ?>>XXL</option>
                                                <option value="XXX" <?php if ($size_row['size_name'] == 'XXX') {
                                                                        echo 'selected';
                                                                    } ?>>XXX</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" name="update_size" class="form-control btn btn-secondary mt-2 mb-2 fw-bold">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="card">
                            <?php echo "No Size Found"; ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>