<?php require_once('../inc/header.php'); ?>

<div class="delivery_requests">
    <div class="delivery_requests_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9">
                     
                <div class="right">
                <h3>Delivery Requests</h3> 
                <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>From</th>
                                <th>Sender Name</th>
                                <th>Receipt Name</th>
                                <th>Sender Number</th>
                                <th>Receipt Number</th>
                                <th>Item Name</th>
                                <th width="15%">A/R</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Serrekunda</td>
                                    <td>Banjul</td>
                                    <td>Lamin Manneh</td>
                                    <td>Samba Sallah</td>
                                    <td>+2203911176</td>
                                    <td>+2203929525</td>
                                    <td>Bed Set</td>
                                    <td>
                                        <i class="fa fa-check"></i> <i class="fa fa-times"></i>
                                    </td>
                                </tr>

                            </tbody>
                     </table>
                     <ul class="pagination justify-content-center">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>