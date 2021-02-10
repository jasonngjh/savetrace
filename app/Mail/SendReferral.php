<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Referral;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use DateTime;

class SendReferral extends Mailable
{
    use Queueable, SerializesModels;

    public $referral;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($referral_id)
    {
        $this->referral = Referral::find($referral_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@savetrace.com', 'SaveTrace')
            ->subject('New Referral!')
            ->view('mails.sent_referral');
    }
}
