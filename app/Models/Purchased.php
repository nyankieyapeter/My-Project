<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchased extends Model
{
    use HasFactory;

    protected $table = 'purchased_goods';

    protected  $fillable = ['product', 'customer_name', 'attendee','quantity', 'subtotal','store','order_id', 'description'];

    protected $hidden = ['id'];

    public function order() :BelongsTo {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
