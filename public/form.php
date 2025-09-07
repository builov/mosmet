<?php

use Builov\Vertolet\Emailer;
use Builov\Vertolet\Uploader;
use Builov\Vertolet\CustomerRequestForm;

require 'vendor/autoload.php';
require 'config.php';

$emailer = new Emailer();
$uploader = new Uploader();
$form = new CustomerRequestForm($emailer, $uploader);

if (!empty($_POST)) {
    $form->process();
}

$htmlform = $form->generate();
?>

<html lang="ru">
<body>


<div id="dialog-content" style="display:none;max-width:500px;">
    <h2>Hello, world!</h2>
    <p>
        <input type="text" value="" />
    </p>
    <p>
        Try hitting the tab key and notice how the focus stays within the dialog
        itself.
    </p>
    <p>
        To close dialog hit the esc button, click on the overlay or just click the
        close button.
    </p>
    <p>
        Element used to launch the modal would receive focus back after closing.
    </p>
</div>

<button data-fancybox data-src="#dialog-content">Launch Dialog</button>














<form enctype="multipart/form-data" action="/mail.php" method="post" class="wpcf7-form" novalidate="novalidate">
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <p>
        <label><br />
            <span class="wpcf7-form-control-wrap your-name">
                                                                                <input type="text" name="your-name" id="your-name" value="" size="40"
                                                                                       class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true"
                                                                                       aria-invalid="false" placeholder="Ваше имя" />
                                                                            </span>
        </label>
    </p>
    <p>
        <label><br />
            <span class="wpcf7-form-control-wrap your-email">
                                                                                <input type="email" name="your-email" id="your-email" value="" size="40"
                                                                                       class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                                       aria-required="true" aria-invalid="false" placeholder="Ваш email" />
                                                                            </span>
        </label>
    </p>
    <p>
        <label><br />
            <span class="wpcf7-form-control-wrap your-message">
                                                                                <textarea name="your-message" id="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea"
                                                                                          aria-invalid="false" placeholder="Текст сообщения"></textarea>
                                                                            </span>
        </label>
    </p>
    <p>
        <input name="attachment" id="attachment" type="file" />
    </p>
    <p>
        <input type="submit" value="Отправить" class="wpcf7-form-control wpcf7-submit" />
    </p>
    <div class="wpcf7-response-output wpcf7-display-none"></div>
</form>




<script>












    document.getElementById("wpcf7-form").onsubmit = async (e) => {
        e.preventDefault();

        let data = new FormData(e.target);
        data.append('xhr', 'xhr');

        let response = await fetch('/mail.php', {
            method: 'POST',
            body: data
        });

        let result = await response.text();

        console.log('Ответ: ', result);

        e.target.insertAdjacentHTML('afterbegin', result);
    };
</script>
</body>
</html>
