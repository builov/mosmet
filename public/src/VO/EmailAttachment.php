<?php

namespace Builov\Vertolet\VO;

class EmailAttachment
{
    public $file;

    public function __construct($file)
    {
        $this->value = $this->validate($file);
    }
    public function __toString()
    {
        return $this->value;
    }
    private function validate($file)
    {
        return $file;
    }
}