<?php

namespace Builov\Vertolet\VO;

class EmailBody
{
    public string $value;

    public function __construct($text)
    {
        $this->value = $this->validate($text);
    }
    public function __toString()
    {
        return $this->value;
    }
    private function validate($text)
    {
        return $text;
    }
}
