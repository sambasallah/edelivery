<?php require_once('../inc/header.php'); ?>

<div class="login">
    <div class="login_container">
        <div class="login_form">
        <!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#merchant">Merchant</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#partner">Partner</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active container" id="merchant">
  <h5>Merchant Login</h5>
        <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Username or Email">
            <input type="password" class="form-control" placeholder="Password">
            <input type="submit" value="login" class="btn btn-success">
        </form>
        <p><a href="#">Forgot Password?</a></p>
        <p>Don't Have an Account? <a href="register">Sign Up</a></p>
  </div>
  <div class="tab-pane container" id="partner">
  <h5>Partner Login</h5>
        <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Username or Email">
            <input type="password" class="form-control" placeholder="Password">
            <input type="submit" value="login" class="btn btn-success">
        </form>
        <p><a href="#">Forgot Password?</a></p>
        <p>Don't Have an Account? <a href="register-partner">Sign Up</a></p>
  </div>
</div>
        </div>


        
    </div>
</div>

<?php require_once('../inc/footer.php'); ?>