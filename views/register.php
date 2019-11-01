<?php require_once('../inc/header.php'); ?>

<div class="register">


    <div class="register_container">
        <div class="register_form">
      
            <h4>Merchant Account</h4>

            <?php if(isset($_SESSION['username_exists'])) {
            echo $_SESSION['username_exists'];
        }  ?>
             <?php if(isset($_SESSION['email_exists'])) { echo $_SESSION['email_exists'];
                          
                }  ?>
            <?php if(isset($_SESSION['error_register'])) { echo $_SESSION['error_register'];
            }  ?>
          
            <form action="" method="post">
               <div class="form-group">
                   <label for="Full Name">First Name</label>
                   <input type="text" class="form-control" name="first_name" placeholder="Full Name">
               </div>
               <div class="form-group">
                   <label for="Full Name">Middle Name</label>
                   <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
               </div>
               <div class="form-group">
                   <label for="Full Name">Last Name</label>
                   <input type="text" class="form-control" name="last_name" placeholder="Last Name">
               </div>
               <div class="form-group">
                   <label for="Email">Email</label>
                   <input type="text" class="form-control" name="email" placeholder="Email">
               </div>
               <div class="form-group">
                   <label for="Username">Username</label>
                   <input type="text" class="form-control" name="username" placeholder="Username">
               </div>
               <div class="form-group">
                   <label for="Password">Password</label>
                   <input type="password" class="form-control" name="password" placeholder="Password">
               </div>
                <input type="submit" value="Register" class="btn btn-success">
            </form>
            <p>Already Have an Account? <a href="login">Login</a></p>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>