<?php 

require_once('../config/init_.php');

use edelivery\template\Template;
use edelivery\helpers\Functions;

$helper_functions = new Functions();

if($helper_functions->isMerchantLoggedIn()) {

    $helper_functions = new Functions();

    $template = new Template('views/generate-api.php');

    if($helper_functions->isPost()) {
        $url = 'http://localhost:8000/api/v1/internal/login';

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json",
                'method'  => 'GET'
            )
        );
        $context  = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);
        if ($result === FALSE) { 
            $template->error = "
            <pre>
            <code class='language-json5'>
            
            {'Error': 'No connection could be made because the target machine actively refused it.'}</code>
            
            </pre>";
         }

        $template->data = $result;
    }

    echo $template;
}else {
    header("location:../register");
}