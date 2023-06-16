<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    public function requestData()
    {
        return $this->belongsTo(RequestData::class);
    }

    public function forecast()
    {
        return $this->hasOne(Forecast::class, 'location_id');
    }
}
