<?php require_once('../inc/header.php'); ?>

<div class="dashboard">
    <div class="dashboard_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="analytics">
                    <?php if(isset($_SESSION['withdrawal_request'])) { echo $_SESSION['withdrawal_request']; unset($_SESSION['withdrawal_request']); } ?>
                    <?php if(isset($_SESSION['withdrawal_error'])) { echo $_SESSION['withdrawal_error']; unset($_SESSION['withdrawal_error']); } ?>
                    <?php if(isset($_SESSION['insufficient_balance'])) { echo $_SESSION['insufficient_balance']; unset($_SESSION['insufficient_balance']); } ?>
                    <div class="row">
                        <div class="col-md-4">  
                            <div class="earnings">
                                <h3>Total Earnings</h3>
                                <p><i class="fa fa-money-bill-alt"></i> GMD <?php // number_format($earnings,2); ?></p>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="withdrawn_earnings">
                                <h3>Withdrawn</h3>
                                <p><i class="fa fa-money-bill"></i> GMD <?= number_format($withdrawals,2); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="balance">
                                <h3>Balance</h3>
                                <p><i class="fa fa-money-bill"></i> GMD <?= number_format($balance,2); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="graph">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="daily_earnings">
                                
                            </canvas>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>