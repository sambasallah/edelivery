<?php require('../inc/header.php'); ?>
    <div class="arrival_time">
        <div class="arrival_time_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9 right">
                    <h2>Estimated Arrival Time</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Estimated Arrival Time" name="arrival_time" class="form-control" id="arrival_time" required>
                        </div>
                        <input type="submit" name="update_time" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>