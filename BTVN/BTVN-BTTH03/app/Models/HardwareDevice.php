<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HardwareDevice extends Model
{
    use HasFactory;

    public function center()
    {
        return $this->belongsTo(ITCenter::class);
    }    
}
