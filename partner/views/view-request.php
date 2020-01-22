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
                            <h5>From : <?= $request_summary->from_location; ?></h5>
                            <h5>To : <?= $request_summary->to_location; ?></h5>
                            <h5>Receipient Name : <?= $request_summary->receipient_name; ?></h5>
                            <h5>Sender Name : <?= $request_summary->sender_name; ?></h5>
                            <h5>Sender Number : <?= $request_summary->sender_mobile_number; ?></h5>
                            <h5>Receipient Number : <?= $request_summary->receipient_mobile_number; ?></h5>
                            <h5>Sender Address : <?= $request_summary->sender_address; ?></h5>
                            <h5>Receipient Address : <?= $request_summary->receipient_address?></h5>
                            <h5>Pick Up Date : <?= $request_summary->pick_up_date; ?></h5>
                            <h5>Package Type : <?= $request_summary->package_type; ?></h5>
                            <h5>Package Size : <?= $request_summary->package_size?></h5>
                            <h5>Delivery Note : <?= $request_summary->delivery_note; ?></h5>
                            <h5>Payment Method : <?= $request_summary->payment_method; ?></h5>
                        </div>
                        <a href="delivery-requests"><button class="btn btn-primary">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require('../inc/footer.php'); ?>