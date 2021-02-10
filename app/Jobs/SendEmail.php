<?php

namespace App\Jobs;

use App\Mail\SendPatientNotification;
use App\Mail\SendReferral;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //logic to send what email
        if ($this->details['type'] === 'referral') {
            $email = new SendReferral($this->details['id']);
        } else {
            $email = new SendPatientNotification($this->details);
        }

        Mail::to($this->details['receipient'])->send($email);
    }
}
