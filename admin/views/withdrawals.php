<?php require('../inc/header.php'); ?>

<div class="withdrawals">
    <div class="withdrawals_container">
        <div class="row">
            <div class="col-md-3">
                <?php require('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
                <h3>Withdrawal Requests</h3>
                <?php if(isset($_SESSION['approved'])) { echo $_SESSION['approved']; } ?>
                <?php if(isset($_SESSION['rejected'])) { echo $_SESSION['rejected']; } ?>
                <table class="table table-responsive">
                    <thead>
                        <th>Name</th>
                        <th>Bank Name</th>
                        <th>Withdrawal Amount</th>
                        <th>Account Number</th>
                        <th>BBAN Number</th>
                        <th>Approve</th>
                    </thead>
                    <tbody>
                        <?php foreach($withdrawals as $withdrawal) : ?>
                        <tr>
                            <td><?= $withdrawal->name; ?></td>
                            <td><?= $withdrawal->bank_name; ?></td>
                            <td><?= $withdrawal->withdrawal_amount; ?></td>
                            <td><?= $withdrawal->account_number; ?></td>
                            <td><?= $withdrawal->bban_number; ?></td>
                            <td>
                               <?php if($withdrawal->request_status == "Approved") : ?>
                                    <input type="submit" value="Approved" disabled class="btn btn-success btn-sm">
                               <?php else : ?>
                                <form action="" method="post">
                                   <input type="submit" value="Approve" name="approve" class="btn btn-success btn-sm">
                                   <input type="hidden" value="<?= $withdrawal->partner_id; ?>" name="partner_id">
                                    <input type="hidden" name="withdrawal_amount" value="<?= $withdrawal->withdrawal_amount; ?>">
                                </form>
                               <?php endif; ?>
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