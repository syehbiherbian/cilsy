<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Member;
use App\Models\Lesson;
use App\Mail\EmailReminderKetiga;

class ReminderKetiga extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminderketiga';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command keempat';

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
        $invo = $invo = Invoice::where('status', 2, DB::raw('DATE_ADD(created_at, INTERVAL 23 HOUR)'))->get();
        foreach($invo as $inv){
            Mail::to($inv->members->email)->send(new EmailReminderKetiga($lessons));
        }
        $this->info('Reminder messages sent successfully!');
    }
}
