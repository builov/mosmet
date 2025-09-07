<?php

namespace Builov\Vertolet\Application;

class EmailForm implements FormInterface
{
//    protected EmailAddress $from;
//    protected EmailSubject $subject;
//    protected EmailBody $message;
//    protected EmailAddress $address;

    protected EmailerInterface $emailer;

    public function __construct(EmailerInterface $emailer)
    {
        $this->emailer = $emailer;
    }

    public function generate() {}

    public function process() {}
}
