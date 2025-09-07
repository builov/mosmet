<?php

//todo:
// fluent interface
// проверить на magic values
// VO
// DRY, KISS, YAGNI
// параметры и возвраты функций
// исключения
// I: Emailer, Uploader
// App: Form

use Builov\Vertolet\Application\CustomerRequestForm;
use Builov\Vertolet\Infrastructure\Emailer;
use Builov\Vertolet\Infrastructure\Uploader;

require './vendor/autoload.php';
require 'config.php';

$emailer = new Emailer();
$uploader = new Uploader();
$form = new CustomerRequestForm($emailer, $uploader);

if (!empty($_POST)) {
    try {
        $form->process();
    } catch (Exception $e) {
        echo "<div class=\"alert alert-danger\">{$e->getMessage()}</div>";
        exit;
    }
    echo '<div class="alert alert-success">Сообщение успешно отправлено.</div>';
    exit;
}

$form_fields = $form->getFields();

require 'src/views/page.php';
