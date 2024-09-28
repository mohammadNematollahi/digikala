<?php

namespace App\Http\Services\Message\Email;

use Illuminate\Support\Facades\Mail;
use App\Http\Services\Message\Email\MailViewProvider;
use App\Http\Services\Message\Email\Traits\EmailService;

class SendMail
{
    use EmailService;

    public function send()
    {
        Mail::to($this->getTo())->send(new MailViewProvider($this->getDetails() , $this->getSubject() , $this->getFrom()));
        return true;
    }
}