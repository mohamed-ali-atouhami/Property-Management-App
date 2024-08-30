<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\DuePaymentNotification;
use App\Models\Payment;
use App\Models\Tenant;
use Carbon\Carbon;

class Sent_Automated_NotificationTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function it_sends_due_payment_notifications()
    {
        Mail::fake();

        $tenant = Tenant::factory()->create();
        Payment::create([
            'tenant_id' => $tenant->id,
            'date_paid' =>"2024-07-25",
            'status' => false,
            'due_date' => Carbon::yesterday(),
            
        ]);

        $this->artisan('app:send-due-payment-notifications');

        Mail::assertSent(DuePaymentNotification::class, function ($mail) use ($tenant) {
            return $mail->hasTo($tenant->email);
        });
    }
}
