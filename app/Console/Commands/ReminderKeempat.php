<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Member;
use App\Models\Lesson;
use App\Mail\EmailReminderKeempat;

class ReminderKeempat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminderkeempat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $invo = Invoice::select('code', 'updated_at as start', 'DATE_ADD(updated_at, INTERVAL 1 HOUR) as remind')->where('status', 5)->get();
        foreach($invo as $invoice){
            $member = Member::where('id', $invoice->members_id)->first();
            $detail = InvoiceDetail::where('invoice_id', $invoice->id)->first();
            $lessons = Lesson::where('id', $detail->lesson_id)->get();
            Mail::to($member)->send(new EmailReminderKeempat($lessons));
        }
    }
}
