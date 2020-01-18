<?php require('../inc/header.php'); ?>
    <div class="api_doc">
        <div class="api_doc_container">
            <h2>eDelivery API Documentation</h2>
            <hr>
            <h3>Introduction</h3>
            <p>This is an API documentation for eDelivery.</p>
            <h3>Overview</h3>
            <p>The API will allow merchant's to make delivery requests, cancel delivery requests and track their deliveries.</p>
            <h3>Authentication</h3>
            <p>JSON Web Token (JWT) is used to authenticate user's of the API.</p>
            <h3>Error Codes</h3>
            <p>Error code's are shown based on the user actions for example if a user request for a non existing endpoint a JSON error message {"Error" : "Endpoint Not Found"} will be return</p>
            <h3>Rate Limit</h3>
            <p>There is no limit to how many request you can make to the API endpoint's</p>

            <h2>API Endpoints</h2>
            <hr>
            <div class="login">
                <h5><span class="request_method">POST</span> localhost:8000/api/v1/login </h5>
                <div class="route">http://localhost:8000/api/v1/login</div>
                <h6>Login Merchant</h6>

                <pre>
                    <code class="language-json5">
                    HEADERS
                    "Content-Type": "application/json"

                    SAMPLE REQUEST BODY
                    {
                        "usernameOREmail": "sambasallah10@gmail.com",
                        "password": "password1"
                    }

                    SAMPLE RESPONSE
                    {
                        "Login": "Successful",
                        "JWT": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoyNTg3MjU4MjcyLCJleHAiOjE1NzgyNjI3MDUsImlzcyI6ImxvY2FsaG9zdCIsImlhdCI6MTU3ODI1OTEwNX0.2vad2DFiS92SSbiX-335H5WhVM9vVWPJzQCU2ydJcck",
                        "Status Code": 200
                    }
                    </code>
                </pre>
            </div>
            <div class="request">
                <h5><span class="request_method">POST</span> localhost:8000/api/v1/request </h5>
                <div class="route">http://localhost:8000/api/v1/request</div>
                <h6>Make Delivery Request</h6>
                <pre>
                    <code class="language-json5">
                        HEADERS
                        "Content-Type": "application/json"
                        "Authorization" : "jwt-token"

                        {
                            "merchant_username" : "sambasallah",
                            "to" : {
                                "to_location" : "Serrekunda"
                            },
                            "from" : {
                                "from_location" : "Serrekunda"
                            },
                            "data" : {
                                "item_name" : "Laptop",
                                "package_type" : "Electronics",
                                "package_size" : "Medium",
                                "delivery_note" : "Deliver it with care.",
                                "pick_up_date" : "2020/01/30 16:00"
                            },
                            "sender_information" : {
                                "sender_name" : "Ebrima Secka",
                                "sender_mobile_number" : "3925723",
                                "sender_address" : "Latrikunda German"
                            },
                            "receipient_information" : {
                                "receipient_name" : "Kebba Danso",
                                "receipient_mobile_number" : "2837427",
                                "receipient_address" : "Bundung Borehole"
                            }
                        }

                        SAMPLE RESPONSE
                        {
                            "Success": true,
                            "Status Code": 200,
                            "data": "Delivery Request Sent"
                        }

                    </code>
                </pre>
            </div>
            <div class="track">
                <h5><span class="request_method">GET</span> localhost:8000/api/v1/track/{request_id} </h5>
                <div class="route">http://localhost:8000/api/v1/track/{request_id}</div>
                <h6>Track Delivery</h6>

                <pre>
                    <code class="language-json5">
                    HEADERS
                    "Content-Type": "application/json"
                    "Authorization": "jwt-token"

                    SAMPLE REQUEST BODY
                    {
                        "usernameOREmail": "sambasallah10@gmail.com",
                    }

                    SAMPLE RESPONSE
                    {
                        "Success": true,
                        "Status Code": 200,
                        "Delivery Status": "Pending"
                    }
                    </code>
                </pre>
            </div>
            <div class="cancel">
                <h5><span class="request_method">POST</span> localhost:8000/api/v1/cancel/{request_id} </h5>
                <div class="route">http://localhost:8000/api/v1/cancel/{request_id}</div>
                <h6>Cancel Delivery Request</h6>

                <pre>
                    <code class="language-json5">
                    HEADERS
                    "Content-Type": "application/json"
                    "Authorization": "jwt-token"

                    SAMPLE REQUEST BODY
                    {
                        "usernameOREmail": "sambasallah10@gmail.com",
                    }

                    SAMPLE RESPONSE
                    {
                        "Success": true,
                        "data": "Delivery Request Canceled",
                        "Status Code": 200
                    }
                    </code>
                </pre>
            </div>                
        </div>
    </div>
<?php require('../inc/footer.php'); ?>