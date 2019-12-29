<?php require('../inc/header.php'); ?>
<div class="accepted">
    <div class="accepted_container">
        <div class="row">
            <div class="col-md-3">
                <?php require('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9 right">
            <h3>Accepted Delivery Request</h3>
            <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>From</th>
                                <th>Package Type</th>
                                <th>Package Size</th>
                                <th>Delivery Fee</th>
                                <th>Pick Up Date</th>
                                <th>Earned (70%)</th> 
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($accepted_requests as $request) : ?>
                                    <tr>
                                    <td><?= $request->to_location; ?></td>
                                    <td><?= $request->from_location; ?></td>
                                    <td><?= $request->package_type?></td>
                                    <td><?= $request->package_size?></td>
                                    <td><?= $request->rate; ?></td>
                                    <td><?= $request->pick_up_date; ?></td>
                                    <td><?= $request->rate * (70/100); ?></td>
                                    <td>
                                        <form action="" method="post">
                                           <?php if($request->request_status == "On Route") : ?>
                                            <input type="submit" value="Delivered" name="delivered" name="delivered" class="btn btn-success">
                                            <input type="hidden" value="<?= $request->rate * (70/100); ?>" name="earned">
                                            <input type="hidden" value="<?= $request->to_location; ?>" name="to_location">
                                            <input type="hidden" value="<?= $request->from_location; ?>" name="from_location">
                                            <input type="hidden" value="<?= $request->package_size; ?>" name="package_size">
                                            <input type="hidden" value="<?= $request->rate; ?>" name="rate">
                                            <input type="hidden" value="<?= $request->package_type; ?>" name="package_type">
                                           <?php else : ?>
                                            <input type="submit" value="Completed" name="delivered" class="btn btn-success" disabled>
                                           <?php endif; ?>
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