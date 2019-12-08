<?php require_once('../inc/header.php'); ?>
    <div class="profile">
        <div class="profile_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <div class="profile_right">
                        <?= $profile_error; ?>
                        <?= $profile_success; ?>
                        <h2>Profile Information</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="First Name" name="first_name" value="<?= $profile_information->first_name; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Middle Name" name="middle_name" value="<?= $profile_information->middle_name; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Last Name" name="last_name" value="<?= $profile_information->last_name; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Username" name="username" value="<?= $profile_information->username; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Email" name="email" value="<?= $profile_information->email; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" name="password" value="<?= $profile_information->password; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="date" placeholder="Date Of Birth" name="dob" value="<?= $profile_information->dob; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Address" name="address" value="<?= $profile_information->address; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Business Name" name="business_name" value="<?= $profile_information->business_name; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Business Location" name="business_location" value="<?= $profile_information->business_location; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Business Email" name="business_email" value="<?= $profile_information->business_email; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Business Phone" name="business_phone" value="<?= $profile_information->business_phone; ?>" class="form-control">
                        </div>
                        <input type="submit" value="Save" name="update_profile" class="btn btn-success">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../inc/footer.php'); ?>