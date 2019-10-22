<?php require_once('../inc/header.php'); ?>

<div class="dashboard">
    <div class="dashboard_container">
        <div class="row">
            <div class="col-md-3 col-sm">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9 col-sm">
                <div class="dashboard_summary">
                    <div class="row">
                        <div class="col-md-4">
                             <h4>Deliveries</h4>
                            <div class="deliveries">
                                <div class="deliveries_container">
                                    <h6>Ongoing Deliveries</h6>
                                <h4><i class="fa fa-truck"></i></h4>
                                <h6><strong>2</strong></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <h4>Spendings</h4>
                            <div class="spendings">
                            <div class="spendings_container">
                                <h6>Amount Spent</h6>
                                <h4><i class="fa fa-money-bill-wave"></i></h4>
                                <h6><strong>GMD 3000</strong></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <h4>Balance</h4>
                            <div class="balance">
                            <div class="balance_container">
                                <h6>Remaining</h6>
                                <h4><i class="fa fa-money-bill-alt"></i></h4>
                                <h6><strong>GMD 6000</strong></h6>
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