<?php

namespace Builov\Vertolet\Application;

use Exception;

class CustomerRequestForm extends EmailForm
{
    private array $fields = [
        'your_name' => [
            'name' => 'your-name',
            'type' => 'string',
            'label' => 'Ваше имя',
            'value' => null
        ],
        'your_email' => [
            'name' => 'your-email',
            'type' => 'email',
            'label' => 'Ваш email',
            'value' => null
        ],
        'your_message' => [
            'name' => 'your-message',
            'type' => 'text',
            'label' => 'Текст сообщения',
            'value' => null
        ],
        'attachment' => [
            'name' => 'attachment',
            'type' => 'file',
            'label' => 'Выберите файл',
            'value' => null
        ]
    ];

    private UploaderInterface $uploader;
    private Validator $validator;

    /**
     * @param EmailerInterface $emailer
     * @param UploaderInterface $uploader
     */
    public function __construct(EmailerInterface $emailer, UploaderInterface $uploader)
    {
        parent::__construct($emailer);
        $this->uploader = $uploader;
    }

    private function setFields()
    {
        $this->validator = new Validator();

        foreach ($this->fields as $key => $field) {

            if (array_key_exists($field['name'], $_POST)) {
                $this->fields[$key]['value'] = $this->validator->validate($_POST[$field['name']], $field);
            }

            if (!empty($_FILES[$field['name']])) {
                $this->fields[$key]['value'] = $_FILES[$field['name']];
            }
        }
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @throws Exception
     */
    public function process(): void      //your_name=&your_email=&your_message=
    {
       try {
           $this->setFields();
       } catch (Exception $e) {
           throw new Exception($e->getMessage());
       }


        $attachment = null;
        if ($this->fields['attachment']['value']) {
            try {
                $attachment = $this->uploader->upload($this->fields['attachment']['value']);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
//                echo "<div class=\"alert alert-danger\">Ошибка загрузки файла: {$e->getMessage()}</div>";
//                exit;
            }
        }

        $this->emailer
            ->setSubject('Форма заявки')
            ->setBody("<p>Имя: {$this->fields['your_name']['value']}</p>
                        <p>Email: {$this->fields['your_email']['value']}</p>
                        <p>Сообщение: {$this->fields['your_message']['value']}</p>")
            ->setAltBody("Имя: {$this->fields['your_name']['value']}; 
                            Email: {$this->fields['your_email']['value']}; 
                            Сообщение: {$this->fields['your_message']['value']}");
        if ($attachment) {
            $this->emailer->setAttachment($attachment);
        }
        try {
            $this->emailer->mail();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
