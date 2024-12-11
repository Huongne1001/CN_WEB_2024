<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITCenter extends Model
{
    use HasFactory;

    public function hardwareDevices()
    {
        return $this->hasMany(HardwareDevice::class);
    }   
    
    protected $table = 'it_centers';
}
