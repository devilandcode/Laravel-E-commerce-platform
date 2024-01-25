<?php

namespace App\Models\Adverts\Advert;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $table = 'advert_advert_values';

    public $timestamps = false;

    protected $fillable = ['attribute_id', 'value'];
}
