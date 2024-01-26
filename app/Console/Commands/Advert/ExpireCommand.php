<?php

namespace App\Console\Commands\Advert;

use App\Models\Adverts\Advert\Advert;
use App\Services\Adverts\AdvertService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advert:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close expired adverts';

    /**
     * Execute the console command.
     */
    public function __construct(
        private AdvertService $service )
    {
        parent::__construct();
    }

    public function handle(): bool
    {
        $success = true;

        foreach (Advert::active()->where('expired_at', '<', Carbon::now())->cursor() as $advert) {
            try {
                $this->service->expire($advert);
            } catch (\DomainException $e) {
                $this->error($e->getMessage());
                $success = false;
            }
        }

        return $success;
    }
}
