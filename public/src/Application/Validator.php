<?php

namespace Builov\Vertolet\Application;

class Validator
{
    public function validate($value, $field)
    {
        switch ($field['type']) {
            case 'string':
            case 'text':
                $value = $this->validateString($value, $field);
                break;
            case 'email':
                $value = $this->validateEmail($value, $field);
                break;
            case 'file':
                $value = $this->validateFile($value, $field);
                break;
        }

        return $value;
    }

    private function validateString($value, $field)
    {
        $value = htmlspecialchars($value, ENT_QUOTES);

        if (empty($value)) {
            throw new \Exception("Поле {$field['label']} пустое.");
        }

        return $value;
    }

    private function validateEmail($value, $field)
    {
        if (empty($value)) {
            throw new \Exception("Поле {$field['label']} пустое.");
        }

        if (!($value = filter_var($value, FILTER_VALIDATE_EMAIL))) {
            throw new \Exception("Указан некоррекный email.");
        }

        return $value;
    }

    private function validateFile($value, $field)
    {
        return $value;
    }
}