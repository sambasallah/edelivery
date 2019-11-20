<?php require_once('../inc/header.php'); ?>

    <div class="request">
        <div class="request_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <div class="right_request">
                        <?php if(isset($_SESSION['delivery_request_success'])) { echo $_SESSION['delivery_request_success']; } ?>
                        <?php if(isset($_SESSION['delivery_request_error'])) { echo $_SESSION['delivery_request_error']; } ?>
                        <h2>Make Delivery Request</h2>
                        <form action="" method="post">
                            <div class="form-group">
                                    <select name="to" id="" class="custom-select" required>
                                            <option value="Serrekunda">To</option>
                                            <option value="Serrekunda">Serrekunda</option>
                                            <option value="Banjul">Banjul</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                <select name="from" id="" class="custom-select" required>
                                        <option value="Banjul">From</option>
                                        <option value="Serrekunda">Serrekunda</option>
                                        <option value="Banjul">Banjul</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Receipient Name" name="receipient_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Receipient Mobile Number" name="receipient_mobile_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Receipient Address" name="receipient_address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Sender Name" name="sender_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Sender Mobile Number" name="sender_mobile_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Sender Address" name="sender_address" class="form-control" required>
                            </div>
                             <div class="form-group">
                                <input type="text" placeholder="Item Name" name="item_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Item Price" name="item_price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Item Type (eg heavy,medium,light)" name="item_type" class="form-control" required> 
                            </div>
                            <input type="submit" value="Make Request" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('../inc/footer.php'); ?>