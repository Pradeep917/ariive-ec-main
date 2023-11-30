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
                            <h4 class="card-title mb-0">Add New Size</h4>
                        </div>
                        <div>
                            <h4 class="card-title add-btn mb-0"><a href="size_list.php" class="bg-dark rounded-1 p-1"><i class="bi bi-arrow-90deg-left"></i> Back</a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="save_size.php" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Size Name</label>
                                    <input type="text" name="size_name" class="form-control">

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button type="submit" name="submit" class="form-control btn btn-secondary mt-2 mb-2 fw-bold">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>