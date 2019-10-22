<?php require_once('../inc/header.php'); ?>

<div class="register_partner">
    <div class="register_partner_container">
        <div class="row">
            <div class="col-md-12">
            <form id="regForm" action="" method="post">

                <h1>Become A Partner</h1>

                <!-- One "tab" for each step in the form: -->
                <div class="tab">
                <p><input placeholder="First name..." oninput="this.className = ''"></p>
                <p><input placeholder="Last name..." oninput="this.className = ''"></p>
                </div>

                <div class="tab">
                <p><input placeholder="E-mail..." oninput="this.className = ''"></p>
                <p><input placeholder="Phone..." oninput="this.className = ''"></p>
                <p><input placeholder="Address..." oninput="this.className = ''"></p>
                </div>

                <div class="tab">
                <p><input type="date" placeholder="Date Of Birth" oninput="this.className = ''"></p>
                </div>

                <div class="tab">National ID Card / Passport:
                    <p><input type="file" oninput="this.className = ''"></p>
                </div>

                <div class="tab">Valid Drivers License
                    <p><input type="file"  oninput="this.className = ''"></p>
                </div>
                
                <div class="tab">
                    <p><input placeholder="Username..." oninput="this.className = ''"></p>
                    <p><input type="password" placeholder="Password..." oninput="this.className = ''"></p>
                </div>

                <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-lg previous">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-lg next">Next</button>
                </div>
                </div>

                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>

            </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>