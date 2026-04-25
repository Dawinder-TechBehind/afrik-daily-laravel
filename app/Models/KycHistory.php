<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KycHistory extends Model
{
    protected $guarded = ['id'];

    public function kycDetail()
    {
        return $this->belongsTo(KycDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
