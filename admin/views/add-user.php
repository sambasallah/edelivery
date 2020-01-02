<?php require('../inc/header.php'); ?>

<div class="add_user">
    <div class="add_user_container">
        <div class="row">
            <div class="col-md-3">
                <?php require('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
                <h2>Add User</h2>
                <div class="right">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="First Name">First Name:</label>
                        <input type="text" class="form-control" value="<?php if(isset($user->first_name)) { echo $user->first_name; } ?>" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="Last Name">Last Name:</label>
                        <input type="text" class="form-control" value="<?php if(isset($user->last_name)) { echo $user->last_name; } ?>" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email address:</label>
                        <input type="email" class="form-control" value="<?php if(isset($user->email)) { echo $user->email; } ?>" name="email">
                    </div>
                    <div class="form-group">
                        <label for="Username">Username:</label>
                        <input type="text" class="form-control" value="<?php if(isset($user->username)) { echo $user->username; } ?>" name="username">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password:</label>
                        <input type="password" class="form-control" value="<?php if(isset($user->password)) { echo $user->password; }; ?>" name="password">
                    </div>
                   
                    <?php if(isset($_GET['edit']) && is_numeric($_GET['edit'])) : ?>
                        <button type="submit" class="btn btn-primary" name="update_user">Update User</button>
                        <input type="hidden" value="<?php if(isset($user->id)) { echo $user->id; } ?>" name="user_id">
                    <?php else : ?>
                        <button type="submit" class="btn btn-primary" name="add_user">Add User</button>
                    <?php endif; ?>
            </form>
            </div>
                </div>
        </div>
    </div>
</div>

<?php require('../inc/footer.php'); ?>