<?php require_once('../inc/header.php'); ?>
    <div class="summary">
        <div class="summary_container">
            <div class="row">
                <div class="col-md-3">
                    <?php require_once('../inc/sidenav.php'); ?>
                </div>
                <div class="col-md-9">
                   <div class="right_summary">
                   <h2>Delivery Requests</h2>
                   <?php if(isset($_SESSION['canceled_request'])) { echo $_SESSION['canceled_request']; }?>
                   <?php if(isset($_SESSION['request_cancel_error'])) { echo $_SESSION['request_cancel_error']; }?>
                    <?php if(empty($delivery_summary)) : ?>
                        <h4>No Delivery Request Made</h4>
                    <?php else : ?>
                     <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>From</th>
                                <th>Sender Name</th>
                                <th>Sender Number</th>
                                <th>Receipient Name</th>
                                <th>Receipient Number</th>
                                <th>Item Name</th>
                                <th>Status</th>
                                <th>Fee (GMD)</th>
                                <th>Cancel Request</th>
                            </tr>
                        </thead>
                            <tbody>                         
                            <?php foreach($delivery_summary as $delivery) : ?>
                            <tr>
                                    <td><?= $delivery->to_location; ?></td>
                                    <td><?= $delivery->from_location; ?></td>
                                    <td><?= $delivery->sender_name; ?></td>
                                    <td><?= $delivery->sender_mobile_number; ?></td>
                                    <td><?= $delivery->receipient_name; ?></td>
                                    <td><?= $delivery->receipient_mobile_number; ?></td>
                                    <td><?= $delivery->item_name; ?></td>
                                    <?php if ($delivery->request_status == "Pending") : ?>
                                        <td style="color: red;"><?= $delivery->request_status; ?></td>
                                    <?php elseif($delivery->request_status == "Delivered") : ?>
                                        <td style="color: #28a745;"><?= $delivery->request_status; ?></td>
                                    <?php else : ?>
                                        <td style="color: #17a2b8;"><?= $delivery->request_status; ?></td>  
                                    <?php endif; ?>
                                    <td><?= $delivery->rate; ?></td>
                                    <td>
                                      <form action="track" method="post">
                                            <input type="hidden" value="<?= $delivery->id; ?>" name="request_id">
                                            <?php if($delivery->request_status == "Pending") : ?>
                                                <input type="submit" value="Cancel" name="cancel_request" class="btn btn-danger">
                                            <?php elseif($delivery->request_status == "Delivered") : ?>
                                                <input type="submit" value="Track" name="track" class="btn btn-success">
                                                <input type="hidden" value="<?= $delivery->id; ?>" name="delivery_id">
                                            <?php else : ?>
                                                <input type="submit" value="Track" name="track" class="btn btn-info">
                                                <input type="hidden" value="<?= $delivery->id; ?>" name="delivery_id">
                                            <?php endif; ?>
                                      </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                     </table>
                     <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                     <?php endif; ?>
                     
                </div>
            </div> 
        </div>
        </div>
    </div>
<?php require_once('../inc/footer.php'); ?>