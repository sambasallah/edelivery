<?php require('../inc/header.php'); ?>
    <div class="earnings">
        <div class="earnings_container">
            <div class="row">
                <div class="col-md-3"><?php require('../inc/sidenav.php'); ?></div>
                <div class="col-md-9 right">
                    <h2>Earnings Summary</h2>
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>From</th>
                                <th>Package Type</th>
                                <th>Package Size</th>
                                <th>Rate</th>
                                <th>Earned</th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php foreach($earnings as $earning) : ?>
                                    <tr>
                                        <td><?= $earning->to_location; ?></td>
                                        <td><?= $earning->from_location; ?></td>
                                        <td><?= $earning->package_type; ?></td>
                                        <td><?= $earning->package_size; ?></td>
                                        <td><?= $earning->rate; ?></td>
                                        <td><?= $earning->earned; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>