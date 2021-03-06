<?php require_once('../inc/header.php'); ?>
    <div class="generate_api">
        <div class="generate_api_container">
            <div class="row">
                <div class="col-md-3 col-sm">
                    <?php require_once('../inc/sidenav.php'); ?>
                </div> 
                <div class="col-md-9">
                    <div class="right_api">
                        <h2>Generate JWT</h2>
                        <form action="" method="post">
                             <input type="submit" value="Generate Key" class="btn btn-lg btn-success">
                             <?php if(!empty($jwt)) { 
                                 echo "<pre>
                                <code class='language-json5'>
                                    $jwt
                                </code>
                                </pre>"; } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('../inc/footer.php'); ?>