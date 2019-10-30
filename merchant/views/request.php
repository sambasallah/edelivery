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
                                    <select name="" id="" class="custom-select" required>
                                            <option value="0">To</option>
                                            <option value="1">Serrekunda</option>
                                            <option value="2">Banjul</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                <select name="" id="" class="custom-select" required>
                                        <option value="0">From</option>
                                        <option value="1">Serrekunda</option>
                                        <option value="2">Banjul</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Receipient Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Receipient Mobile Number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Receipient Address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Sender Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Sender Mobile Number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Sender Address" class="form-control" required>
                            </div>
                             <div class="form-group">
                                <input type="text" placeholder="Item Name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Item Type (eg heavy,medium,light)" class="form-control" required> 
                            </div>
                            <input type="submit" value="Make Request" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('../inc/footer.php'); ?>