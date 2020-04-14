<?php require('../inc/header.php'); ?>
    <div class="withdrawals">
        <div class="withdrawals_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <h3>Withdrawal Summary</h3>
                    <?php if(isset($_SESSION['update_success'])) { echo $_SESSION['update_success']; unset($_SESSION['update_success']); } ?>
                    <?php if(isset($_SESSION['update_error'])) { echo $_SESSION['update_error']; unset($_SESSION['update_error']); } ?>
                    <?php if(isset($_SESSION['balance_error'])) { echo $_SESSION['update_error']; unset($_SESSION['balance_error']); } ?>
                    <?php if(isset($_SESSION['delete_error'])) { echo $_SESSION['delete_error']; } ?>
                    <?php if(isset($_SESSION['delete_success'])) { echo $_SESSION['delete_success']; } ?>
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Bank Name</th>
                                <th>Account Number</th>
                                <th>BBAN Number</th>
                                <th>Request Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($withdrawals as $withdrawal) : ?>
                                <tr>
                                    <td><?= $withdrawal->name; ?></td>
                                    <td><?= $withdrawal->withdrawal_amount; ?></td>
                                    <td><?= $withdrawal->bank_name; ?></td>  
                                    <td><?= $withdrawal->account_number; ?></td>
                                    <td><?= $withdrawal->bban_number; ?></td>
                                    <td><?= $withdrawal->request_status; ?></td>
                                    <?php if($withdrawal->request_status !== "Approved") : ?>
                                        <td><a href="withdrawal-request/<?= $withdrawal->id; ?>"><i class="fa fa-edit"></i></a></td>
                                    <?php else : ?>
                                        <td><a href="withdrawals"><i class="fa fa-edit"></i></a></td>
                                    <?php endif; ?>
                                    <td>
                                        <form action="" method="post">
                                            <button type="submit" name="delete"><i class="fa fa-trash"></i></button> 
                                            <input type="hidden" name="id" value="<?= $withdrawal->id; ?>">
                                        </form>
                                </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>