<?php if( basename($_SERVER['SCRIPT_NAME']) == 'ecommerce.php')  : ?>

<title>E-commerce | Delivery service for ecommerce and restaurants</title>

<?php elseif( basename($_SERVER['SCRIPT_NAME']) == 'home.php') : ?>

<title>Home | Delivery service for ecommerce and restaurants</title>

<?php elseif( basename($_SERVER['SCRIPT_NAME']) == 'become-a-partner.php') : ?>

<title>Become A Partner | Delivery service for ecommerce and restaurants</title>

<?php elseif( basename($_SERVER['SCRIPT_NAME']) == 'login.php') : ?>

<title>Login | Delivery service for ecommerce and restaurants</title>

<?php elseif( basename($_SERVER['SCRIPT_NAME']) == 'register.php') : ?>

<title>Merchant Account Registration | Delivery service for ecommerce and restaurants</title>

<?php elseif( basename($_SERVER['SCRIPT_NAME']) == 'register-partner.php') : ?>

<title>Partner Account Registration | Delivery service for ecommerce and restaurants</title>

<?php endif; ?>