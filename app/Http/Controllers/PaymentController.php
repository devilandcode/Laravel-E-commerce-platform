<?php

namespace App\Http\Controllers;

use App\Models\Banner\Banner;
use Carbon\Carbon;
use Faker\Provider\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function result(Request $request)
    {
        $mrh_pass2 = 'kokokasdfdsdf';

        $out_summ = $request['OutSum'];
        $inv_id = $request['InvId'];
        $shp_item = $request['Shp_item'];
        $crc = $request['SignatureValue'];

        $crc = strtoupper($crc);
        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_item=$shp_item"));

        if ($my_crc !== $crc) {
            return "bad sign\n";
        }

        $banner = Banner::findOrFail($inv_id);
        $banner->pay(Carbon::now());

        return 'OK' . $inv_id;
    }

    public function success()
    {
    }

    public function fail()
    {

    }
}
