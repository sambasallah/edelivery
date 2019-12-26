<?php require_once('../inc/header.php'); ?>

<div class="register_partner">
    <div class="register_partner_container">
        <div class="row">
            <div class="col-md-12">
            <form action="" method="post" id="partnerForm" enctype="multipart/form-data">

                <h1>Become A Partner</h1>
                <?php if(isset($_SESSION['email_exists'])) { echo $_SESSION['email_exists']; } ?>
                <?php if(isset($_SESSION['username_exists'])) { echo $_SESSION['username_exists']; } ?>
                <?php if(isset($_SESSION['error_register'])) { echo $_SESSION['error_register']; } ?>
                <!-- One "tab" for each step in the form: -->
                <div class="tab">
                <p><input placeholder="First name..." oninput="this.className = ''" name="first_name" required></p>
                <p><input placeholder="Last name..." oninput="this.className = ''" name="last_name" required></p>
                </div>

                <div class="tab">
                <p><input placeholder="E-mail..." oninput="this.className = ''" name="email_address" required></p>
                <p><input placeholder="Phone..." oninput="this.className = ''" name="phone_number" required></p>
                <p><input placeholder="Address..." oninput="this.className = ''" name="address" required></p>
                <p>
                    <select name="municipality" id=""  oninput="this.className = ''" required>
                        <option value="Choose">Choose</option>
                        <option value="KMC">Kanifing Municipal Council</option>
                        <option value="BCC">Banjul City Council</option>
                        <option value="BAC">Brikama Area Council</option>
                   </select>
                </p>
                </div>

                <div class="tab">National ID Card / Passport:
                    <p><input type="file" oninput="this.className = ''" name="national_document" required></p>
                </div>

                <div class="tab">Valid Drivers License
                    <p><input type="file"  oninput="this.className = ''" name="valid_drivers_license" required></p>
                </div>
                
                <div class="tab">
                    <p><input placeholder="Username..." oninput="this.className = ''" name="username" required></p>
                    <p><input type="password" placeholder="Password..." oninput="this.className = ''" name="password" required></p>
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
                </div>

            </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>