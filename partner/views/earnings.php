<?php require_once('../inc/header.php'); ?>

<div class="earnings_summary">
    <div class="earnings_summary_container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('../inc/sidenav.php'); ?>
            </div>
            <div class="col-md-9"> 
                <div class="right_earnings">
                <h3>Earnings Summary</h3> 
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>To</th>
                                <th>From</th>
                                <th>Item Name</th>
                                <th>Item Price</th>
                                <th>Delivery Fee</th>
                                <th>Earned (15%)</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bakau</td>
                                    <td>Serekunda</td>
                                    <td>Fridge</td>
                                    <td>GMD20,000</td>
                                    <td>GMD1000</td>
                                    <td>GMD150</td>
                                </tr>
                                <tr>
                                    <td>Bakau</td>
                                    <td>Serekunda</td>
                                    <td>Fridge</td>
                                    <td>GMD20,000</td>
                                    <td>GMD1000</td>
                                    <td>GMD150</td>
                                </tr>
                                <tr>
                                    <td>Bakau</td>
                                    <td>Serekunda</td>
                                    <td>Fridge</td>
                                    <td>GMD20,000</td>
                                    <td>GMD1000</td>
                                    <td>GMD150</td>
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