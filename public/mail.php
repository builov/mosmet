<?php

use Builov\Vertolet\CustomerRequestForm;
use Builov\Vertolet\Emailer;
use Builov\Vertolet\Uploader;

require 'vendor/autoload.php';
require 'config.php';

$emailer = new Emailer();
$uploader = new Uploader();
$form = new CustomerRequestForm($emailer, $uploader);

if (!empty($_POST)) {
    $form->process();
}

//print_r($_POST);


