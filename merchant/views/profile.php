<?php require_once('../inc/header.php'); ?>
    <div class="profile">
        <div class="profile_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <div class="profile_right">
                        <h2>Profile Information</h2>
                    <form action="#" method="post">
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
                            <input type="text" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Phone Number" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="date" placeholder="Date Of Birth" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Address" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Business Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Business Location" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Business Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Business Phone" class="form-control">
                        </div>
                        <input type="submit" value="Save" class="btn btn-success">
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../inc/footer.php'); ?>