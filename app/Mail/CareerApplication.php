<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CareerApplication extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
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
        $subject = "Lamaran Baru - " . $this->details['position'];
        
        $mail = $this->subject($subject)
                    ->view('emails.career-application', [
                        'details' => $this->details
                    ]);
        
        // Lampirkan CV
        if (isset($this->details['cv_path'])) {
            $mail->attach(storage_path('app/public/' . $this->details['cv_path']), [
                'as' => 'CV_' . $this->details['name'] . '.pdf',
                'mime' => 'application/pdf',
            ]);
        }
        
        return $mail;
    }
}
