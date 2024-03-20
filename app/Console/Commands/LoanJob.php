<?php

namespace App\Console\Commands;

use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LoanJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:loan-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Repayment loan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $loans = Loan::where('next_payment_date',Carbon::now()->format('Y-m-d'))->get();
        foreach ($loans as $loan) {
            // Ready for repayment
            $loan->update([
                'next_payment_date' => Carbon::now()->addDays($loan->terms)
            ]);        
        }
    }
}
