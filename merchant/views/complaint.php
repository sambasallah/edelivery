<?php require('../inc/header.php'); ?>
    <div class="complaint">
        <div class="complaint_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9 right">
                <h2>Open Complaint</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="Complaint Text">Complaint Text</label>
                            <textarea name="complaint_text" id="" rows="3" class="form-control"></textarea>
                        </div>
                        <input type="submit" value="Send" class="btn btn-success" name="send_complaint">
                        <input type="hidden" value="<?= $_SESSION['partner_id']; ?>" name="partner_id">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>