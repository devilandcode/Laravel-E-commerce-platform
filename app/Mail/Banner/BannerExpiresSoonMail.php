<?php

namespace App\Mail\Banner;

use App\Models\Banner\Banner;
use App\Models\User\User;
use Illuminate\Queue\SerializesModels;

class BannerExpiresSoonMail extends \Illuminate\Mail\Mailable
{
    use SerializesModels;

    public function __construct(public Banner $banner)
    {
    }

    public function build()
    {
        return $this
            ->subject('Banner Expire soon')
            ->markdown('banner');
    }

}
