<?php require('../inc/header.php'); ?>
    <div class="edit_deliveries">
        <div class="edit_deliveries_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <h2>Edit Delivery</h2>
                    <?php if(isset($_SESSION['updated'])) { unset($_SESSION['updated']); } ?>
                    <?php if(isset($_SESSION['error'])) { unset($_SESSION['error']); }   ?>
                    <form action="deliveries" method="post">
                        <div class="form-group">
                            <label for="To Location">To Location:</label>
                            <select name="to_location" id="" class="form-control">
                               <option value="<?= $delivery_request->to_location; ?>"><?= $delivery_request->to_location; ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="From Location">From Location:</label>
                            <select name="from_location" id="" class="form-control">
                                <option value="<?= $delivery_request->from_location; ?>"><?= $delivery_request->from_location; ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Receipient Name">Receipient Name</label>
                            <input type="text" name="receipient_name" value="<?= $delivery_request->receipient_name; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Sender Name">Sender Name</label>
                            <input type="text" name="sender_name" value="<?= $delivery_request->sender_name; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Receipient Number">Receipient Number</label>
                            <input type="text" name="receipient_number" value="<?= $delivery_request->receipient_mobile_number; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Sender Number">Sender Number</label>
                            <input type="text" name="sender_number" value="<?= $delivery_request->sender_mobile_number; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Delivery Note">Delivery Note</label>
                            <textarea name="delivery_note" id="" rows="3" class="form-control"><?= $delivery_request->delivery_note; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update_delivery">Update</button>
                        <input type="hidden" name="id" value="<?= $delivery_request->id; ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>