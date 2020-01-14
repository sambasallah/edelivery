<?php require('../inc/header.php'); ?>
    <div class="complaints">
        <div class="complaints_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <h2>Complaints</h2>
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>P Name</th>
                                <th>P Number</th>
                                <th>P Email</th>
                                <th>Complaint Text</th>
                                <th>M Name</th>
                                <th>M Number</th>
                                <th>M Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($complaints as $complaint) : ?>
                                <tr>
                                    <td><?= $complaint->partner_name; ?></td>
                                    <td><?= $complaint->partner_number; ?></td>
                                    <td><?= $complaint->partner_email; ?></td>
                                    <td><?= $complaint->complaint_text; ?></td>
                                    <td><?= $complaint->merchant_name; ?></td>
                                    <td><?= $complaint->merchant_number; ?></td>
                                    <td><?= $complaint->merchant_email; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>