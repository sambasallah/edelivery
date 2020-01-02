
<?php

// Database Host
putenv("DB_HOST=localhost");

// Database Username
putenv("DB_USERNAME=root");

// Database Password 
putenv("DB_PASSWORD=");

// Database Name
putenv("DB_NAME=edelivery");


define("DB_HOST",getenv("DB_HOST"));
define("DB_USERNAME",getenv("DB_USERNAME"));
define("DB_PASSWORD",getenv("DB_PASSWORD"));
define("DB_NAME",getenv("DB_NAME"));

