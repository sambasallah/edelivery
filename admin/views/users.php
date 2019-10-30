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
                    <h2>Users</h2>
                    </div>
                    <table class="table table-responsive table-hovered">
                        <thead>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Samba</td>
                                <td>Sallah</td>
                                <td>sambasallah</td>
                                <td>sambasallah10@gmail.com</td>
                                <td>********</td>
                                <th><i class="fa fa-edit"></i> <i class="fa fa-trash"></i></th>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>