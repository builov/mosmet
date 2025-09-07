<?php

namespace Builov\Vertolet\VO;

class EmailSubject
{
    public string $value;

    public function __construct($str)
    {
        $this->value = $this->validate($str);
    }
    public function __toString()
    {
        return $this->value;
    }
    private function validate($str)
    {
        return $str;
    }
}