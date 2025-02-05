<?php

namespace App\Console\Commands;

use App\Models\Member;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpcomingRenewalMail;
use Carbon\Carbon;

class SendRenewalReminder extends Command
{
    protected $signature = 'renewals:send';
    protected $description = 'Send an email reminder for upcoming membership renewals';

    public function handle()
    {
        $today = Carbon::today();
        $nextWeek = Carbon::today()->addDays(7);
        $count = Member::whereBetween('end_date', [$today, $nextWeek])->count();

        if ($count > 0) {
            Mail::to('admin@example.com')->send(new UpcomingRenewalMail($count));
            $this->info('Renewal email sent successfully.');
        } else {
            $this->info('No upcoming renewals.');
        }
    }
}
