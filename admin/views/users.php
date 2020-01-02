<?php require_once('../inc/header.php'); ?>

<div class="users">
    <div class="users_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="users_right">
                    <div class="users_header">
                    <h2>Users
                        <form action="" method="post">
                            <input type="submit" value="Add User" name="add_user" class="btn btn-success">
                        </form>
                    </h2> <br>
                    </div>
                    <?php if(isset($_SESSION['username_exists'])) { echo $_SESSION['username_exists']; } unset($_SESSION['username_exists']) ?>
                    <?php if(isset($_SESSION['email_exists'])) { echo $_SESSION['email_exists']; } unset($_SESSION['email_exists']); ?>
                    <?php if(isset($_SESSION['profile_success'])) { echo $_SESSION['profile_success']; } unset($_SESSION['profile_success']); ?>
                    <?php if(isset($_SESSION['profile_error'])) { echo $_SESSION['profile_error']; } unset($_SESSION['profile_error']); ?>
                    <table class="table table-responsive table-hovered">
                        <thead>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user) : ?>
                            <tr>
                                <td><?= $user->first_name; ?></td>
                                <td><?= $user->last_name; ?></td>
                                <td><?= $user->username; ?></td>
                                <td><?= $user->email; ?></td>
                                <td><?= str_repeat("*",7); ?></td>
                                <td><?= $user->role; ?></td>
                                <td><a href="add-user/<?= $user->id; ?>"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <form action="users" method="post">
                                        <button type="submit" name="delete_user"><i class="fa fa-trash"></i></button>
                                        <input type="hidden" value="<?= $user->id; ?>" name="user_id">
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if($total_pages > 1) : ?>
                        <ul class="pagination justify-content-center">
                            <?php if(isset($page) && $page > 1)  : ?>
                                <li class="page-item"><a class="page-link" href="deliveries/<?php if(isset($page) && $page > 1) { echo $page - 1; } else { echo '#'; } ?>">Previous</a></li>
                            <?php endif; ?>
                            <?php for($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item"><a class="page-link" href="deliveries/<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item"><a class="page-link" href="deliveries/<?php if(isset($page) && ($i > $page)) { if($page > $total_pages - 1) { echo $total_pages; } else { echo $page + 1; } } else { echo 2; } ?>">Next</a></li>
                        </ul>
                     <?php endif; ?> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>