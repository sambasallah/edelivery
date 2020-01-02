<?php require('../inc/header.php'); ?>
<div class="accepted">
    <div class="accepted_container">
        <div class="row">
            <div class="col-md-3">
                <?php require('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9 right">
            <h3>Accepted Delivery Request</h3>
            <?php if(isset($_SESSION['update_success'])) { echo $_SESSION['update_success']; unset($_SESSION['update_success']); } ?>
            <?php if(isset($_SESSION['update_error'])) { echo $_SESSION['update_error']; unset($_SESSION['update_error']); } ?>
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
                                <th>Edit</th> 
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
                                    <?php if($request->request_status == "Delivered") : ?>
                                        <td><i class="fa fa-edit"></i></td>
                                    <?php else : ?>
                                        <td><a href="arrival-time/<?= $request->id; ?>"><i class="fa fa-edit"></i></a></td>
                                    <?php endif; ?>
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
                        <?php if($total_pages > 1) : ?>
                        <ul class="pagination justify-content-center">
                            <?php if(isset($page) && $page > 1)  : ?>
                                <li class="page-item"><a class="page-link" href="accepted/<?php if(isset($page) && $page > 1) { echo $page - 1; } else { echo '#'; } ?>">Previous</a></li>
                            <?php endif; ?>
                            <?php for($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item"><a class="page-link" href="accepted/<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item"><a class="page-link" href="accepted/<?php if(isset($page) && ($i > $page)) { if($page > $total_pages - 1) { echo $total_pages; } else { echo $page + 1; } } else { echo 2; } ?>">Next</a></li>
                        </ul>
                     <?php endif; ?>                 
                     
            </div>
        </div>
    </div>
</div>
<?php require('../inc/footer.php'); ?>