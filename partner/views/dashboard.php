<?php require_once('../inc/header.php'); ?>

<div class="dashboard">
    <div class="dashboard_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="analytics">
                    <div class="row">
                        <div class="col-md-4">  
                            <div class="earnings">
                                <h3>Total Earnings</h3>
                                <p><i class="fa fa-money-bill-alt"></i> GMD30,000</p>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="withdrawn_earnings">
                                <h3>Withdrawn</h3>
                                <p><i class="fa fa-money-bill"></i> GMD5,000</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="balance">
                                <h3>Balance</h3>
                                <p><i class="fa fa-money-bill"></i> 25,000</p>
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