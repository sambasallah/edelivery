<?php require_once('../inc/header.php'); ?>

    <div class="request">
        <div class="request_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <div class="right_request">
                        <h2>Make Delivery Request</h2>
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="text" placeholder="To (Address)" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="From (Address)" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Receipient" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Item Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Item Price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Item Type (eg heavy,light,medium)" class="form-control" required> 
                            </div>
                            <div class="form-group">
                                <select name="" id="" class="custom-select" required>
                                    <option value="0">Municipality</option>
                                    <option value="1">Kanifing Municipal Council</option>
                                    <option value="2">Banjul City Council</option>
                                </select>
                            </div>
                            <input type="submit" value="Make Request" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('../inc/footer.php'); ?>