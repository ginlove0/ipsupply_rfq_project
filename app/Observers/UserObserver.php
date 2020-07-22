<?php

namespace App\Observers;

use App\Mail\SendEmailToNewUser;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    //
    public function created(User $userWtb)
    {
        Log::info($userWtb ,['hello']);
        Log::stack(['single'])->info('Sending email invitation to '. $userWtb->email);
        Mail::to($userWtb->email)->queue(new SendEmailToNewUser($userWtb));
    }
}
