<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Models\User;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public  $user, $content;

    public function __construct($content, $user) {
        $this->user = $user;
        $this->content = $content;
    }

    public function build()
    {
        return $this->markdown('mail.forgot')->with([
            'content'   => $this->content,
            'user'      => $this->user,

        ]);
    }
}
