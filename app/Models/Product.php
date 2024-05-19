<?php

namespace App\Models;

use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name',
        'store_id',
        'description',
        'cost_price',
        'selling_price',
        'quantity',
        'manufacturing_date',
        'expiry_date',
        'status'];

    protected $hidden = ['id'];

    protected $table = 'products';

    public function store() :BelongsTo {
        return $this->belongsTo(Store::class);
    }

}
