<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'address_line_1',
        'city',
        'postal_code',
        'country',
        'phone_number',
        'is_default'
    ];

    public function User()  {
        return $this->belongsTo(User::class);
    }

    public function Order() {
        return $this->hasMany(Order::class, 'user_address_id');
    }
}
