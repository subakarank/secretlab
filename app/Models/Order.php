<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;
    protected $dateFormat = 'U';
    protected $fillable = ['name', 'value', 'updated_at'];
    protected $casts = [
        'updated_at' => 'datetime',
    ];
    public $timestamps = false;
}
