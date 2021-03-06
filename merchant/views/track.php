<?php if(!isset($delivery_id)) { \header("location:summary"); } ?>
<?php require_once('../inc/header.php'); ?>
    <div class="track">
        <div class="track_container">
            <div class="row">
                <div class="col-md-3"><?php require_once('../inc/sidenav.php'); ?></div>
                <div class="col-md-9 right">
                    <h2>Package Information</h2>
                    <div class="tracking_data">
                        <ul>
                            <li><i class="fa fa-gift"></i>
                            <span class="track_package">Package</span>     
                        </li>
                            <?php if($delivery_information->request_status === "On Route" || $delivery_information->request_status === "Delivered") : ?>
                                <li><i class="fa fa-truck color_route"></i>
                                    <span>On Route</span>
                                </li>
                            <?php else : ?>
                                <li><i class="fa fa-truck"></i>
                                    <span>On Route</span>
                                </li>
                            <?php endif; ?>
                            <?php if($delivery_information->request_status === "Delivered") : ?>
                                <li><i class="fa fa-box-open color_delivered"></i>
                                    <span>Delivered</span>
                                </li>
                            <?php else : ?>
                                <li><i class="fa fa-box-open"></i>
                                    <span>Delivered</span>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <h2>Your Driver's Information</h2>
                    <div class="driver_data">
                        <ul>
                            <li><h4>Full Name : <?= $delivery_information->first_name . ' ' . $delivery_information->last_name; ?></h4></li>
                            <li><h4>Mobile Number : <?= $delivery_information->phone_number; ?></h4></li>
                            <li><h4>Driver Status : <?= $delivery_information->account_status; ?></h4></li>
                            <li><h4>Estimated Arrival Time : <?= $delivery_information->arrival_time; ?></h4></li>
                            <li><h4>Vehicle Type : <?= $delivery_information->vehicle_type; ?></h4></li>
                            <?php if(!empty($delivery_information->profile_picture)) : ?>
                                <li><h4><img src="../storage/public/uploads/profile/<?= $delivery_information->profile_picture; ?>" alt="Partner Profile" width="100px" height="100px" style="object-fit:cover; border-radius: 25px;"></h4></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                   <?php if($delivery_information->received == "Yes") : ?>
                        <div class="acknowledge_delivery">
                            <h2>Acknowledge Delivery</h2>
                            <form action="" method="post">
                                <input type="submit" value="received" class="btn btn-success" disabled>
                                <input type="submit" value="not received" class="btn btn-danger" disabled>
                            </form>
                        </div>
                   <?php else :  ?>
                        <div class="acknowledge_delivery">
                            <h2>Acknowledge Delivery</h2>
                            <form action="" method="post">
                                <input type="submit" value="received" class="btn btn-success" name="received">
                                <input type="hidden" value="<?= $delivery_information->id; ?>" name="request_id">
                                <input type="hidden" value="<?= $delivery_information->partner_id; ?>" name="partner_id">
                                <input type="submit" value="not received" class="btn btn-danger" name="not_received">
                            </form>
                        </div>
                   <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../inc/footer.php'); ?>