<?php

namespace Builov\Vertolet\VO;

class EmailAddress
{
    public string $value;

    public function __construct($email)
    {
        $this->value = $this->validate($email);
    }
    public function __toString()
    {
        return $this->value;
    }
    private function validate($email)
    {
        return $email;
    }
}
