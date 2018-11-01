<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Member;
use App\Models\Lesson;
use App\Mail\EmailReminderPertama;
use DB;
use Mail;

class ReminderPertama extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminderpertama';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Reminder setelah invoice terbit';

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
        $from = date("Y-m-d H:i:s", strtotime("-4 hours"));
        $to = date("Y-m-d H:i:s");
        $invo = Invoice::with('members')->where('status', 2)->where('created_at', '==', now()->subHours(4)->toDateTimeString())->get();
        // dd($invo);
        // Mail::to($invo->members['email'])->send(new EmailReminderPertama());
        foreach($invo as $inv){
            if($inv != null){
                Mail::to($inv->members['email'])->send(new EmailReminderPertama());
                $this->info('Reminder messages sent successfully!');
            } 
        }
        
        
        
        // $invo = Invoice::select('code', 'created_at as start', DB::raw('DATE_ADD(created_at, INTERVAL 4 HOUR)'))->where('status', 2)->get();
        // foreach($invo as $invoice){
        //     $member = Member::where('id', $invoice->members_id)->first();
        //     $detail = InvoiceDetail::where('invoice_id', $invoice->id)->first();
        //     $lessons = Lesson::where('id', $detail->lesson_id)->get();
        //     Mail::to($member)->send(new EmailReminderPertama($lessons));
        // }
    }
}
