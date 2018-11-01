<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Member;
use App\Models\Lesson;
use App\Mail\EmailReminderKetiga;
use DB;
use Mail;

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
        $invo = Invoice::with('members')->where('status', 2)->where('created_at', '==', now()->subHours(23)->toDateTimeString())->get();
        // dd($invo);
        // Mail::to($invo->members['email'])->send(new EmailReminderPertama());
            foreach($invo as $inv){
                if($inv != null){
                    Mail::to($inv->members['email'])->send(new EmailReminderKetiga());
                } 
            }
            $this->info('Reminder messages sent successfully!');
    }
}
