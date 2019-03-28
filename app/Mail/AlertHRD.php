<?php

namespace App\Mail;

use App\Repositories\ApplicationRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertHRD extends Mailable
{
    use Queueable, SerializesModels;

    public $application;


    /**
     * Create a new message instance.
     *
     * @param $application
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $app = $this->application;
        $rep = new ApplicationRepository();
        $addictions = $rep->getAllAddictionsByAppId($app->id);
        return $this->view('mails.alerthrd', compact('app', 'addictions'));

    }
}
