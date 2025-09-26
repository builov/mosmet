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
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require '../vendor/autoload.php';
require 'config.php';

/**
 * Twig setup
 */
$loader = new FilesystemLoader('/var/www/project/public/templates');
$twig = new Environment($loader, [
    'cache' => false, // '/var/www/project/public/compilation_cache',
]);

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

$response = $twig->render('index.html.twig', ['form_fields' => $form_fields]);

header("HTTP/1.1 200 OK");
header("Content-Type: text/html; charset=utf-8");
print $response;

//require 'src/views/page.php';
