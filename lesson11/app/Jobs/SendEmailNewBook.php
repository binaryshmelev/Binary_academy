<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;

class SendEmailNewBook extends Job implements SelfHandling, ShouldQueue {

use InteractsWithQueue, SerializesModels;

    protected $email;
    protected $message;
    protected $subject;
    /**
     * Create a new job instance.
     *
     */
    public function __construct($email, $message, $subject)
    {
        $this->email = $email;
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $sender)
    {
        $sender->raw($this->message, function($message) {
            $message->from('binarytestssn@gmail.com');
            $message->to($this->email)->subject($this->subject);
        });
    }
}
