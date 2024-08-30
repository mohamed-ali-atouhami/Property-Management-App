<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DuePaymentNotification;
use App\Models\Payment;
use Carbon\Carbon;
class SendDuePaymentNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-due-payment-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Mail::fake();
        $today = Carbon::today();
        $duePayments = Payment::where('status', false)
                                ->whereDate('due_date', '<=', $today)
                                ->with('tenant.property')
                                ->get();

        foreach ($duePayments as $payment) {
            $tenant = $payment->tenant;
            
            // Send real email
            Mail::to($tenant->email)->send(new DuePaymentNotification($tenant , $payment));

            // Output to console
            $this->info("Email sent to {$tenant->email}");
        }

        $this->info('All due payment notifications have been sent.');
        
    }
}
