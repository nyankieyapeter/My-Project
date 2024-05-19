<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_invoice',
        'customer_name',
        'customer_phone',
        'attendee',
        'total_amount',
        'status',
        'store_id',
        'method',
    ];

    public function scopeSales($query, $period)
    {

        $storeMapping = [
            'cafa' => 'GATAKA SUPERMARKET',
            'cafb' => 'Canteen B',
        ];

        $storeName = $storeMapping[session('selected_store')];

        if ($period === 'current_month') {
            return $query->whereMonth('created_at', now()->month)
                ->whereHas('store', function (Builder $query) use ($storeName) {
                    $query->where('store_name', $storeName);
                });
        } elseif ($period === 'last_3_months') {
            return $query->whereBetween('created_at', [now()->subMonths(2)->startOfMonth(), now()->endOfMonth()])
                ->whereHas('store', function (Builder $query) use ($storeName) {
                    $query->where('store_name', $storeName);
                });
        } elseif ($period === 'last_6_months') {
            return $query->whereBetween('created_at', [now()->subMonths(5)->startOfMonth(), now()->endOfMonth()])
                ->whereHas('store', function (Builder $query) use ($storeName) {
                    $query->where('store_name', $storeName);
                });
        } elseif ($period === 'current_year') {
            // Filter by the current year
            return $query->whereYear('created_at', now()->year)
            ->whereHas('store', function ($query) use ($storeName) {
                $query->where('store_name', $storeName);
            });
    }

        return $query;
    }

    public function store() :BelongsTo {
        return $this->belongsTo(Store::class);
    }

    public function purchased() {
        return $this->hasMany(Purchased::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Create the invoice order number
            $model->order_invoice = 'INV' . '-' . str_pad(Order::max('id') + 1, 7, '0', STR_PAD_LEFT);
        });
    }

}
