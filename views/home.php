<?php require_once('../inc/header.php'); ?>

<!-- carousel --> 
<div id="myCarousel" class="carousel slide" data-ride="carousel">
		 <ol class="carousel-indicators">
		    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            
  		</ol>
		  <div class="carousel-inner text-center">
		    <div class="carousel-item active">
		      <img class="d-block w-100 img-responsive" src="media/images/banner1.png" alt="First slide">
		      <div class="text-content responsive">
                <h1>The Delivery Solution <br> For Your <br> Business</h1>
                <a href="register" class="btn_custom">GET STARTED</a>
            </div>
		    </div>
		    <div class="carousel-item">
		      <img class="d-block w-100" src="media/images/banner2.jpg" alt="Second slide">
		       <div class="text-content">
                <h1>Get All Your Packages <br> Safely Delivered </h1>
                <a href="register" class="btn_custom">GET STARTED</a>
            </div>
            </div>
		    </div>
		    </div>
		  </div>
		  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
    </div>
    
    <!-- become a partner -->
    <div class="become_a_partner">
        <div class="become_a_partner_container">
            <div class="row">
                <div class="col-md-6 left_become_partner">
                    <h2 class="partner_title">Got A Vehicle?</h2>
                    <a href="become-a-partner" class="btn_custom">Become A Partner</a>
                </div>
                <div class="col-md-6 right_become_partner">
                    <img src="media/images/become-a-partner.png" alt="Become A Partner">
                </div>
            </div>
        </div>
    </div>

    <!-- grow business --> 
    <div class="grow_business">
        <div class="grow_business_container">
            <div class="row">
                <div class="col-md-6 left_grow_business">
                    <h2 class="grow_business_title">Grow Your Business With eDelivery</h2>
                    <p>Logistics is fundamental to the success of a business. Whether you run an online shop or a manufacturing business, eDelivery is the preferred logistics platform for helping you grow your business.</p>
                    <a href="ecommerce" class="btn_custom">Learn More</a>
                </div>
                <div class="col-md-6 right_grow">
                    <a href="ecommerce">
                    <div class="card">
                        <img src="media/images/ecommerce.png" alt="eCommerce" style="object-fit:cover; height: 200px; border-radius: 5px 5px 0px 0px;">
                        <div class="card-body">
                            <h2>E-Commerce</h2>
                            <p>
                                Focus on your core business and let us handle the stress of deliveries. eDelivery is the platform for e-commerce door-to-door deliveries.
                            </p>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div> 
    </div>

    <!-- Features -->
    <div class="features">
        <div class="features_container">
            <div class="row">
                <div class="col-md-4">
                    <h2><img src="media/images/clock.svg" alt="Timely Delivery" width="200px" height="200px"></h2>
                    <h4>Deliver anywhere. Anytime.</h4>
                    <p>Push a button and a driver will come to you in less than an hour. Whenever you’re delivering goods to your customers, bank on eDelivery to deliver on a bike, van or a truck.</p>
                </div>
                <div class="col-md-4">
                    <h2>
                        <i class="fa fa-thumbs-up"></i>
                        <span class='badge badge-warning' id='lblCartCount'> GMD </span>
                    </h2>
                    <h4>Reduce costs</h4>
                    <p>Manage all your deliveries from one spot, where you can see spending, access reporting tools, and save on logistics costs</p>
                </div>
                <div class="col-md-4">
                    <h2><img src="media/images/protected.svg" alt="Goods Protected" width="200px" height="200px"></h2>
                    <h4>Your goods are protected</h4>
                    <p>Each eDelivery - delivery is backed by an insurance policy from the moment your goods are in our hands.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- calculate price -->
    <div class="calc_price">
        <div class="calc_price_container">
            <div class="row">
                <div class="col-md-12">
                <h2 class="price_estimate">Get A Price Estimate</h2>
                    <div class="calc_price_container">
                        <select name="pick_up_location" id="pick_up_location">
                            <option value="Enter Pick Up Location">Select Pick Up Location</option>
                            <option value="Serrekunda">Serrekunda</option>
                            <option value="Banjul">Banjul</option>
                        </select>
                        <select name="delivery_location" id="delivery_location">
                            <option value="Enter Delivery Location">Select Delivery Location</option>
                            <option value="Serrekunda">Serrekunda</option>
                            <option value="Banjul">Banjul</option>
                        </select>
                        <span class="estimate">Estimate</span>
                        <span id="delivery_cost" style="color:#fff;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="separator"></div> -->

    <!-- how it works -->
    <div class="how_it_works">
        <div class="how_it_works_container">
        <h2 class="how_title">How it Works</h2>
            <div class="row">
                <div class="col-md-4 col-sm">
                    <h2><i class="fa fa-map-marker"></i></h2>
                    <h4>Pick A Location</h4>
                </div>
                <div class="col-md-4 col-sm">
                    <h2><i class="fa fa-calendar-plus"></i></h2>
                    <h4>Book A Delivery</h4>
                </div>
                <div class="col-md-4 col-sm">
                    <h2><i class="fa fa-tachometer-alt"></i></h2>
                    <h4>Track Your Driver</h4>
                </div>
            </div>
        </div>
    </div>

   
<?php require_once('../inc/footer.php'); ?>