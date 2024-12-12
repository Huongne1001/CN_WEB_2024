<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    /**
     * Bảng trong cơ sở dữ liệu mà model này liên kết
     */
    protected $table = 'students'; // Tên bảng trong cơ sở dữ liệu

    /**
     * Các trường có thể được gán giá trị một cách đại trà (Mass Assignable)
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'date_of_birth', 
        'parent_phone', 
        'class_id',
    ];

    /**
     * Định nghĩa quan hệ với model Classes
     */
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
