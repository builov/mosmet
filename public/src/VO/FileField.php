<?php

namespace Builov\Vertolet\VO;

class FileField
{
    /**
     * array(6) {
     *   ["name"] => string(9) "chasi.jpg"
     *   ["full_path"] => string(9) "chasi.jpg"
     *   ["type"] => string(0) ""
     *   ["tmp_name"] => string(0) ""
     *   ["error"] => int(2)
     *   ["size"] => int(0)
     * }
     */
    public array $file;

    public function __construct($file)
    {
        $this->file = $this->validate($file);
    }
    private function validate($file)
    {
        return $file;
    }

}