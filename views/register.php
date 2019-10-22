<?php require_once('../inc/header.php'); ?>

<div class="register">
    <div class="register_container">
        <div class="register_form">
            <h4>Merchant Account</h4>
            <form action="" method="post">
               <div class="form-group">
                   <label for="Full Name">Full Name</label>
                   <input type="text" class="form-control" placeholder="Full Name">
               </div>
               <div class="form-group">
                   <label for="Email">Email</label>
                   <input type="text" class="form-control" placeholder="Email">
               </div>
               <div class="form-group">
                   <label for="Username">Username</label>
                   <input type="text" class="form-control" placeholder="Username">
               </div>
               <div class="form-group">
                   <label for="Password">Password</label>
                   <input type="password" class="form-control" placeholder="Password">
               </div>
                <input type="submit" value="Register" class="btn btn-success">
            </form>
            <p>Already Have an Account? <a href="login">Login</a></p>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>