<?php
include 'nav.php';
$setting_id = $_GET['id'];
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
                            <h4 class="card-title mb-0"><a href="website_setttin.php" class="bg-success rounded-1 p-1"><i class="bi bi-arrow-90deg-left">Back</i></a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <?php
                    $category = mysqli_query($conn, "SELECT * FROM `web_setting` where setting_id='$setting_id'");
                    if (mysqli_num_rows($category) > 0) {
                        while ($setting_row = mysqli_fetch_assoc($category)) {
                    ?>
                            <form action="save_setting.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="setting_id" value="<?= $setting_row['setting_id'] ?>">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Company Logo</label><br>
                                            <img src="<?php echo $setting_row['web_logo']; ?>" alt="<?= $setting_row['web_logo'] ?>" class="company-logo img-fluid">
                                            <input type="hidden" name="exiting_image" value="<?= $setting_row['web_logo'] ?>">
                                            <input type="file" name="update_image">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <input type="text" class="form-control" name="title" value="<?= $setting_row['title'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" value="<?= $setting_row['meta_title'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Meta Description</label>
                                            <input type="text" class="form-control" name="meta_description" value="<?= $setting_row['meta_description'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Copyright</label>
                                            <input type="text" class="form-control" name="copyright" value="<?= $setting_row['copyright'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" name="setting_update" class="form-control btn btn-secondary mt-2 mb-2 fw-bold">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="card text-center fw-bold">
                            <?php echo "Details Not Found"; ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>