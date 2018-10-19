<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Member;
use App\Models\Lesson;
use App\Mail\EmailReminderPertama;

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
        $invo = Invoice::select('id', 'code', 'members_id', 'created_at as start', DB::raw('DATE_ADD(created_at, INTERVAL 4 HOUR) as remind'))->where('status', 1)->get();
        foreach($invo as $inv){
            $member = Member::where('id', $inv->members_id)->first();
            Mail::to($member->email)->send(new EmailReminderPertama($lessons));
        }
        
        
        // $invo = Invoice::select('code', 'created_at as start', 'DATE_ADD(created_at, INTERVAL 4 HOUR) as remind')->where('status', 1)->get();
        // foreach($invo as $invoice){
        //     $member = Member::where('id', $invoice->members_id)->first();
        //     $detail = InvoiceDetail::where('invoice_id', $invoice->id)->first();
        //     $lessons = Lesson::where('id', $detail->lesson_id)->get();
        //     Mail::to($member)->send(new EmailReminderPertama($lessons));
        // }
    }
}
