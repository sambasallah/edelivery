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
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="First Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Middle Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Last Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Email Address" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Phone Number" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="DOB" class="form-control">
                        </div>
                        <input type="submit" value="save" class="btn btn-primary">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../inc/footer.php'); ?>