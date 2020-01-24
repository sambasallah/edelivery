<?php require('../inc/header.php'); ?>
    <div class="reset_success">
        <div class="reset_success_container">
            <div class="reset_success_text">
                <h2><i class="fa fa-check-circle"></i></h2>
                <h3>Password Reset Sent</h3>
                <p>Check Your Inbox And Enter The Token Below</p>
                <form action="change-password" method="post">
                    <input type="text" placeholder="Token" name="token">
                    <input type="submit" value="Reset" name="reset">
                </form>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>

