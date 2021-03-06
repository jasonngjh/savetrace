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

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@savetrace.com', 'SaveTrace')
            ->subject($this->details['subject'])
            ->view('mails.sent_referral');
    }
}
