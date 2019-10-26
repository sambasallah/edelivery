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
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>From</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                                <th>Item Weight</th>
                                <th>Timestamp</th>
                                <th>Status</th>
                                <th>Municipality</th>
                                <th width="15%">Cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bakau</td>
                                    <td>Serekunda</td>
                                    <td>Fridge</td>
                                    <td>GMD20,000</td>
                                    <td>150kg</td>
                                    <td>23:12:02 12/23/2019</td>
                                    <td>Delivered</td>
                                    <td>KMC</td>
                                    <td>
                                        <select name="" id="" class="custom-select">
                                            <option value="choose">Choose</option>
                                            <option value="cancel">Accept</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bakau</td>
                                    <td>Serekunda</td>
                                    <td>Fridge</td>
                                    <td>GMD20,000</td>
                                    <td>150kg</td>
                                    <td>23:12:02 12/23/2019</td>
                                    <td>Delivered</td>
                                    <td>KMC</td>
                                    <td>
                                        <select name="" id="" class="custom-select">
                                        <option value="choose">Choose</option>
                                            <option value="cancel">Accept</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Bakau</td>
                                    <td>Serekunda</td>
                                    <td>Fridge</td>
                                    <td>GMD20,000</td>
                                    <td>150kg</td>
                                    <td>23:12:02 12/23/2019</td>
                                    <td>Delivered</td>
                                    <td>KMC</td>
                                    <td>
                                        <select name="" id="" class="custom-select">
                                        <option value="choose">Choose</option>
                                            <option value="cancel">Accept</option>
                                        </select>
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