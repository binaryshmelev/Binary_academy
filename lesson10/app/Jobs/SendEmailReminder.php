<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Book;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;

class SendEmailReminder extends Job implements SelfHandling, ShouldQueue {

    use InteractsWithQueue, SerializesModels;

    protected $book_id;
    protected $user_id;
    protected $email;

    /**
     * Create a new job instance.
     *
     * @param $book_id
     * @param $email
     */
    public function __construct($book_id, $user_id, $email)
    {
        $this->book_id = $book_id;
        $this->user_id = $user_id;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $sender)
    {
        $book = Book::find($this->book_id);

        if ($book->user_id == $this->user_id) {
            $message = 'Reminder. You should return the book ' . $book->title;
            $sender->raw($message, function ($message) {
                $message->from('binarytestssn@gmail.com');
                $message->to($this->email)->subject('Reminder');
            });
        }
    }
}
