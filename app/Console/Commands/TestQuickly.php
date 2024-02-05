<?php

namespace App\Console\Commands;

use App\Helpers\PaymentSettings;
use Illuminate\Console\Command;

class TestQuickly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-quickly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used for quickly testing stuff during development';

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
     * @return void
     */
    public function handle()
    {
        //
    }
}
