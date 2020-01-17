<?php require_once('../inc/header.php'); ?>

<div class="merchant">
    <div class="merchant_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
               <div class="merchant_right">
               <h2>Merchants</h2>
               <?php if(isset($_SESSION['delete_success'])) { echo $_SESSION['delete_success']; } unset($_SESSION['delete_success']); ?>
               <?php if(isset($_SESSION['delete_failed'])) { echo $_SESSION['delete_failed']; } ?>
                <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Spendings (GMD)</th>
                                <th>Business Name</th>
                                <th>Busines Location</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($merchants as $merchant) : ?>
                                <tr>
                                    <td><?= $merchant->first_name; ?></td>
                                    <td><?= $merchant->last_name; ?></td>
                                    <td><?= $merchant->username; ?></td>
                                    <td><?= $merchant->business_phone; ?></td>
                                    <td><?= $merchant->total_spent; ?></td>
                                    <td><?= $merchant->business_name; ?></td>
                                    <td><?= $merchant->business_location; ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <button type="submit" name="delete_merchant"><i class="fa fa-trash"></i></button>
                                            <input type="hidden" name="id" value="<?= $merchant->merchant_id; ?>">
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
</div>

<?php require_once('../inc/footer.php'); ?>