<?php require('../inc/header.php'); ?>
    <div class="view_request">
        <div class="view_request_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9 right">
                    <div class="summary">
                        <h2>Request Summary</h2>
                        <div class="details">
                            <h4>To : <?= $request_summary->to_location; ?></h4>
                            <h4>From : <?= $request_summary->from_location; ?></h4>
                            <h4>Receipient Name : <?= $request_summary->receipient_name; ?></h4>
                            <h4>Sender Name : <?= $request_summary->sender_name; ?></h4>
                            <h4>Sender Number : <?= $request_summary->sender_mobile_number; ?></h4>
                            <h4>Receipient Number : <?= $request_summary->receipient_mobile_number; ?></h4>
                            <h4>Sender Address : <?= $request_summary->sender_address; ?></h4>
                            <h4>Receipient Address : <?= $request_summary->receipient_address?></h4>
                            <h4>Pick Up Date : <?= $request_summary->pick_up_date; ?></h4>
                            <h4>Package Type : <?= $request_summary->package_type; ?></h4>
                            <h4>Package Size : <?= $request_summary->package_size?></h4>
                            <h4>Delivery Note : <?= $request_summary->delivery_note; ?></h4>
                            <h4>Payment Method : <?= $request_summary->payment_method; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>