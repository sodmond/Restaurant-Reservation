<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $bookingInfo;
    public $reference;
    public $fname;
    public $event_space;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bookingInfo, $event_space, $reference)
    {
        $this->bookingInfo = $bookingInfo;
        $this->reference = $reference;
        $this->event_space = $event_space;
        $name = explode(' ', $bookingInfo->name);
        $this->fname = $name[0];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.booking_confirmed')
                    ->subject('Event Booking Confirmation');
    }
}
