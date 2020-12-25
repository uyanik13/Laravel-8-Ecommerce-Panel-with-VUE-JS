<?php

namespace App\Console\Commands;

use App\Subscription;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StoreSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:cron';

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
      Helper::SubscriptionCheckerAndDeleter();
      Helper::DebtCheckerAndSendingNotify();
    }
}
