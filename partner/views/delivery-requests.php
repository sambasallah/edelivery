<?php require_once('../inc/header.php'); ?>

<div class="delivery_requests">
    <div class="delivery_requests_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="right">
                <h3>Delivery Requests</h3> 
                <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>From</th>
                                <th>Sender Name</th>
                                <th>Receipt Name</th>
                                <th>Sender Number</th>
                                <th>Receipt Number</th>
                                <th>Package Type</th>
                                <th>View</th>
                                <th width="15%">Accept</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($delivery_requests as $request) : ?>
                                <tr>
                                    <td><?= $request->to_location; ?></td>
                                    <td><?= $request->from_location; ?></td>
                                    <td><?= $request->sender_name; ?></td>
                                    <td><?= $request->receipient_name; ?></td>
                                    <td><?= $request->sender_mobile_number; ?></td>
                                    <td><?= $request->receipient_mobile_number; ?></td>
                                    <td><?= $request->package_type; ?></td>
                                    <td><a href="view-request/<?= $request->id; ?>"><i class="fa fa-eye"></i></a></td>
                                    <td>
                                       <form action="" method="post">
                                            <?php if($accepted) : ?>
                                                <input type="submit" value="Confirm" class="btn btn-success" disabled> 
                                            <?php else : ?> 
                                                <input type="submit" value="Confirm" class="btn btn-success">
                                                <input type="hidden" value="<?= $request->id; ?>" name="request_id">
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
                                <li class="page-item"><a class="page-link" href="delivery-requests/<?php if(isset($page) && $page > 1) { echo $page - 1; } else { echo '#'; } ?>">Previous</a></li>
                            <?php endif; ?>
                            <?php for($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item"><a class="page-link" href="delivery-requests/<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item"><a class="page-link" href="delivery-requests/<?php if(isset($page) && ($i > $page)) { if($page > $total_pages - 1) { echo $total_pages; } else { echo $page + 1; } } else { echo 2; } ?>">Next</a></li>
                        </ul>
                     <?php endif; ?>      
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>