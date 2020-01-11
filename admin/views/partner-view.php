<?php require('../inc/header.php'); ?>
    <div class="partner_view">
        <div class="partner_view_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9 right">
                    <h2>Partner Information</h2>
                    <div class="partner_information">
                        <h5>Full Name : <?= $partner_info->first_name . ' '. $partner_info->last_name; ?></h5>
                        <h5>Username : <?= $partner_info->username; ?></h5>
                        <h5>Email : <?= $partner_info->email; ?></h5>
                        <h5>Phone Number : <?= $partner_info->phone_number; ?></h5>
                        <h5>Municipality : <?= $partner_info->municipality; ?></h5>
                        <h5>Vehicle Type : Pick Up</h5>
                        <h5>Account Status : <?= $partner_info->account_status; ?></h5>
                        <h5>Licenses : <a href="<?= '../public/uploads/licenses/'. $partner_info->license; ?> ">View</a></h5>
                        <h5>National Document : <a href="<?= '../public/uploads/documents/'. $partner_info->national_document; ?> ">View</a></h5>
                    </div>
                    <form action="" method="post">
                       <?php if($partner_info->account_status == "Under Review") : ?>
                            <input type="submit" value="Approve" name="approve" class="btn btn-success">
                        <?php else : ?>
                            <input type="submit" value="Revoke" name="revoke" class="btn btn-success">
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>