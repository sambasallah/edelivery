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
                                <!-- <th>Sender Name</th> -->
                                <th>Sender Number</th>
                                <!-- <th>Receipient Name</th> -->
                                <th>Receipt Number</th>
                                <th>Pick Up Date</th>
                                <th>Status</th>
                                <th>Fee (GMD)</th>
                                <th>Cancel</th>
                            </tr>
                        </thead>
                            <tbody>                   
                            <?php foreach($delivery_summary as $delivery) : ?>
                            <tr>
                                    <td><?= $delivery->to_location; ?></td>
                                    <td><?= $delivery->from_location; ?></td>
                                    <td><?= $delivery->sender_mobile_number; ?></td>
                                    <td><?= $delivery->receipient_mobile_number; ?></td>
                                    <td><?= $delivery->pick_up_date; ?></td>
                                    <?php if ($delivery->request_status == "Pending") : ?>
                                        <td style="color: red;"><?= $delivery->request_status; ?></td>
                                    <?php elseif($delivery->request_status == "Delivered") : ?>
                                        <td style="color: #28a745;"><?= $delivery->request_status; ?></td>
                                    <?php else : ?>
                                        <td style="color: #17a2b8;"><?= $delivery->request_status; ?></td>  
                                    <?php endif; ?>
                                    <td><?= $delivery->rate; ?></td>
                                    <td>
                                      <form action="" method="post">
                                            <input type="hidden" value="<?= $delivery->id; ?>" name="request_id">
                                                 <?php if($delivery->request_status == "Pending") : ?>
                                                <input type="submit" value="Cancel" name="cancel_request" class="btn btn-danger">
                                            <?php endif; ?>
                                      </form>
                                      <form action="track" method="post">
                                           <?php if($delivery->request_status == "On Route") : ?>
                                                <input type="submit" value="Track" name="track" class="btn btn-info">
                                                <input type="hidden" value="<?= $delivery->id; ?>" name="delivery_id">
                                           <?php endif; ?>
                                      </form> 
                                      <form action="track" method="post">
                                            <?php if($delivery->request_status == "Delivered") : ?>
                                                <input type="submit" value="Track" name="track" class="btn btn-success">
                                                <input type="hidden" value="<?= $delivery->id; ?>" name="delivery_id">
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
                                <li class="page-item"><a class="page-link" href="summary/<?php if(isset($page) && $page > 1) { echo $page - 1; } else { echo '#'; } ?>">Previous</a></li>
                            <?php endif; ?>
                            <?php for($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item"><a class="page-link" href="summary/<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endfor; ?>
                            <li class="page-item"><a class="page-link" href="summary/<?php if(isset($page) && ($i > $page)) { if($page > $total_pages - 1) { echo $total_pages; } else { echo $page + 1; } } else { echo 2; } ?>">Next</a></li>
                        </ul>
                     <?php endif; ?>
                     <?php endif; ?>
                     
                </div>
            </div> 
        </div>
        </div>
    </div>
<?php require_once('../inc/footer.php'); ?>