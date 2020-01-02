<?php require_once('../inc/header.php'); ?>

<div class="delivery">
    <div class="delivery_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
               <div class="delivery_right">
               <h2>All Deliveries</h2>
               <?php if(isset($_SESSION['updated'])) { echo $_SESSION['updated'];} ?>
               <?php if(isset($_SESSION['error'])) { echo $_SESSION['error']; }   ?>
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
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($deliveries as $delivery) : ?>
                                <tr>
                                    <td><?= $delivery->to_location; ?></td>
                                    <td><?= $delivery->from_location; ?></td>
                                    <td><?= $delivery->sender_name; ?></td>
                                    <td><?= $delivery->receipient_name; ?></td>
                                    <td><?= $delivery->sender_mobile_number; ?></td>
                                    <td><?= $delivery->receipient_mobile_number; ?></td>
                                    <td><?= $delivery->package_type; ?></td>
                                    <td><a href="edit-deliveries/<?= $delivery->id; ?>"><i class="fa fa-edit"></i></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                     </table>
                     <?php if($total_pages > 1) : ?>
                        <ul class="pagination justify-content-center">
                            <?php if(isset($page) && $page > 1)  : ?>
                                <li class="page-item"><a class="page-link" href="deliveries/<?php if(isset($page) && $page > 1) { echo $page - 1; } else { echo '#'; } ?>">Previous</a></li>
                            <?php endif; ?>
                            <?php for($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item"><a class="page-link" href="deliveries/<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item"><a class="page-link" href="deliveries/<?php if(isset($page) && ($i > $page)) { if($page > $total_pages - 1) { echo $total_pages; } else { echo $page + 1; } } else { echo 2; } ?>">Next</a></li>
                        </ul>
                     <?php endif; ?> 
               </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>