<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailToNewUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $newUser;
    public function __construct(User $user)
    {
        //
        $this->newUser = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New account request')
            ->from(env('MAIL_FROM_ADDRESS','todayisagooddaytodie.3112@gmail.com'))
            ->markdown('email.send-email-to-new-user')
            ->with([
                'name'  => $this->newUser->last_name,
            ]);
    }
}
