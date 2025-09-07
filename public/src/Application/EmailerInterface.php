<?php

namespace Builov\Vertolet\Application;

interface EmailerInterface
{
    public function setSubject($str);

    public function setBody($str);

    public function setAltBody($str);

    public function setAttachment($path);

    public function mail();
}
