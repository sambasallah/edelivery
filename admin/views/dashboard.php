<?php require_once('../inc/header.php'); ?>

<div class="dashboard">
    <div class="dashboard_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="summary">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="total_revenue">
                                <h3>Total Revenue</h3>
                                <h4><i class="fa fa-money-bill-alt"></i> GMD 3,000,000</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="partners">
                                <h3>Partners</h3>
                                <h4><i class="fa fa-users"></i> 100</h4>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="merchants">
                                <h3>Merchants</h3>
                                <h4><i class="fa fa-user"></i> 25</h4>
                            </div>
                        </div>
                    </div>
                   <!-- admin analytics --> 
                    <div class="analytics">
                        <div class="analytics_container">
                            <div class="card">
                            <div class="card-body">
                                <canvas id="admin_analytics" heigth="400px"></canvas>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php');?> 