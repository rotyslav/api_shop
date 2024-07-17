<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Purchase extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'seller_uuid',
        'buyer_uuid',
        'product_name',
        'price',
    ];

    public function buyer(): HasOne
    {
        return $this->hasOne(User::class, 'uuid', 'buyer_uuid');
    }

    public function seller(): HasOne
    {
        return $this->hasOne(User::class, 'uuid', 'seller_uuid');
    }
}
