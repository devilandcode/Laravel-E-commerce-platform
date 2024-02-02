<?php

namespace App\Console\Commands\Banner;

use App\Mail\Banner\BannerExpiresSoonMail;
use App\Models\Banner\Banner;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Predis\Client;

class ExpireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'banner:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(private Client $redis)
    {
        parent::__construct();
    }

    public function handle(): bool
    {
        $success = true;

        foreach (Banner::active()->whereRaw('`limit` - views < 100')->with('user')->cursor() as $banner) {
            $key = 'banner_notify_' . $banner->id;
            if ($this->redis->get($key)) {
                continue;
            }
            Mail::to($banner->user->email)->queue(new BannerExpiresSoonMail($banner));
            $this->redis->set($key, true, 900000);
        }

        return $success;
    }
}
