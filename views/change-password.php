<?php require('../inc/header.php'); ?>
    <div class="change_password">
        <div class="change_password_container">
            <div class="password_change_form">
                <h2>Change Your Password</h2>
                <form action="" method="post">
                    <input type="password" name="password1" placeholder="New Password"> <br>
                    <input type="password" name="password2" placeholder="Repeat Password">
                    <input type="hidden" value="<?= $email; ?>" name="email">
                    <input type="submit" value="Change" name="change">
                </form>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>