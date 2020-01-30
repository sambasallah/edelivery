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
                    <?php if(isset($_SESSION['updated'])) { echo $_SESSION['updated']; } ?>
                    <?php if(isset($_SESSION['error'])) { echo $_SESSION['error']; } ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" placeholder="First Name" value="<?= $profile_information->first_name; ?>" name="first_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Last Name" value="<?= $profile_information->last_name; ?>" name="last_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input readonly type="text" placeholder="Username" value="<?= $profile_information->username; ?>" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" value="<?= $profile_information->password; ?>" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input readonly type="text" placeholder="Email Address" value="<?= $profile_information->email; ?>" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Phone Number" value="<?= $profile_information->phone_number; ?>" name="phone_number" class="form-control">
                        </div>
                        <div class="form-group">
                          <?php if($profile_information->profile_picture == NULL) : ?>
                            <img src="../media/images/partner_avatar.png" width="251px" height="201px" alt="Profile Picture">
                            <input type="file" name="profile_picture">
                          <?php else : ?>
                            <img src="../storage/public/uploads/profile/<?= $profile_information->profile_picture; ?>" width="200px" height="200px" style="object-fit:cover; border-radius:50%" alt="Profile Picture">
                            <input type="file" name="profile_picture">
                          <?php endif; ?>
                        </div>
                        <input type="submit" value="update" name="save_profile" class="btn btn-primary">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../inc/footer.php'); ?>