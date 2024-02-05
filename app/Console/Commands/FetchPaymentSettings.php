<?php

namespace App\Console\Commands;

use App\Helpers\External\ZohoHelper;
use Illuminate\Console\Command;

class FetchPaymentSettings extends Command
{
    protected $signature = 'zoho:fetch-payment-settings';
    protected $description = 'Fetch and cache payment settings for shop from Zoho API';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        (new ZohoHelper()) -> fetchPaymentSettings();
    }
}
