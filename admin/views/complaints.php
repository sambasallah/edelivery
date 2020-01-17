<?php require('../inc/header.php'); ?>
    <div class="complaints">
        <div class="complaints_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                    <h2>Complaints</h2>
                    <?php if(isset($_SESSION['complaint_deleted'])) { echo $_SESSION['complaint_deleted']; } ?>
                    <?php if(isset($_SESSION['error_complaint'])) { echo $_SESSION['error_complaint']; } ?>
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>Partner Name</th>
                                <th>Partner Email</th>
                                <th>Complaint Text</th>
                                <th>Merchant Name</th>
                                <th>Merchant Email</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($complaints as $complaint) : ?>
                                <tr>
                                    <td><?= $complaint->partner_name; ?></td>
                                    <td><?= $complaint->partner_email; ?></td>
                                    <td><?= $complaint->complaint_text; ?></td>
                                    <td><?= $complaint->merchant_name; ?></td>
                                    <td><?= $complaint->merchant_email; ?></td>
                                    <td><i class="fa fa-edit"></i></td>
                                    <td>
                                        <form action="" method="post">
                                            <button type="submit" name="delete_complaint"><i class="fa fa-trash"></i></button>
                                            <input type="hidden" name="complaint_id" value="<?= $complaint->id; ?>">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if($total_pages > 1) : ?>
                        <ul class="pagination justify-content-center">
                            <?php if(isset($page) && $page > 1)  : ?>
                                <li class="page-item"><a class="page-link" href="complaints/<?php if(isset($page) && $page > 1) { echo $page - 1; } else { echo '#'; } ?>">Previous</a></li>
                            <?php endif; ?>
                            <?php for($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item"><a class="page-link" href="complaints/<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item"><a class="page-link" href="complaints/<?php if(isset($page) && ($i > $page)) { if($page > $total_pages - 1) { echo $total_pages; } else { echo $page + 1; } } else { echo 2; } ?>">Next</a></li>
                        </ul>
                     <?php endif; ?> 
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>