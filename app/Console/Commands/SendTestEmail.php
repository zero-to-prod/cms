<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Mail\TestEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestEmail extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_test_email';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a test email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $email = 'dave0016@gmail.com';
        // $subject = 'Test';
        // Mail::send('mail.test', ['<h1>Test email</h1>'], function($message) use ($email, $subject) {
        //     $message->to($email)->subject($subject);
        // });
        Mail::to('confirmation@zero-to-prod.com')->send(new TestEmail());
    }
}
