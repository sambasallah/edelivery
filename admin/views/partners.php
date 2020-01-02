<?php require_once('../inc/header.php'); ?>

<div class="partner">
    <div class="partner_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
               <div class="partner_right">
               <h2>Partners</h2>
                <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Phone</th>
                                <th>Earnings (GMD)</th>
                                <th>Edit</th>
                                <th>Del</th>
                            </thead>
                            <tbody>
                                <?php foreach($partners as $partner) : ?>
                                <tr>
                                    <td><?= $partner->first_name; ?></td>
                                    <td><?= $partner->last_name; ?></td>
                                    <td><?= $partner->username; ?></td>
                                    <td><?= $partner->email; ?></td>
                                    <td><?= $partner->account_status; ?></td>
                                    <td><?= $partner->phone_number; ?></td>
                                    <td><?= $partner->earnings; ?></td>
                                    <td><a href="partner-view/<?= $partner->partner_id; ?>"><i class="fa fa-eye"></i></a></td>
                                    <td>
                                        <form action="" method="post">
                                            <button type="submit" name="delete_partner"><i class="fa fa-trash"></i></button>
                                            <input type="hidden" name="partner_id" value="<?= $partner->partner_id; ?>">
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