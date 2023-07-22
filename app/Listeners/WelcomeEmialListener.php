<?php

namespace App\Listeners;
// use App\Events\WelcomeEmail;
use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;


class WelcomeEmialListener implements ShouldQueue
{   
    public $queue = 'listener';
    /**
     * Create the event listener.
     *
     * @return void
     */
    
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        
        //
        $requestData= $event->requestData;
        $emailData = [
            'subject' => 'Welcome Test',
            'body' => 'Thanks For Register With Us.',
            'tagline' => 'Learn Any Thing'
        ];
        Mail::to((string)$requestData->email)
        ->send(new WelcomeEmail($emailData));
    }
}
