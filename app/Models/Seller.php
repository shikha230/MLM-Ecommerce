<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_name',
        'store_slug',
        'store_phone',
        'store_email',
        'store_description',
        'store_logo',
        'store_banner',
        'gst_number',
        'pan_number',
        'bank_name',
        'bank_account_holder',
        'bank_account_number',
        'bank_ifsc',
        'address',
        'city',
        'state',
        'pincode',
        'status',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}
