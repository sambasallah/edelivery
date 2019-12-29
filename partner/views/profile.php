<?php require_once('../inc/header.php'); ?>
    <div class="profile_partner">
        <div class="profile_partner_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <div class="right">
                    <h3>Profile Information</h3>
                    <?php if(isset($_SESSION['profile_success'])) { echo $_SESSION['profile_success']; } ?>
                    <?php if(isset($_SESSION['profile_error'])) { echo $_SESSION['profile_error']; } ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="First Name" value="<?= $profile_information->first_name; ?>" name="first_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Last Name" value="<?= $profile_information->last_name; ?>" name="last_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Username" value="<?= $profile_information->username; ?>" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" value="<?= $profile_information->password; ?>" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Email Address" value="<?= $profile_information->email; ?>" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Phone Number" value="<?= $profile_information->phone_number; ?>" name="phone_number" class="form-control">
                        </div>
                        <input type="submit" value="update" class="btn btn-primary">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../inc/footer.php'); ?>