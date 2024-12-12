<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    /**
     * Bảng trong cơ sở dữ liệu mà model này liên kết
     */
    protected $table = 'classes'; // Tên bảng

    /**
     * Các trường có thể được gán giá trị một cách đại trà (Mass Assignable)
     */
    protected $fillable = [
        'grade_level', 
        'room_number',
    ];

    /**
     * Định nghĩa quan hệ với model Student
     */
    public function students()
    {
        return $this->hasMany(Students::class, 'class_id');
    }
}
