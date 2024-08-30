<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Tenant;
use App\Models\Payment;
class DuePaymentNotification extends Mailable
{
   
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $tenant;
    public $dueDate;
    public function __construct(Tenant $tenant , Payment $payment)
    {
        $this->tenant = $tenant;
        $this->dueDate = $payment->due_date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Due Payment Reminder',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.due-payment-notification',
            with: [
                'tenantName' => $this->tenant->name,
                'property' => $this->tenant->property->name,
                'dueDate' => $this->dueDate,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
    
}
