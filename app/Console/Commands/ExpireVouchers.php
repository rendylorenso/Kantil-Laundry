<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Voucher;

class ExpireVouchers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expiredVouchers = Voucher::where('expired_at', '<=', now())->get();

        foreach ($expiredVouchers as $voucher) {
            $voucher->delete(); // Soft delete
        }

        $this->info("Expired vouchers have been soft deleted.");
    }
}
