<?php require('../inc/header.php'); ?>
    <div class="withdrawal_request">
        <div class="withdrawal_request_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <h3>Withdrawal Request</h3>
                    <form action="withdrawal-request" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Full Name"  name="name" value="<?php if(isset($withdrawal_request->name)) { echo $withdrawal_request->name; }; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Withdrawal Amount"  value="<?php if(isset($withdrawal_request->withdrawal_amount)) { echo $withdrawal_request->withdrawal_amount; }; ?>"   name="amount" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Bank Name"  value="<?php if(isset($withdrawal_request->bank_name)) { echo $withdrawal_request->bank_name; } ?>"   name="bank_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Bank Account Number"  value="<?php if(isset($withdrawal_request->account_number)) { echo $withdrawal_request->account_number; } ?>"   name="account_number" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="BBAN Number"   value="<?php if(isset($withdrawal_request->bban_number)) { echo $withdrawal_request->bban_number; } ?>"  name="bban_number" class="form-control">
                        </div>
                        <?php if(isset($withdrawal_request->id)) : ?>
                            <input type="submit" value="Update Request" name="update" class="btn btn-primary">
                            <input type="hidden" name="id" value="<?= $withdrawal_request->partner_id; ?>">
                        <?php else : ?>
                            <input type="submit" value="Withdraw" name="withdraw" class="btn btn-primary">
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>