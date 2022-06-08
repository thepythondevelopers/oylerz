<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VendorBookingAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf_path,$b,$b_service,$b_garage,$vendor)
    {
        $this->booking = $b;
        $this->b_service = $b_service;
        $this->b_garage = $b_garage;
        $this->vendor = $vendor;
        $this->pdf_path = $pdf_path;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

         return $this->view('emails.vendor_booking_alert')
                    ->subject('Booking Details')
                    ->attach($this->pdf_path)  
                     ->with([
                        'booking' => $this->booking,
                        'b_service' => $this->b_service,
                        'b_garage' => $this->b_garage,
                        'vendor' => $this->vendor
                    ]);
    }
}
