<?php require_once('../inc/header.php'); ?>

<div class="dashboard">
    <div class="dashboard_container">
        <div class="row">
            <div class="col-md-3 col-sm">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9 col-sm">
                <div class="dashboard_summary">
                    <?= $profile_complete; ?>
                     <?= $account_balance_status;  ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="deliveries">
                                <h3>Ongoing Delvs</h3>
                                <p><i class="fa fa-truck"></i> <?= $ongoingDelvs; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="spendings">
                                <h3>Total Spent</h3>
                                <p><i class="fa fa-money-bill-wave"></i> GMD <?= number_format($total_spent,2); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="balance">
                            <div class="balance_container">
                                <h3>Balance</h3>
                                <p><i class="fa fa-money-bill-alt"></i> GMD <?= number_format($account_balance,2); ?></p>
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- chart -->
                    <div class="chart">
                        <div class="chart_container">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="spendings_chart" heigth="200px">

                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>